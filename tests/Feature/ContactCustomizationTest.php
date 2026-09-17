<?php

use App\Models\Setting;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('guest cannot access contact customization', function () {
    $response = $this->get(route('admin.customization.contact'));
    $response->assertRedirect(route('login'));
});

test('regular user cannot access contact customization', function () {
    $user = User::factory()->create(['role' => 'user', 'status' => true]);

    $response = $this->actingAs($user)->get(route('admin.customization.contact'));
    $response->assertRedirect();
    $response->assertSessionHas('error');
});

test('admin can view contact customization page', function () {
    $admin = User::factory()->create(['role' => 'admin', 'status' => true]);

    $response = $this->actingAs($admin)->get(route('admin.customization.contact'));

    $response->assertStatus(200);
    $response->assertSee('Contact Section & Location Settings', false);
    $response->assertSee('Email Us Card', false);
    $response->assertSee('WhatsApp Support Card', false);
    $response->assertSee('Office Location Card', false);
});

test('admin can update contact settings', function () {
    $admin = User::factory()->create(['role' => 'admin', 'status' => true]);

    $response = $this->actingAs($admin)->post(route('admin.customization.contact.update'), [
        'contact_badge' => '24/7 SUPPORT DESK',
        'contact_title' => 'Get in Touch with Our Team',
        'contact_description' => 'We are available 24/7 for instant assistance.',
        'contact_email_title' => 'Email Helpdesk',
        'contact_email_subtitle' => 'Drop us an email anytime.',
        'contact_email' => 'help@digigo.click',
        'contact_whatsapp_title' => 'Instant WhatsApp Help',
        'contact_whatsapp_subtitle' => 'Get reply within 2 minutes.',
        'contact_whatsapp_number' => '+880 1999-888777',
        'contact_whatsapp_url' => 'https://wa.me/8801999888777',
        'contact_location_title' => 'Dhaka HQ Office',
        'contact_location_address' => 'Banani Commercial Area, Dhaka 1213.',
        'contact_location_btn_text' => 'Get Directions',
        'contact_location_btn_link' => 'https://maps.google.com/?q=Banani',
        'contact_status' => '1',
    ]);

    $response->assertRedirect();
    $response->assertSessionHas('success');

    expect(Setting::get('contact_badge'))->toBe('24/7 SUPPORT DESK');
    expect(Setting::get('contact_email'))->toBe('help@digigo.click');
    expect(Setting::get('contact_whatsapp_number'))->toBe('+880 1999-888777');
    expect(Setting::get('contact_location_address'))->toBe('Banani Commercial Area, Dhaka 1213.');
    expect(Setting::get('contact_location_btn_text'))->toBe('Get Directions');
});

test('homepage renders customized contact info dynamically', function () {
    Setting::set('contact_email', 'support-desk@digigo.click');
    Setting::set('contact_whatsapp_number', '+880 1888-777666');
    Setting::set('contact_location_address', 'Dhanmondi 27, Dhaka, Bangladesh.');
    Setting::set('contact_location_btn_text', 'View On Map');

    $response = $this->get(route('home'));

    $response->assertStatus(200);
    $response->assertSee('support-desk@digigo.click', false);
    $response->assertSee('+880 1888-777666', false);
    $response->assertSee('Dhanmondi 27, Dhaka, Bangladesh.', false);
    $response->assertSee('View On Map', false);
});

test('homepage hides contact section when status is turned off', function () {
    Setting::set('contact_status', '0');

    $response = $this->get(route('home'));

    $response->assertStatus(200);
    $response->assertDontSee('id="contact"', false);
});
