<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\ContentManagement\Entities\ContentSection;

class ContentSectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sections = [
            [
                'page' => 'home',
                'section_key' => 'why-us',
                'type' => 'split',
                'headline' => null,
                'subtext' => null,
                'display_order' => 1,
                'published' => true,
            ],
            [
                'page' => 'home',
                'section_key' => 'home-how-it-works',
                'type' => 'grid',
                'headline' => 'Get Started with <strong>Moneyswap app</strong>',
                'subtext' => null,
                'display_order' => 2,
                'published' => true,
            ],
            [
                'page' => 'home',
                'section_key' => 'home-services',
                'type' => 'grid',
                'headline' => 'Built for Everyday and Cross-Border Needs',
                'subtext' => null,
                'display_order' => 3,
                'published' => true,
            ],
            [
                'page' => 'home',
                'section_key' => 'home-cta-1',
                'type' => 'cta',
                'headline' => 'Your Money, Handled Responsibly',
                'subtext' => '<p>MoneySwap applies industry-standard security practices and works with regulated partners to support secure transactions and responsible fund handling.</p><small>Service availability depends on jurisdiction and regulatory requirements</small>',
                'image' => 'img/banner/spend-money.png',
                'display_order' => 4,
                'published' => true,
            ],
            [
                'page' => 'home',
                'section_key' => 'home-cta-2',
                'type' => 'cta',
                'headline' => 'You\'re in Safe Company',
                'subtext' => '<p>Moneyswap is a versatile solution that empower you to utilize funds in your wallet as you desire.</p>',
                'image' => 'img/banner/safe-hand.png',
                'display_order' => 5,
                'published' => true,
            ],
        ];

        foreach ($sections as $section) {
            ContentSection::updateOrCreate(
                ['page' => $section['page'], 'section_key' => $section['section_key']],
                $section
            );
        }
    }
}
