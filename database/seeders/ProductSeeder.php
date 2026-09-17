<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $categories = Category::all()->keyBy('slug');

        $products = [
            [
                'category_id' => $categories['software-license-keys']->id ?? null,
                'name' => 'Office 365 Personal',
                'slug' => 'office-365-personal',
                'short_description' => 'Includes 1TB to 5TB OneDrive storage with full premium apps suite.',
                'old_price' => 2500,
                'price' => 1199,
                'status' => true,
                'badge' => 'Official',
                'product_image' => null,
                'product_description' => '<h3>Microsoft 365 Personal Subscription</h3><p>Get authentic Microsoft 365 license with 1TB cloud storage, Word, Excel, PowerPoint, Outlook, and instant delivery.</p><ul><li>100% Genuine Retail License</li><li>Auto-updates enabled</li><li>Multi-device support (Windows, Mac, Android, iOS)</li></ul>',
            ],
            [
                'category_id' => $categories['ott-subscriptions']->id ?? null,
                'name' => 'YouTube Premium',
                'slug' => 'youtube-premium',
                'short_description' => 'Ad-free videos, background play, and YouTube Music Premium access.',
                'old_price' => 499,
                'price' => 249,
                'status' => true,
                'badge' => 'Popular',
                'product_image' => null,
                'product_description' => '<h3>YouTube Premium Family / Individual Plan</h3><p>Enjoy YouTube without any annoying advertisements. Watch videos offline and keep music playing in the background.</p>',
            ],
            [
                'category_id' => $categories['ott-subscriptions']->id ?? null,
                'name' => 'Spotify Premium',
                'slug' => 'spotify-premium',
                'short_description' => 'Offline listening, high quality audio, no ad interruptions.',
                'old_price' => 399,
                'price' => 199,
                'status' => true,
                'badge' => 'Official',
                'product_image' => null,
                'product_description' => '<h3>Spotify Premium Individual / Duo Plan</h3><p>Stream millions of songs and podcasts ad-free in crystal-clear high bitrate audio quality.</p>',
            ],
            [
                'category_id' => $categories['ai-productivity']->id ?? null,
                'name' => 'ChatGPT Plus',
                'slug' => 'chatgpt-plus',
                'short_description' => 'Access GPT-4o, DALL-E 3 image generation, and custom GPTs.',
                'old_price' => 2600,
                'price' => 1899,
                'status' => true,
                'badge' => 'Trending',
                'product_image' => null,
                'product_description' => '<h3>OpenAI ChatGPT Plus Subscription</h3><p>Unleash the power of cutting-edge AI for coding, writing, research, and analysis.</p>',
            ],
            [
                'category_id' => $categories['vpn-security']->id ?? null,
                'name' => 'NordVPN 1-Year',
                'slug' => 'nordvpn-1-year',
                'short_description' => 'Ultra-fast secure VPN with Threat Protection & Meshnet.',
                'old_price' => 3200,
                'price' => 1499,
                'status' => true,
                'badge' => 'Official',
                'product_image' => null,
                'product_description' => '<h3>NordVPN Premium Account</h3><p>Protect your online privacy with 6000+ high-speed servers across 110+ countries.</p>',
            ],
        ];

        foreach ($products as $prod) {
            Product::updateOrCreate(['slug' => $prod['slug']], $prod);
        }
    }
}
