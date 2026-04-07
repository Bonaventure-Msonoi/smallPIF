<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBusinessSubmissionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'first_name' => ['required', 'string', 'max:255'],
            'other_names' => ['nullable', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'nrc' => ['required', 'string', 'max:255'],
            'man_number' => ['required', 'string', 'max:255'],
            'amount' => ['required', 'numeric', 'min:0'],
            'fund_name' => ['required', 'string', 'max:255'],
            'start_date' => ['required', 'date'],
            'phone_no' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'date_of_birth' => ['required', 'date'],
            'gender' => ['required', 'string', 'max:50'],
            'physical_address' => ['required', 'string'],
            'note' => ['nullable', 'string'],
        ];
    }

    public function attributes(): array
    {
        return [
            'first_name' => 'name',
            'other_names' => 'other',
            'man_number' => 'man number',
            'fund_name' => 'fund name',
            'start_date' => 'start date',
            'phone_no' => 'phone number',
            'date_of_birth' => 'date of birth',
            'physical_address' => 'physical address',
        ];
    }
}
