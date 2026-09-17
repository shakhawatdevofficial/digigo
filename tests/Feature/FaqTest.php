<?php

use App\Models\Faq;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('guest cannot access FAQ management', function () {
    $response = $this->get(route('admin.faqs.index'));
    $response->assertRedirect(route('login'));
});

test('regular user cannot access FAQ management', function () {
    $user = User::factory()->create(['role' => 'user', 'status' => true]);

    $response = $this->actingAs($user)->get(route('admin.faqs.index'));
    $response->assertRedirect();
    $response->assertSessionHas('error');
});

test('admin can view FAQ management page', function () {
    $admin = User::factory()->create(['role' => 'admin', 'status' => true]);

    $faq = Faq::factory()->create([
        'question' => 'How does digital license delivery work?',
        'answer' => 'License keys are sent instantly via email.',
        'order' => 1,
        'status' => true,
    ]);

    $response = $this->actingAs($admin)->get(route('admin.faqs.index'));

    $response->assertStatus(200);
    $response->assertSee('FAQ Questions', false);
    $response->assertSee('How does digital license delivery work?', false);
    $response->assertSee('License keys are sent instantly via email.', false);
});

test('admin can create a new FAQ question', function () {
    $admin = User::factory()->create(['role' => 'admin', 'status' => true]);

    $response = $this->actingAs($admin)->post(route('admin.faqs.store'), [
        'question' => 'Can I get a refund if product does not work?',
        'answer' => 'Yes, we provide 100% money-back guarantee if issue is verified.',
        'order' => 2,
        'status' => '1',
    ]);

    $response->assertRedirect(route('admin.faqs.index'));
    $response->assertSessionHas('success');

    $this->assertDatabaseHas('faqs', [
        'question' => 'Can I get a refund if product does not work?',
        'answer' => 'Yes, we provide 100% money-back guarantee if issue is verified.',
        'order' => 2,
        'status' => true,
    ]);
});

test('admin can update an FAQ question', function () {
    $admin = User::factory()->create(['role' => 'admin', 'status' => true]);
    $faq = Faq::factory()->create([
        'question' => 'Original Question?',
        'answer' => 'Original Answer.',
        'order' => 1,
        'status' => true,
    ]);

    $response = $this->actingAs($admin)->put(route('admin.faqs.update', $faq), [
        'question' => 'Updated Question Headline?',
        'answer' => 'Updated Answer description content.',
        'order' => 5,
        // status omitted => false
    ]);

    $response->assertRedirect(route('admin.faqs.index'));
    $response->assertSessionHas('success');

    $this->assertDatabaseHas('faqs', [
        'id' => $faq->id,
        'question' => 'Updated Question Headline?',
        'answer' => 'Updated Answer description content.',
        'order' => 5,
        'status' => false,
    ]);
});

test('admin can toggle FAQ status', function () {
    $admin = User::factory()->create(['role' => 'admin', 'status' => true]);
    $faq = Faq::factory()->create(['status' => true]);

    $response = $this->actingAs($admin)->post(route('admin.faqs.toggle-status', $faq));

    $response->assertRedirect(route('admin.faqs.index'));
    $response->assertSessionHas('success');

    $this->assertDatabaseHas('faqs', [
        'id' => $faq->id,
        'status' => false,
    ]);
});

test('admin can delete an FAQ question', function () {
    $admin = User::factory()->create(['role' => 'admin', 'status' => true]);
    $faq = Faq::factory()->create();

    $response = $this->actingAs($admin)->delete(route('admin.faqs.destroy', $faq));

    $response->assertRedirect(route('admin.faqs.index'));
    $response->assertSessionHas('success');

    $this->assertDatabaseMissing('faqs', [
        'id' => $faq->id,
    ]);
});

test('admin can update FAQ section customization settings', function () {
    $admin = User::factory()->create(['role' => 'admin', 'status' => true]);

    $response = $this->actingAs($admin)->post(route('admin.faqs.section.update'), [
        'faq_badge' => 'HELP & SUPPORT',
        'faq_title' => 'Got Questions? We Have Answers',
        'faq_description' => 'Find quick solutions to common questions.',
        'faq_status' => '1',
    ]);

    $response->assertRedirect();
    $response->assertSessionHas('success');

    expect(Setting::get('faq_badge'))->toBe('HELP & SUPPORT');
    expect(Setting::get('faq_title'))->toBe('Got Questions? We Have Answers');
    expect(Setting::get('faq_description'))->toBe('Find quick solutions to common questions.');
    expect(Setting::get('faq_status'))->toBe('1');
});

test('homepage renders active FAQs dynamically', function () {
    Faq::factory()->create([
        'question' => 'Is activation instant after bKash payment?',
        'answer' => 'Yes, within 5-15 mins it will be activated.',
        'status' => true,
    ]);

    Faq::factory()->create([
        'question' => 'Hidden Secret Question?',
        'answer' => 'This answer should never be displayed publicly.',
        'status' => false,
    ]);

    $response = $this->get(route('home'));

    $response->assertStatus(200);
    $response->assertSee('Is activation instant after bKash payment?', false);
    $response->assertSee('Yes, within 5-15 mins it will be activated.', false);
    $response->assertDontSee('Hidden Secret Question?', false);
    $response->assertDontSee('This answer should never be displayed publicly.', false);
});

test('homepage hides FAQ section when status is turned off', function () {
    Setting::set('faq_status', '0');

    Faq::factory()->create([
        'question' => 'Test FAQ Question',
        'answer' => 'Test Answer',
        'status' => true,
    ]);

    $response = $this->get(route('home'));

    $response->assertStatus(200);
    $response->assertDontSee('id="faq"', false);
    $response->assertDontSee('Test FAQ Question', false);
});
