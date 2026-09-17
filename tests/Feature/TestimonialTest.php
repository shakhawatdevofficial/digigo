<?php

use App\Models\Setting;
use App\Models\Testimonial;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('guest cannot access testimonial management', function () {
    $response = $this->get(route('admin.testimonials.index'));
    $response->assertRedirect(route('login'));
});

test('regular user cannot access testimonial management', function () {
    $user = User::factory()->create(['role' => 'user', 'status' => true]);

    $response = $this->actingAs($user)->get(route('admin.testimonials.index'));
    $response->assertRedirect();
    $response->assertSessionHas('error');
});

test('admin can view testimonial management page', function () {
    $admin = User::factory()->create(['role' => 'admin', 'status' => true]);

    $testimonial = Testimonial::factory()->create([
        'name' => 'John Doe Reviewer',
        'designation' => 'Tech Lead',
        'comment' => 'Outstanding digital delivery service.',
        'rating' => 5,
        'status' => true,
    ]);

    $response = $this->actingAs($admin)->get(route('admin.testimonials.index'));

    $response->assertStatus(200);
    $response->assertSee('Testimonials &amp; Reviews', false);
    $response->assertSee('John Doe Reviewer', false);
    $response->assertSee('Tech Lead', false);
});

test('admin can create a new testimonial', function () {
    $admin = User::factory()->create(['role' => 'admin', 'status' => true]);

    $response = $this->actingAs($admin)->post(route('admin.testimonials.store'), [
        'name' => 'Rakibul Hasan',
        'designation' => 'Developer',
        'comment' => 'Very fast delivery and 100% genuine product key!',
        'rating' => 5,
        'status' => '1',
    ]);

    $response->assertRedirect(route('admin.testimonials.index'));
    $response->assertSessionHas('success');

    $this->assertDatabaseHas('testimonials', [
        'name' => 'Rakibul Hasan',
        'designation' => 'Developer',
        'comment' => 'Very fast delivery and 100% genuine product key!',
        'rating' => 5,
        'status' => true,
    ]);
});

test('admin can update a testimonial', function () {
    $admin = User::factory()->create(['role' => 'admin', 'status' => true]);
    $testimonial = Testimonial::factory()->create([
        'name' => 'Initial Name',
        'rating' => 4,
        'status' => true,
    ]);

    $response = $this->actingAs($admin)->put(route('admin.testimonials.update', $testimonial), [
        'name' => 'Updated Name',
        'designation' => 'Senior Consultant',
        'comment' => 'Updated review comment here',
        'rating' => 5,
        // status omitted => false
    ]);

    $response->assertRedirect(route('admin.testimonials.index'));
    $response->assertSessionHas('success');

    $this->assertDatabaseHas('testimonials', [
        'id' => $testimonial->id,
        'name' => 'Updated Name',
        'designation' => 'Senior Consultant',
        'comment' => 'Updated review comment here',
        'rating' => 5,
        'status' => false,
    ]);
});

test('admin can toggle testimonial status', function () {
    $admin = User::factory()->create(['role' => 'admin', 'status' => true]);
    $testimonial = Testimonial::factory()->create(['status' => true]);

    $response = $this->actingAs($admin)->post(route('admin.testimonials.toggle-status', $testimonial));

    $response->assertRedirect(route('admin.testimonials.index'));
    $response->assertSessionHas('success');

    $this->assertDatabaseHas('testimonials', [
        'id' => $testimonial->id,
        'status' => false,
    ]);
});

test('admin can delete a testimonial', function () {
    $admin = User::factory()->create(['role' => 'admin', 'status' => true]);
    $testimonial = Testimonial::factory()->create();

    $response = $this->actingAs($admin)->delete(route('admin.testimonials.destroy', $testimonial));

    $response->assertRedirect(route('admin.testimonials.index'));
    $response->assertSessionHas('success');

    $this->assertDatabaseMissing('testimonials', [
        'id' => $testimonial->id,
    ]);
});

test('admin can update testimonial section customization settings', function () {
    $admin = User::factory()->create(['role' => 'admin', 'status' => true]);

    $response = $this->actingAs($admin)->post(route('admin.testimonials.section.update'), [
        'testimonials_badge' => 'VERIFIED REVIEWS',
        'testimonials_title' => 'What Clients Love About DigiGo',
        'testimonials_description' => 'Real customer reviews from real users.',
        'testimonials_status' => '1',
    ]);

    $response->assertRedirect();
    $response->assertSessionHas('success');

    expect(Setting::get('testimonials_badge'))->toBe('VERIFIED REVIEWS');
    expect(Setting::get('testimonials_title'))->toBe('What Clients Love About DigiGo');
    expect(Setting::get('testimonials_description'))->toBe('Real customer reviews from real users.');
    expect(Setting::get('testimonials_status'))->toBe('1');
});

test('homepage renders active testimonials dynamically', function () {
    Testimonial::factory()->create([
        'name' => 'Active Customer Review',
        'comment' => 'This is a super great active testimonial comment.',
        'status' => true,
    ]);

    Testimonial::factory()->create([
        'name' => 'Hidden Inactive Customer',
        'comment' => 'This review should not be visible anywhere.',
        'status' => false,
    ]);

    $response = $this->get(route('home'));

    $response->assertStatus(200);
    $response->assertSee('Active Customer Review', false);
    $response->assertSee('This is a super great active testimonial comment.', false);
    $response->assertDontSee('Hidden Inactive Customer', false);
    $response->assertDontSee('This review should not be visible anywhere.', false);
});

test('homepage hides testimonials section when status is turned off', function () {
    Setting::set('testimonials_status', '0');

    Testimonial::factory()->create([
        'name' => 'Test Customer',
        'comment' => 'Great service.',
        'status' => true,
    ]);

    $response = $this->get(route('home'));

    $response->assertStatus(200);
    $response->assertDontSee('id="testimonials"', false);
    $response->assertDontSee('Test Customer', false);
});
