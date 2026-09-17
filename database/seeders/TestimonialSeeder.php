<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $testimonials = [
            [
                'name' => 'Ariful Hasan',
                'designation' => 'Software Engineer',
                'comment' => 'Khub fast activation peyechi! Office 365 Personal er subscription payment korar 10 min er moddhe email e chole esheche. Highly recommended!',
                'rating' => 5,
                'avatar' => null,
                'status' => true,
            ],
            [
                'name' => 'Siam Islam',
                'designation' => 'Content Creator',
                'comment' => 'YouTube Premium and Spotify buy koresilam. Product pura official ebong ekono smooth choltese. Support team tao khub helpful.',
                'rating' => 5,
                'avatar' => null,
                'status' => true,
            ],
            [
                'name' => 'Tanvir Ahmed',
                'designation' => 'Digital Marketer',
                'comment' => 'Best digital subscription site in BD! Price compare korle onek shasroymoyi ebong service oo 100% genuine.',
                'rating' => 5,
                'avatar' => null,
                'status' => true,
            ],
        ];

        foreach ($testimonials as $testimonial) {
            Testimonial::create($testimonial);
        }
    }
}
