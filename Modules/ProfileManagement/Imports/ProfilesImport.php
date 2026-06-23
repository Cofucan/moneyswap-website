<?php

namespace Modules\ProfileManagement\Imports;

use Modules\ProfileManagement\Entities\Profile;
use Modules\ProfileManagement\Entities\Person;
use Modules\ProfileManagement\Traits\ProfileTrait;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProfilesImport implements ToCollection, WithHeadingRow
{
    use ProfileTrait;
    /**
    * @param array $row
    *
    * 
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) 
        {
            $this->person = Person::create([
                'salutation'     => $row['salutation'],
                'last_name'    => $row['last_name'],
                'first_name'    => ucfirst($row['first_name']),
                'middle_name'    => $row['middle_name'],
                'birthday'    => $row['birthday'],
                'gender'    => $row['gender'],
                'marital_status'    => $row['marital_status'],
                'birthplace'    => $row['birthplace'],
                'religion'    => $row['religion'],
                'primary_language'    => $row['primary_language'],
                'nationality'    => $row['nationality'],
                'state_of_origin_id'    => $row['state_of_origin_id'],
                // 'birth_sequence'    => $row['birth_sequence'],
                'avatar'    => $row['avatar'],
            ]);
            $this->person->first_name = $row['first_name'];
            Profile::create([
                'person_id'     => $this->person->id,
                'referral_code'     => $this->getReferralCode(),
                'name'    => $row['profile_name'],
                'role_category_id'    => $row['role_category_id'],
                'profile_id'    => 0,
                'email'    => $row['email'],
                'telephone'    => $row['telephone'],                
                'status'    => $row['status'],
            ]);
        }
    }

    public function batchSize(): int
    {
        return 200;
    }
    public function chunkSize(): int
    {
        return 50;
    }
}
