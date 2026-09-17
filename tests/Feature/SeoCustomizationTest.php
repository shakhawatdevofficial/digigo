<?php

use App\Models\Setting;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;

uses(RefreshDatabase::class);

test('guest cannot access seo customization page', function () {
    $response = $this->get(route('admin.customization.seo'));
    $response->assertRedirect(route('login'));
});

test('regular user cannot access seo customization page', function () {
    $user = User::factory()->create(['role' => 'user', 'status' => true]);

    $response = $this->actingAs($user)->get(route('admin.customization.seo'));
    $response->assertRedirect();
    $response->assertSessionHas('error');
});

test('admin can view seo and branding customization page', function () {
    $admin = User::factory()->create(['role' => 'admin', 'status' => true]);

    $response = $this->actingAs($admin)->get(route('admin.customization.seo'));

    $response->assertStatus(200);
    $response->assertSee('Logo, Favicon & SEO Settings', false);
    $response->assertSee('Search Engine Optimization (SEO)', false);
});

test('admin can update seo settings and upload logo, favicon, and og image', function () {
    $admin = User::factory()->create(['role' => 'admin', 'status' => true]);

    $logoFile = UploadedFile::fake()->image('custom_logo.png', 300, 80);
    $faviconFile = UploadedFile::fake()->image('custom_favicon.ico', 32, 32);
    $ogFile = UploadedFile::fake()->image('custom_og.jpg', 1200, 630);

    $response = $this->actingAs($admin)->post(route('admin.customization.seo.update'), [
        'meta_title' => 'Custom Store SEO Title',
        'meta_description' => 'This is the custom store meta description for search engines.',
        'meta_keywords' => 'digital, subscription, game topup, vpn',
        'meta_author' => 'DigiGo Dev Team',
        'site_logo' => $logoFile,
        'site_favicon' => $faviconFile,
        'meta_og_image' => $ogFile,
    ]);

    $response->assertRedirect();
    $response->assertSessionHas('success');

    expect(Setting::get('meta_title'))->toBe('Custom Store SEO Title');
    expect(Setting::get('meta_description'))->toBe('This is the custom store meta description for search engines.');
    expect(Setting::get('meta_keywords'))->toBe('digital, subscription, game topup, vpn');
    expect(Setting::get('meta_author'))->toBe('DigiGo Dev Team');
    expect(Setting::get('site_logo'))->not->toBeNull();
    expect(Setting::get('site_favicon'))->not->toBeNull();
    expect(Setting::get('meta_og_image'))->not->toBeNull();

    // Clean up uploaded test files
    foreach (['site_logo', 'site_favicon', 'meta_og_image'] as $settingKey) {
        $path = public_path(Setting::get($settingKey));
        if (File::exists($path)) {
            File::delete($path);
        }
    }
});

test('homepage renders dynamic seo meta tags, favicon and navbar logo', function () {
    Setting::set('meta_title', 'Best Digital Store in Bangladesh');
    Setting::set('meta_description', 'Get genuine subscriptions and instant activation.');
    Setting::set('meta_keywords', 'netflix, spotify, canva pro');
    Setting::set('meta_author', 'DigiGo Super Team');
    Setting::set('site_favicon', 'uploads/settings/test_fav.png');
    Setting::set('site_logo', 'uploads/settings/test_logo.png');
    Setting::set('meta_og_image', 'uploads/settings/test_og.jpg');

    $response = $this->get(route('home'));

    $response->assertStatus(200);
    $response->assertSee('<title>Best Digital Store in Bangladesh</title>', false);
    $response->assertSee('content="Get genuine subscriptions and instant activation."', false);
    $response->assertSee('content="netflix, spotify, canva pro"', false);
    $response->assertSee('content="DigiGo Super Team"', false);
    $response->assertSee(asset('uploads/settings/test_fav.png'), false);
    $response->assertSee(asset('uploads/settings/test_logo.png'), false);
    $response->assertSee(asset('uploads/settings/test_og.jpg'), false);
});
