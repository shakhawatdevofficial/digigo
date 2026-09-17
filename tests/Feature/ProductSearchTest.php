<?php

use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('guest can access search page', function () {
    $response = $this->get(route('search'));

    $response->assertStatus(200);
    $response->assertSee('Search Digital Subscriptions & Licenses', false);
});

test('search page returns matching products by name or description', function () {
    $activeCategory = Category::factory()->create(['name' => 'Streaming', 'status' => true]);

    $p1 = Product::factory()->create([
        'category_id' => $activeCategory->id,
        'name' => 'Netflix 4K UHD Premium',
        'short_description' => 'Ultra HD 4 screens',
        'status' => true,
    ]);

    $p2 = Product::factory()->create([
        'category_id' => $activeCategory->id,
        'name' => 'Spotify Music Premium',
        'short_description' => 'Ad free music',
        'status' => true,
    ]);

    $response = $this->get(route('search', ['q' => 'Netflix']));

    $response->assertStatus(200);
    $response->assertSee('Netflix 4K UHD Premium', false);
    $response->assertDontSee('Spotify Music Premium', false);
});

test('search page filters products by category', function () {
    $cat1 = Category::factory()->create(['name' => 'Streaming Apps', 'slug' => 'streaming-apps', 'status' => true]);
    $cat2 = Category::factory()->create(['name' => 'VPN Services', 'slug' => 'vpn-services', 'status' => true]);

    $product1 = Product::factory()->create([
        'category_id' => $cat1->id,
        'name' => 'Disney Plus UHD',
        'status' => true,
    ]);

    $product2 = Product::factory()->create([
        'category_id' => $cat2->id,
        'name' => 'NordVPN 2 Years',
        'status' => true,
    ]);

    $response = $this->get(route('search', ['category' => 'streaming-apps']));

    $response->assertStatus(200);
    $response->assertSee('Disney Plus UHD', false);
    $response->assertDontSee('NordVPN 2 Years', false);
});

test('search page sorts products by price and name', function () {
    $category = Category::factory()->create(['status' => true]);

    $cheap = Product::factory()->create([
        'category_id' => $category->id,
        'name' => 'Affordable Plan',
        'price' => 100,
        'status' => true,
    ]);

    $expensive = Product::factory()->create([
        'category_id' => $category->id,
        'name' => 'Expensive Plan',
        'price' => 900,
        'status' => true,
    ]);

    $response = $this->get(route('search', ['sort' => 'price_low']));
    $response->assertStatus(200);
    $response->assertSeeInOrder(['Affordable Plan', 'Expensive Plan']);

    $responseHigh = $this->get(route('search', ['sort' => 'price_high']));
    $responseHigh->assertStatus(200);
    $responseHigh->assertSeeInOrder(['Expensive Plan', 'Affordable Plan']);
});

test('search ignores inactive products and inactive category products', function () {
    $activeCat = Category::factory()->create(['status' => true]);
    $inactiveCat = Category::factory()->create(['status' => false]);

    // Active product in active category
    $p1 = Product::factory()->create([
        'category_id' => $activeCat->id,
        'name' => 'Valid Canva Pro',
        'status' => true,
    ]);

    // Inactive product in active category
    $p2 = Product::factory()->create([
        'category_id' => $activeCat->id,
        'name' => 'Inactive Canva Pro',
        'status' => false,
    ]);

    // Active product in inactive category
    $p3 = Product::factory()->create([
        'category_id' => $inactiveCat->id,
        'name' => 'Hidden Canva Pro in Disabled Category',
        'status' => true,
    ]);

    $response = $this->get(route('search', ['q' => 'Canva']));

    $response->assertStatus(200);
    $response->assertSee('Valid Canva Pro', false);
    $response->assertDontSee('Inactive Canva Pro', false);
    $response->assertDontSee('Hidden Canva Pro in Disabled Category', false);
});

test('search suggestions endpoint returns json suggestions for available products', function () {
    $category = Category::factory()->create(['name' => 'Cloud', 'status' => true]);

    $p1 = Product::factory()->create([
        'category_id' => $category->id,
        'name' => 'Google One 2TB Cloud',
        'slug' => 'google-one-2tb-cloud',
        'price' => 500,
        'badge' => 'Hot',
        'status' => true,
    ]);

    $response = $this->getJson(route('search.suggestions', ['q' => 'Google One']));

    $response->assertStatus(200);
    $response->assertJsonStructure([
        'results' => [
            '*' => ['id', 'name', 'slug', 'price', 'badge', 'category', 'url'],
        ],
        'total',
    ]);
    $response->assertJsonFragment([
        'name' => 'Google One 2TB Cloud',
        'slug' => 'google-one-2tb-cloud',
        'category' => 'Cloud',
    ]);
});

test('search suggestions returns empty list when query is empty', function () {
    $response = $this->getJson(route('search.suggestions', ['q' => '']));

    $response->assertStatus(200);
    $response->assertJson([
        'results' => [],
        'total' => 0,
    ]);
});

test('homepage renders functional banner search form and input', function () {
    $response = $this->get(route('home'));

    $response->assertStatus(200);
    $response->assertSee('action="'.route('search').'"', false);
    $response->assertSee('name="q"', false);
    $response->assertSee('id="bannerSearchInput"', false);
});

test('search page renders single navbar without duplicates', function () {
    $response = $this->get(route('search'));

    $response->assertStatus(200);
    // Assert title and content rendered without duplicate nav tags
    $content = $response->getContent();
    $navbarCount = substr_count($content, '<nav class="sticky top-0');
    expect($navbarCount)->toBe(1);
});
