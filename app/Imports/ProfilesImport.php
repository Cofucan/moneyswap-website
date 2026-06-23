<?php

namespace App\Imports;

use App\Profile;
use Maatwebsite\Excel\Concerns\ToModel;

class ProfilesImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Profile([
            //
        ]);
    }
}
