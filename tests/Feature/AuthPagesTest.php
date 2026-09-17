<?php

use App\Jobs\SendWelcomeEmailJob;
use App\Mail\WelcomeMail;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Queue;

uses(RefreshDatabase::class);

test('login page can be rendered', function () {
    $response = $this->get(route('login'));

    $response->assertStatus(200);
    $response->assertSee('Welcome Back', false);
    $response->assertSee('name="email"', false);
    $response->assertSee('name="password"', false);
});

test('login requires email and password', function () {
    $response = $this->post(route('authenticate'), [
        'email' => '',
        'password' => '',
    ]);

    $response->assertSessionHasErrors(['email', 'password']);
});

test('register page can be rendered', function () {
    $response = $this->get(route('register'));

    $response->assertStatus(200);
    $response->assertSee('Create an Account', false);
    $response->assertSee('name="name"', false);
    $response->assertSee('name="email"', false);
    $response->assertSee('name="password"', false);
    $response->assertSee('name="password_confirmation"', false);
});

test('register requires valid fields', function () {
    $response = $this->post(route('store'), [
        'name' => '',
        'email' => 'invalid-email',
        'password' => '123',
        'password_confirmation' => '456',
    ]);

    $response->assertSessionHasErrors(['name', 'email', 'password']);
});

test('successful registration creates user, dispatches queued welcome mail job, and redirects', function () {
    Queue::fake();

    $userData = [
        'name' => 'John Doe',
        'email' => 'johndoe@example.com',
        'password' => 'password123',
        'password_confirmation' => 'password123',
    ];

    $response = $this->post(route('store'), $userData);

    $response->assertRedirect(route('user.dashboard'));
    $this->assertAuthenticated();
    $this->assertDatabaseHas('users', [
        'email' => 'johndoe@example.com',
        'role' => 'user',
        'status' => true,
    ]);

    Queue::assertPushed(SendWelcomeEmailJob::class, function ($job) {
        return $job->user->email === 'johndoe@example.com';
    });
});

test('welcome email job sends WelcomeMail', function () {
    Mail::fake();

    $user = User::factory()->create([
        'name' => 'Jane Doe',
        'email' => 'janedoe@example.com',
    ]);

    (new SendWelcomeEmailJob($user))->handle();

    Mail::assertSent(WelcomeMail::class, function ($mail) use ($user) {
        return $mail->hasTo($user->email) &&
               $mail->user->id === $user->id;
    });
});

test('welcome mail template renders correctly with user information and unsubscribe link', function () {
    $user = User::factory()->create([
        'name' => 'Jane Doe',
        'email' => 'janedoe@example.com',
    ]);

    $mailable = new WelcomeMail($user);
    $mailable->assertSeeInHtml('Jane Doe');
    $mailable->assertSeeInHtml('DIGIGO');
    $mailable->assertSeeInHtml(route('unsubscribe', ['email' => $user->email]));
});

test('unsubscribe route is accessible', function () {
    $response = $this->get(route('unsubscribe', ['email' => 'test@example.com']));

    $response->assertStatus(200);
    $response->assertSee('Email Preferences', false);
    $response->assertSee('test@example.com', false);
});

test('user dashboard renders with navbar notifications and sidebar for authenticated user', function () {
    $user = User::factory()->create([
        'name' => 'Regular User',
        'role' => 'user',
        'status' => true,
    ]);

    $response = $this->actingAs($user)->get(route('user.dashboard'));

    $response->assertStatus(200);
    $response->assertSee('Regular User', false);
    $response->assertSee('User Portal', false);
    $response->assertSee('Notifications', false);
    $response->assertSee('My Subscriptions', false);
    $response->assertSee('Sign Out', false);
});

test('admin dashboard renders with navbar notifications and sidebar for authenticated admin', function () {
    $admin = User::factory()->create([
        'name' => 'Super Admin',
        'role' => 'admin',
        'status' => true,
    ]);

    $response = $this->actingAs($admin)->get(route('admin.dashboard'));

    $response->assertStatus(200);
    $response->assertSee('Super Admin', false);
    $response->assertSee('Admin Center', false);
    $response->assertSee('Admin System Alerts', false);
    $response->assertSee('Customization', false);
    $response->assertSee('Top Nav & Header', false);
    $response->assertSee('Products & Catalog', false);
    $response->assertSee('Log Out Admin', false);
});

test('admin can view and update top navigation customization settings', function () {
    $admin = User::factory()->create([
        'role' => 'admin',
        'status' => true,
    ]);

    $response = $this->actingAs($admin)->get(route('admin.customization.topnav'));
    $response->assertStatus(200);
    $response->assertSee('Top Nav & Header Settings', false);

    $updateResponse = $this->actingAs($admin)->post(route('admin.customization.topnav.update'), [
        'topbar_status' => '1',
        'topbar_email' => 'custom@digigo.click',
        'topbar_partner_text' => 'Official Verified Partner',
        'topbar_delivery_text' => 'Fast 5-Min Delivery',
        'topbar_support_text' => '24/7 Priority Support',
        'navbar_btn_text' => 'Get Started Now',
        'navbar_btn_link' => '#products',
    ]);

    $updateResponse->assertRedirect();
    $updateResponse->assertSessionHas('success');

    $this->assertDatabaseHas('settings', [
        'key' => 'topbar_email',
        'value' => 'custom@digigo.click',
    ]);

    // Check homepage reflects updated settings
    $homeResponse = $this->get(route('home'));
    $homeResponse->assertSee('custom@digigo.click', false);
    $homeResponse->assertSee('Official Verified Partner', false);
    $homeResponse->assertSee('Fast 5-Min Delivery', false);
    $homeResponse->assertSee('24/7 Priority Support', false);
});

test('admin can view and update banner customization settings and toggle status', function () {
    $admin = User::factory()->create([
        'role' => 'admin',
        'status' => true,
    ]);

    $response = $this->actingAs($admin)->get(route('admin.customization.banner'));
    $response->assertStatus(200);
    $response->assertSee('Homepage Hero / Banner Section', false);

    $updateResponse = $this->actingAs($admin)->post(route('admin.customization.banner.update'), [
        'banner_status' => '1',
        'banner_badge' => 'EXCLUSIVE DEALS 2026',
        'banner_title_1' => 'Premium Subscriptions,',
        'banner_title_2' => 'Best Price in Town.',
        'banner_description' => 'Fast delivery and instant support guaranteed.',
        'banner_search_placeholder' => 'Search products now...',
        'banner_trusted_text' => 'TRUSTED BY 100,000+ USERS',
    ]);

    $updateResponse->assertRedirect();
    $updateResponse->assertSessionHas('success');

    $this->assertDatabaseHas('settings', [
        'key' => 'banner_badge',
        'value' => 'EXCLUSIVE DEALS 2026',
    ]);

    // Check homepage reflects updated banner
    $homeResponse = $this->get(route('home'));
    $homeResponse->assertSee('EXCLUSIVE DEALS 2026', false);
    $homeResponse->assertSee('Premium Subscriptions,', false);
    $homeResponse->assertSee('Best Price in Town.', false);
    $homeResponse->assertSee('Fast delivery and instant support guaranteed.', false);
    $homeResponse->assertSee('TRUSTED BY 100,000+ USERS', false);

    // Test turning banner off
    $this->actingAs($admin)->post(route('admin.customization.banner.update'), [
        // banner_status omitted, so it becomes '0'
        'banner_badge' => 'EXCLUSIVE DEALS 2026',
    ]);

    $homeDisabledResponse = $this->get(route('home'));
    $homeDisabledResponse->assertDontSee('EXCLUSIVE DEALS 2026', false);
});

test('admin can view and update CTA customization settings and toggle status', function () {
    $admin = User::factory()->create([
        'role' => 'admin',
        'status' => true,
    ]);

    $response = $this->actingAs($admin)->get(route('admin.customization.cta'));
    $response->assertStatus(200);
    $response->assertSee('Homepage Call to Action (CTA) Section', false);

    $updateResponse = $this->actingAs($admin)->post(route('admin.customization.cta.update'), [
        'cta_status' => '1',
        'cta_badge' => 'LIMITED TIME OFFER',
        'cta_title' => 'Ready to Supercharge Your Apps?',
        'cta_description' => 'Get the lowest subscription rates in Bangladesh with 24/7 assistance.',
        'cta_btn_primary_text' => 'Get Started Now',
        'cta_btn_primary_link' => '#products',
        'cta_btn_secondary_text' => 'Chat on WhatsApp',
        'cta_btn_secondary_link' => 'https://wa.me/8801700000000',
    ]);

    $updateResponse->assertRedirect();
    $updateResponse->assertSessionHas('success');

    $this->assertDatabaseHas('settings', [
        'key' => 'cta_title',
        'value' => 'Ready to Supercharge Your Apps?',
    ]);

    // Check homepage reflects updated CTA
    $homeResponse = $this->get(route('home'));
    $homeResponse->assertSee('LIMITED TIME OFFER', false);
    $homeResponse->assertSee('Ready to Supercharge Your Apps?', false);
    $homeResponse->assertSee('Get the lowest subscription rates in Bangladesh with 24/7 assistance.', false);
    $homeResponse->assertSee('Get Started Now', false);
    $homeResponse->assertSee('Chat on WhatsApp', false);

    // Test turning CTA off
    $this->actingAs($admin)->post(route('admin.customization.cta.update'), [
        // cta_status omitted, so it becomes '0'
        'cta_title' => 'Ready to Supercharge Your Apps?',
    ]);

    $homeDisabledResponse = $this->get(route('home'));
    $homeDisabledResponse->assertDontSee('Ready to Supercharge Your Apps?', false);
});

test('admin can view and update profile information', function () {
    $admin = User::factory()->create([
        'name' => 'Original Admin',
        'email' => 'admin@digigo.click',
        'phone' => '01700000000',
        'role' => 'admin',
        'status' => true,
    ]);

    $response = $this->actingAs($admin)->get(route('admin.profile'));
    $response->assertStatus(200);
    $response->assertSee('Admin Account Details', false);
    $response->assertSee('Original Admin', false);

    $updateResponse = $this->actingAs($admin)->post(route('admin.profile.update'), [
        'name' => 'Updated Admin Name',
        'email' => 'updatedadmin@digigo.click',
        'phone' => '01888888888',
    ]);

    $updateResponse->assertRedirect();
    $updateResponse->assertSessionHas('success');

    $this->assertDatabaseHas('users', [
        'id' => $admin->id,
        'name' => 'Updated Admin Name',
        'email' => 'updatedadmin@digigo.click',
        'phone' => '01888888888',
    ]);
});

test('admin can view password change page and update password', function () {
    $admin = User::factory()->create([
        'role' => 'admin',
        'password' => 'oldpassword123',
        'status' => true,
    ]);

    $response = $this->actingAs($admin)->get(route('admin.password'));
    $response->assertStatus(200);
    $response->assertSee('Update Password', false);

    // Update with correct current password
    $updateResponse = $this->actingAs($admin)->post(route('admin.password.update'), [
        'current_password' => 'oldpassword123',
        'password' => 'newsecretpassword123',
        'password_confirmation' => 'newsecretpassword123',
    ]);

    $updateResponse->assertRedirect();
    $updateResponse->assertSessionHas('success');

    // Verify authentication succeeds with new password
    $this->assertTrue(Hash::check('newsecretpassword123', $admin->fresh()->password));
});

test('admin password update fails with incorrect current password', function () {
    $admin = User::factory()->create([
        'role' => 'admin',
        'password' => 'oldpassword123',
        'status' => true,
    ]);

    $updateResponse = $this->actingAs($admin)->post(route('admin.password.update'), [
        'current_password' => 'wrongpassword',
        'password' => 'newsecretpassword123',
        'password_confirmation' => 'newsecretpassword123',
    ]);

    $updateResponse->assertSessionHasErrors(['current_password']);
});
