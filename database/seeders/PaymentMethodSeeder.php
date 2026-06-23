<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PaymentMethod;
class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $paymentmethods = ['Cause', 'Online', 'Transfer'];
        foreach ($paymentmethods as $paymentmethod)
            PaymentMethod::create([
                'code' => $paymentmethod,
                'published' => true,
            ]);
    }
}
