<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'OTT Subscriptions', 'slug' => 'ott-subscriptions', 'status' => true],
            ['name' => 'VPN & Security', 'slug' => 'vpn-security', 'status' => true],
            ['name' => 'Software & License Keys', 'slug' => 'software-license-keys', 'status' => true],
            ['name' => 'AI & Productivity', 'slug' => 'ai-productivity', 'status' => true],
            ['name' => 'Gaming & Gift Cards', 'slug' => 'gaming-gift-cards', 'status' => true],
            ['name' => 'Educational & Learning', 'slug' => 'educational-learning', 'status' => true],
        ];

        foreach ($categories as $cat) {
            Category::updateOrCreate(['slug' => $cat['slug']], $cat);
        }
    }
}
