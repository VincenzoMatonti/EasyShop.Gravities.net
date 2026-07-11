<?php

namespace App\Http\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;

class SwitchCustomerProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'customer_profile_id' => [
                'required',
                'integer',
                'exists:customer_profiles,id',
            ],
        ];
    }

    public function customerProfileId(): int
    {
        return $this->integer('customer_profile_id');
    }
}
