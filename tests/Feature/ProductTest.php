<?php

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('guest cannot access product management', function () {
    $response = $this->get(route('admin.products.index'));
    $response->assertRedirect(route('login'));
});

test('regular user cannot access product management', function () {
    $user = User::factory()->create(['role' => 'user', 'status' => true]);

    $response = $this->actingAs($user)->get(route('admin.products.index'));
    $response->assertRedirect();
    $response->assertSessionHas('error');
});

test('admin can view products index page', function () {
    $admin = User::factory()->create(['role' => 'admin', 'status' => true]);
    $category = Category::factory()->create(['name' => 'Cloud Subscriptions']);
    $product = Product::factory()->create([
        'category_id' => $category->id,
        'name' => 'Microsoft 365 Family',
        'price' => 1299,
        'badge' => 'Official',
        'status' => true,
    ]);

    $response = $this->actingAs($admin)->get(route('admin.products.index'));

    $response->assertStatus(200);
    $response->assertSee('Digital Products', false);
    $response->assertSee('Microsoft 365 Family', false);
    $response->assertSee('Cloud Subscriptions', false);
    $response->assertSee('1,299', false);
});

test('admin can view create product page', function () {
    $admin = User::factory()->create(['role' => 'admin', 'status' => true]);

    $response = $this->actingAs($admin)->get(route('admin.products.create'));

    $response->assertStatus(200);
    $response->assertSee('Add New Digital Product', false);
    $response->assertSee('product_description', false);
});

test('admin can create a new product with rich description', function () {
    $admin = User::factory()->create(['role' => 'admin', 'status' => true]);
    $category = Category::factory()->create(['name' => 'Streaming']);

    $response = $this->actingAs($admin)->post(route('admin.products.store'), [
        'category_id' => $category->id,
        'name' => 'Netflix 4K UHD Premium',
        'slug' => '', // Auto-slug
        'short_description' => 'Ultra HD 4-screen streaming account with warranty.',
        'old_price' => 1200,
        'price' => 599,
        'status' => '1',
        'badge' => 'Hot Deal',
        'product_description' => '<h2>Netflix 4K Features</h2><table><tr><td>Resolution</td><td>4K Ultra HD</td></tr></table><p><b>Instant activation</b></p>',
    ]);

    $response->assertRedirect(route('admin.products.index'));
    $response->assertSessionHas('success');

    $this->assertDatabaseHas('products', [
        'name' => 'Netflix 4K UHD Premium',
        'slug' => 'netflix-4k-uhd-premium',
        'category_id' => $category->id,
        'price' => 599.00,
        'old_price' => 1200.00,
        'badge' => 'Hot Deal',
        'status' => true,
    ]);
});

test('product creation validates required name and price', function () {
    $admin = User::factory()->create(['role' => 'admin', 'status' => true]);

    $response = $this->actingAs($admin)->post(route('admin.products.store'), [
        'name' => '',
        'price' => '',
    ]);

    $response->assertSessionHasErrors(['name', 'price']);
});

test('admin can view edit product page and update product', function () {
    $admin = User::factory()->create(['role' => 'admin', 'status' => true]);
    $product = Product::factory()->create([
        'name' => 'Old Product Name',
        'price' => 300,
        'status' => true,
    ]);

    $editResponse = $this->actingAs($admin)->get(route('admin.products.edit', $product));
    $editResponse->assertStatus(200);
    $editResponse->assertSee('Edit Product:', false);

    $updateResponse = $this->actingAs($admin)->put(route('admin.products.update', $product), [
        'name' => 'Updated Product Name',
        'slug' => 'updated-product-name',
        'price' => 450,
        'old_price' => 600,
        'badge' => 'Popular',
        'short_description' => 'Updated short description.',
        'product_description' => '<p>Updated rich description</p>',
        // status omitted => false
    ]);

    $updateResponse->assertRedirect(route('admin.products.index'));
    $updateResponse->assertSessionHas('success');

    $this->assertDatabaseHas('products', [
        'id' => $product->id,
        'name' => 'Updated Product Name',
        'slug' => 'updated-product-name',
        'price' => 450.00,
        'status' => false,
    ]);
});

test('admin can toggle product status', function () {
    $admin = User::factory()->create(['role' => 'admin', 'status' => true]);
    $product = Product::factory()->create(['status' => true]);

    $response = $this->actingAs($admin)->post(route('admin.products.toggle-status', $product));

    $response->assertRedirect(route('admin.products.index'));
    $response->assertSessionHas('success');

    $this->assertDatabaseHas('products', [
        'id' => $product->id,
        'status' => false,
    ]);
});

test('admin can delete a product', function () {
    $admin = User::factory()->create(['role' => 'admin', 'status' => true]);
    $product = Product::factory()->create();

    $response = $this->actingAs($admin)->delete(route('admin.products.destroy', $product));

    $response->assertRedirect(route('admin.products.index'));
    $response->assertSessionHas('success');

    $this->assertDatabaseMissing('products', [
        'id' => $product->id,
    ]);
});

test('homepage renders active products dynamically', function () {
    $category = Category::factory()->create(['name' => 'Security VPN', 'slug' => 'security-vpn', 'status' => true]);
    $product = Product::factory()->create([
        'category_id' => $category->id,
        'name' => 'ProtonVPN Unlimited',
        'price' => 799,
        'badge' => 'Official',
        'status' => true,
    ]);

    $response = $this->get(route('home'));

    $response->assertStatus(200);
    $response->assertSee('ProtonVPN Unlimited', false);
    $response->assertSee('Security VPN', false);
    $response->assertSee('799', false);
});

test('inactive category and its products are not shown on homepage', function () {
    $inactiveCategory = Category::factory()->create(['name' => 'Secret Disabled Category', 'slug' => 'secret-disabled-category', 'status' => false]);
    $product = Product::factory()->create([
        'category_id' => $inactiveCategory->id,
        'name' => 'Hidden Product Under Inactive Category',
        'price' => 999,
        'status' => true,
    ]);

    $response = $this->get(route('home'));

    $response->assertStatus(200);
    $response->assertDontSee('Secret Disabled Category', false);
    $response->assertDontSee('Hidden Product Under Inactive Category', false);
});

test('product details page can be rendered with details and related products', function () {
    $category = Category::factory()->create(['name' => 'AI Apps', 'status' => true]);
    $product = Product::factory()->create([
        'category_id' => $category->id,
        'name' => 'Midjourney Pro Account',
        'slug' => 'midjourney-pro-account',
        'price' => 1500,
        'old_price' => 2000,
        'badge' => 'Hot Deal',
        'short_description' => 'Unlimited fast GPU hours and stealth mode.',
        'product_description' => '<p>Special Midjourney package details</p>',
        'status' => true,
    ]);

    $related = Product::factory()->create([
        'category_id' => $category->id,
        'name' => 'Claude Pro Subscription',
        'slug' => 'claude-pro-subscription',
        'status' => true,
    ]);

    $response = $this->get(route('product.details', 'midjourney-pro-account'));

    $response->assertStatus(200);
    $response->assertSee('Midjourney Pro Account', false);
    $response->assertSee('AI Apps', false);
    $response->assertSee('1,500', false);
    $response->assertSee('2,000', false);
    $response->assertSee('Hot Deal', false);
    $response->assertSee('Special Midjourney package details', false);
    $response->assertSee('Claude Pro Subscription', false);
});

test('product details returns 404 for inactive product or inactive category', function () {
    $inactiveProduct = Product::factory()->create([
        'slug' => 'inactive-product',
        'status' => false,
    ]);

    $this->get(route('product.details', 'inactive-product'))->assertStatus(404);

    $inactiveCat = Category::factory()->create(['status' => false]);
    $productWithInactiveCat = Product::factory()->create([
        'category_id' => $inactiveCat->id,
        'slug' => 'product-under-inactive-cat',
        'status' => true,
    ]);

    $this->get(route('product.details', 'product-under-inactive-cat'))->assertStatus(404);
});
