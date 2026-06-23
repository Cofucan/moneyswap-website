<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Currency;
class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $currencies = [
            [
                'country_id'         => 154,
                'label'       => 'Naira',
                'code' => 'NGN',
            ],
            [
                'country_id'         => 229,
                'label'       => 'US Dollars',
                'code' => 'USD',
            ],

            [
                'id'         => 13,
                'label'       => 'Australian Dollar',
                'code' => 'AUD',
            ],

            [
                'country_id'         => 55,
                'label'       => 'Czech Koruna',
                'code' => 'CZK',
            ],

            [
                'country_id'         => 57,
                'label'       => 'Danish Kron',
                'code' => 'DKK',
            ],

            [
                'country_id'         => 79,
                'label'       => 'Ghanian Cedes',
                'code' => 'CED',
            ],

            [
                'country_id'         => 92,
                'label'       => 'Hong Kong Dollar',
                'code' => 'HKD',
            ],
            [
                'country_id'         => 93,
                'label'       => 'Hungarian Forint',
                'code' => 'HUF',
            ],

            [
                'country_id'         => 95,
                'label'       => 'Indian Rupee',
                'code' => 'INR',
            ],
            [
                'country_id'         => 96,
                'label'       => 'Indonesian Rupiah',
                'code' => 'IDR',
            ],

            [
                'country_id'         => 101,
                'label'       => 'Israeli New Shekel',
                'code' => 'ILS',
            ],


            [
                'country_id'         => 151,
                'label'       => 'New Zealand Dollar',
                'code' => 'NZD',
            ],

            [
                'country_id'         => 167,
                'label'       => 'Philippines Peso',
                'code' => 'PHP',
            ],

            [
                'country_id'         => 169,
                'label'       => 'Polish Zloty',
                'code' => 'PLN',
            ],



            [
                'country_id'         => 193,
                'label'       => 'Singapore Dollar',
                'code' => 'SGD',
            ],

            [
                'country_id'         => 195,
                'label'       => 'Slovakia',
                'code' => 'sk',
            ],
            [
                'country_id'         => 196,
                'label'       => 'Euro',
                'code' => 'EUR',
            ],

            [
                'country_id'         => 199,
                'label'       => 'South African Rand',
                'code' => 'ZAR',
            ],

            [
                'country_id'         => 202,
                'label'       => 'Euro',
                'code' => 'EUR',
            ],

            [
                'country_id'         => 214,
                'label'       => 'Thai Baht',
                'code' => 'THB',
            ],

            [
                'country_id'         => 228,
                'label'       => 'Pound Sterling',
                'code' => 'GBP',
            ],


        ];

        Currency::insert($currencies);
    }
}
