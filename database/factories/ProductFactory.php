<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->unique()->words(3, true);

        return [
            //
            'category_id' => Category::factory(),
            'name' => ucwords($name),
            'slug' => Str::slug($name),
            'short_description' => fake()->sentence(),
            'old_price' => fake()->randomElement([499, 999, 1499, 2499]),
            'price' => fake()->randomElement([199, 299, 499, 1199]),
            'status' => true,
            'badge' => fake()->randomElement(['Official', 'Popular', 'Trending', 'Hot Deal', 'Cloud', 'Audio', 'OTT', null]),
            'product_image' => null,
            'product_description' => '<p>'.fake()->paragraph().'</p>',
        ];
    }
}
