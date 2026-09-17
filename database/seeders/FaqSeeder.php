<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faqs = [
            [
                'question' => 'How quickly will I receive my product after payment?',
                'answer' => 'Most digital subscriptions are activated within 5 to 15 minutes after payment confirmation. In rare cases, it can take up to 1 hour.',
                'order' => 1,
                'status' => true,
            ],
            [
                'question' => 'Are these accounts fully official and personal?',
                'answer' => 'Yes, all products provided by DigiGo are 100% official accounts or activations applied directly to your personal email account.',
                'order' => 2,
                'status' => true,
            ],
            [
                'question' => 'What payment methods do you accept in Bangladesh?',
                'answer' => 'We accept all local payment methods including bKash, Nagad, Rocket, as well as Visa/Mastercard cards via SSLCommerz gateway.',
                'order' => 3,
                'status' => true,
            ],
        ];

        foreach ($faqs as $faq) {
            Faq::create($faq);
        }
    }
}
