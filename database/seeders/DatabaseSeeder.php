<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(
            [
            //BankSeeder::class,
            PaymentMethodSeeder::class,
            RoleSeeder::class,
            DocumentTypeSeeder::class,
            CountrySeeder::class,
            CurrencySeeder::class,
            StateSeeder::class,
            CitySeeder::class,
            ]
        );

    }
}
