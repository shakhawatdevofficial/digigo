<?php

use App\Mail\ContactReplyMail;
use App\Models\Contact;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;

uses(RefreshDatabase::class);

test('guest cannot access admin contacts list', function () {
    $response = $this->get(route('admin.contacts.index'));
    $response->assertRedirect(route('login'));
});

test('regular user cannot access admin contacts list', function () {
    $user = User::factory()->create(['role' => 'user', 'status' => true]);

    $response = $this->actingAs($user)->get(route('admin.contacts.index'));
    $response->assertRedirect();
    $response->assertSessionHas('error');
});

test('admin can view contacts list and stats', function () {
    $admin = User::factory()->create(['role' => 'admin', 'status' => true]);
    Contact::create([
        'name' => 'John Customer',
        'email' => 'john@example.com',
        'subject' => 'Need Help with Subscription',
        'message' => 'Please help me activate my Netflix subscription.',
        'status' => 'pending',
        'is_read' => false,
    ]);

    $response = $this->actingAs($admin)->get(route('admin.contacts.index'));

    $response->assertStatus(200);
    $response->assertSee('Contact Inquiries & Messages', false);
    $response->assertSee('John Customer', false);
    $response->assertSee('john@example.com', false);
});

test('admin can search and filter contacts', function () {
    $admin = User::factory()->create(['role' => 'admin', 'status' => true]);
    Contact::create([
        'name' => 'Alice Wonder',
        'email' => 'alice@example.com',
        'subject' => 'VPN inquiry',
        'message' => 'VPN details needed.',
        'status' => 'pending',
    ]);
    Contact::create([
        'name' => 'Bob Builder',
        'email' => 'bob@example.com',
        'subject' => 'Payment issue',
        'message' => 'Payment failed.',
        'status' => 'replied',
    ]);

    $searchResponse = $this->actingAs($admin)->get(route('admin.contacts.index', ['search' => 'Alice']));
    $searchResponse->assertStatus(200);
    $searchResponse->assertSee('Alice Wonder', false);
    $searchResponse->assertDontSee('Bob Builder', false);

    $filterResponse = $this->actingAs($admin)->get(route('admin.contacts.index', ['status' => 'replied']));
    $filterResponse->assertStatus(200);
    $filterResponse->assertSee('Bob Builder', false);
    $filterResponse->assertDontSee('Alice Wonder', false);
});

test('admin can view contact details and mark it as read', function () {
    $admin = User::factory()->create(['role' => 'admin', 'status' => true]);
    $contact = Contact::create([
        'name' => 'David Miller',
        'email' => 'david@example.com',
        'subject' => 'Canva Pro access',
        'message' => 'How can I get Canva Pro?',
        'status' => 'pending',
        'is_read' => false,
    ]);

    $response = $this->actingAs($admin)->get(route('admin.contacts.show', $contact->id));

    $response->assertStatus(200);
    $response->assertSee('Inquiry #'.$contact->id, false);
    $response->assertSee('David Miller', false);
    $response->assertSee('How can I get Canva Pro?', false);

    $contact->refresh();
    expect($contact->is_read)->toBeTrue();
});

test('admin can change contact status', function () {
    $admin = User::factory()->create(['role' => 'admin', 'status' => true]);
    $contact = Contact::create([
        'name' => 'Sam Smith',
        'email' => 'sam@example.com',
        'message' => 'Test message',
        'status' => 'pending',
    ]);

    $response = $this->actingAs($admin)->post(route('admin.contacts.status', $contact->id), [
        'status' => 'closed',
    ]);

    $response->assertRedirect();
    $response->assertSessionHas('success');

    $contact->refresh();
    expect($contact->status)->toBe('closed');
});

test('admin can send reply email to contact and update status to replied', function () {
    Mail::fake();

    $admin = User::factory()->create(['role' => 'admin', 'status' => true]);
    $contact = Contact::create([
        'name' => 'Rakib Hasan',
        'email' => 'rakib@gmail.com',
        'subject' => 'Order status',
        'message' => 'Where is my login credentials?',
        'status' => 'pending',
    ]);

    $response = $this->actingAs($admin)->post(route('admin.contacts.reply', $contact->id), [
        'name' => 'DigiGo Support Team',
        'from_email' => 'support@digigo.com',
        'subject' => 'Re: Order status',
        'message' => 'Hello Rakib, your credentials have been sent to your dashboard. Thanks!',
    ]);

    $response->assertRedirect(route('admin.contacts.show', $contact->id));
    $response->assertSessionHas('success');

    // Assert mail was queued to run as a background job
    Mail::assertQueued(ContactReplyMail::class, function ($mail) use ($contact) {
        return $mail->hasTo($contact->email) &&
               $mail->replySubject === 'Re: Order status' &&
               str_contains($mail->replyMessage, 'Hello Rakib') &&
               $mail->recipientName === 'Rakib Hasan' &&
               $mail->originalMessage === 'Where is my login credentials?';
    });

    $contact->refresh();
    expect($contact->status)->toBe('replied');
    expect($contact->reply_subject)->toBe('Re: Order status');
    expect($contact->reply_message)->toContain('Hello Rakib');
    expect($contact->replied_at)->not->toBeNull();
});

test('admin can delete contact message', function () {
    $admin = User::factory()->create(['role' => 'admin', 'status' => true]);
    $contact = Contact::create([
        'name' => 'Temporary User',
        'email' => 'temp@example.com',
        'message' => 'Spam message',
        'status' => 'pending',
    ]);

    $response = $this->actingAs($admin)->delete(route('admin.contacts.destroy', $contact->id));

    $response->assertRedirect(route('admin.contacts.index'));
    $response->assertSessionHas('success');

    expect(Contact::find($contact->id))->toBeNull();
});

test('contact reply mail template renders conversation thread correctly', function () {
    $mailable = new ContactReplyMail(
        replySubject: 'Re: Subscription query',
        replyMessage: 'We have renewed your account for 1 year.',
        fromName: 'DigiGo Super Support',
        fromEmail: 'support@digigo.com',
        recipientName: 'Shakhawat Hosen',
        recipientEmail: 'shakhawat9083@gmail.com',
        originalSubject: 'I want to take a subscription',
        originalMessage: 'Please give me netflix price details.',
        originalDate: 'Sep 17, 2026 at 11:59 AM',
        contactId: 2
    );

    $mailable->assertSeeInHtml('DIGIGO');
    $mailable->assertSeeInHtml('Ticket #2');
    $mailable->assertSeeInHtml('Hello Shakhawat Hosen');
    $mailable->assertSeeInHtml('We have renewed your account for 1 year.');
    $mailable->assertSeeInHtml('DigiGo Super Support');
    $mailable->assertSeeInHtml('Conversation Thread');
    $mailable->assertSeeInHtml('Please give me netflix price details.');
});
