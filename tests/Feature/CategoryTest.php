<?php

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('guest cannot access category management', function () {
    $response = $this->get(route('admin.categories.index'));
    $response->assertRedirect(route('login'));
});

test('regular user cannot access category management', function () {
    $user = User::factory()->create(['role' => 'user', 'status' => true]);

    $response = $this->actingAs($user)->get(route('admin.categories.index'));
    $response->assertRedirect();
    $response->assertSessionHas('error');
});

test('admin can view category list and existing categories', function () {
    $admin = User::factory()->create(['role' => 'admin', 'status' => true]);

    Category::factory()->create([
        'name' => 'VPN Services',
        'slug' => 'vpn-services',
        'status' => true,
    ]);

    $response = $this->actingAs($admin)->get(route('admin.categories.index'));

    $response->assertStatus(200);
    $response->assertSee('Product Categories', false);
    $response->assertSee('VPN Services', false);
    $response->assertSee('vpn-services', false);
});

test('admin can create a new category', function () {
    $admin = User::factory()->create(['role' => 'admin', 'status' => true]);

    $response = $this->actingAs($admin)->post(route('admin.categories.store'), [
        'name' => 'Streaming Subscriptions',
        'slug' => 'streaming-subscriptions',
        'status' => '1',
    ]);

    $response->assertRedirect(route('admin.categories.index'));
    $response->assertSessionHas('success');

    $this->assertDatabaseHas('categories', [
        'name' => 'Streaming Subscriptions',
        'slug' => 'streaming-subscriptions',
        'status' => true,
    ]);
});

test('admin can create category with auto-generated slug', function () {
    $admin = User::factory()->create(['role' => 'admin', 'status' => true]);

    $response = $this->actingAs($admin)->post(route('admin.categories.store'), [
        'name' => 'AI Productivity Tools',
        'slug' => '',
        'status' => '1',
    ]);

    $response->assertRedirect(route('admin.categories.index'));

    $this->assertDatabaseHas('categories', [
        'name' => 'AI Productivity Tools',
        'slug' => 'ai-productivity-tools',
        'status' => true,
    ]);
});

test('category creation validates required name and unique slug', function () {
    $admin = User::factory()->create(['role' => 'admin', 'status' => true]);

    Category::factory()->create(['slug' => 'existing-slug']);

    $response = $this->actingAs($admin)->post(route('admin.categories.store'), [
        'name' => '',
        'slug' => 'existing-slug',
    ]);

    $response->assertSessionHasErrors(['name', 'slug']);
});

test('admin can update a category', function () {
    $admin = User::factory()->create(['role' => 'admin', 'status' => true]);
    $category = Category::factory()->create([
        'name' => 'Old Category Name',
        'slug' => 'old-category-name',
        'status' => true,
    ]);

    $response = $this->actingAs($admin)->put(route('admin.categories.update', $category), [
        'name' => 'Updated Category Name',
        'slug' => 'updated-category-name',
        // status omitted => false
    ]);

    $response->assertRedirect(route('admin.categories.index'));
    $response->assertSessionHas('success');

    $this->assertDatabaseHas('categories', [
        'id' => $category->id,
        'name' => 'Updated Category Name',
        'slug' => 'updated-category-name',
        'status' => false,
    ]);
});

test('admin can toggle category status', function () {
    $admin = User::factory()->create(['role' => 'admin', 'status' => true]);
    $category = Category::factory()->create([
        'status' => true,
    ]);

    $response = $this->actingAs($admin)->post(route('admin.categories.toggle-status', $category));

    $response->assertRedirect(route('admin.categories.index'));
    $response->assertSessionHas('success');

    $this->assertDatabaseHas('categories', [
        'id' => $category->id,
        'status' => false,
    ]);
});

test('admin can delete a category', function () {
    $admin = User::factory()->create(['role' => 'admin', 'status' => true]);
    $category = Category::factory()->create();

    $response = $this->actingAs($admin)->delete(route('admin.categories.destroy', $category));

    $response->assertRedirect(route('admin.categories.index'));
    $response->assertSessionHas('success');

    $this->assertDatabaseMissing('categories', [
        'id' => $category->id,
    ]);
});
