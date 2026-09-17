<?php

use App\Models\Category;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;

uses(RefreshDatabase::class);

test('guest cannot access footer customization', function () {
    $response = $this->get(route('admin.customization.footer'));
    $response->assertRedirect(route('login'));
});

test('regular user cannot access footer customization', function () {
    $user = User::factory()->create(['role' => 'user', 'status' => true]);

    $response = $this->actingAs($user)->get(route('admin.customization.footer'));
    $response->assertRedirect();
    $response->assertSessionHas('error');
});

test('admin can view footer customization page', function () {
    $admin = User::factory()->create(['role' => 'admin', 'status' => true]);

    $response = $this->actingAs($admin)->get(route('admin.customization.footer'));

    $response->assertStatus(200);
    $response->assertSee('Footer & Logo Branding Settings', false);
});

test('admin can update footer settings and upload logo', function () {
    $admin = User::factory()->create(['role' => 'admin', 'status' => true]);

    $logoFile = UploadedFile::fake()->image('custom-logo.png', 200, 60);

    $response = $this->actingAs($admin)->post(route('admin.customization.footer.update'), [
        'footer_description' => 'Custom updated footer description text.',
        'footer_facebook_url' => 'https://facebook.com/digigobd',
        'footer_twitter_url' => 'https://twitter.com/digigobd',
        'footer_instagram_url' => 'https://instagram.com/digigobd',
        'footer_youtube_url' => 'https://youtube.com/@digigobd',
        'footer_whatsapp_url' => 'https://wa.me/8801999999999',
        'footer_payment_title' => 'Safe &amp; Secure Payments',
        'footer_payment_text' => 'We accept all cards and MFS.',
        'footer_copyright_text' => '©2026 DigiGo Pro. All Rights Reserved.',
        'footer_partner_text' => 'PREMIUM DIGITAL PARTNER',
        'footer_status' => '1',
        'site_logo' => $logoFile,
    ]);

    $response->assertRedirect();
    $response->assertSessionHas('success');

    expect(Setting::get('footer_description'))->toBe('Custom updated footer description text.');
    expect(Setting::get('footer_facebook_url'))->toBe('https://facebook.com/digigobd');
    expect(Setting::get('footer_copyright_text'))->toBe('©2026 DigiGo Pro. All Rights Reserved.');
    expect(Setting::get('footer_partner_text'))->toBe('PREMIUM DIGITAL PARTNER');
    expect(Setting::get('site_logo'))->not->toBeNull();

    // Clean up uploaded file
    $uploadedPath = public_path(Setting::get('site_logo'));
    if (File::exists($uploadedPath)) {
        File::delete($uploadedPath);
    }
});

test('homepage renders dynamic footer content and categories', function () {
    Category::factory()->create([
        'name' => 'Streaming Passes',
        'status' => true,
    ]);

    Setting::set('footer_description', 'Our official custom footer description test.');
    Setting::set('footer_copyright_text', '© 2026 Test Copyright Notice');
    Setting::set('footer_facebook_url', 'https://facebook.com/testpage');

    $response = $this->get(route('home'));

    $response->assertStatus(200);
    $response->assertSee('Our official custom footer description test.', false);
    $response->assertSee('© 2026 Test Copyright Notice', false);
    $response->assertSee('https://facebook.com/testpage', false);
    $response->assertSee('Streaming Passes', false);
});

test('homepage hides footer when footer status is disabled', function () {
    Setting::set('footer_status', '0');

    $response = $this->get(route('home'));

    $response->assertStatus(200);
    $response->assertDontSee('id="about"', false);
});
