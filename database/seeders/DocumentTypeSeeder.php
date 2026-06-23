<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DocumentType;
class DocumentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $documenttypes = ['Driver License', 'International Passport', 'National ID', 'Voters Card'];
        foreach ($documenttypes as $documenttype)
            Role::create([
                'label' => $documenttype,
                'published' => true,
            ]);
    }
}
