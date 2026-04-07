<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BusinessSubmission extends Model
{
    protected $fillable = [
        'first_name',
        'other_names',
        'surname',
        'nrc',
        'man_number',
        'amount',
        'fund_name',
        'start_date',
        'phone_no',
        'email',
        'date_of_birth',
        'gender',
        'physical_address',
        'note',
    ];

    protected function casts(): array
    {
        return [
            'start_date' => 'date',
            'date_of_birth' => 'date',
            'amount' => 'decimal:2',
        ];
    }
}
