<?php

namespace App\Http\Requests\Customer\Shared;

use App\Dtos\Customer\Shared\SwitchCustomerProfileData;
use App\Models\Identity\User;
use Illuminate\Foundation\Http\FormRequest;

class SwitchCustomerProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return ['customer_profile_id' => ['required', 'integer']];
    }

    public function dto(User $user): SwitchCustomerProfileData
    {
        return new SwitchCustomerProfileData(
            user: $user,
            customerProfileId: $this->integer('customer_profile_id'),
        );
    }
}
