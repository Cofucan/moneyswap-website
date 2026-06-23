<?php

namespace Modules\MemberManagement\Entities;

use Illuminate\Database\Eloquent\Model;

class MemberFee extends Model
{
    //
    protected $fillable = [
        'program_id',
        'member_stage',
        'fee_type_id',
        'amount_due',
        'payment_sequence',
        'published'
        ];

        protected $attributes =
            [
                'published' => '1',
                'payment_sequence' => '1',
            ];
    public function Program()
    {
        return $this->belongsTo('Modules\SchoolManagement\Entities\Program');
    }

    public function FeeType()
    {
        return $this->belongsTo(FeeType::class);
    }
}
