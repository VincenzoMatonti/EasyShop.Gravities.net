<?php

namespace App\Http\Requests\Customer;

use App\Dtos\Customer\CreatePersonalCustomerProfileData;
use App\Models\Identity\User;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CreatePersonalCustomerProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:50'],

            'surname' => ['required', 'string', 'max:50'],

            'phone_prefix' => ['nullable', 'string', 'max:10'],

            'phone' => ['nullable', 'string', 'max:20'],

            'tax_code' => ['nullable', 'string', 'size:16'],

            'birth_date' => ['nullable', 'date'],
        ];
    }

    public function dto(User $user): CreatePersonalCustomerProfileData
    {
        return new CreatePersonalCustomerProfileData(

            user: $user,

            name: $this->string('name'),

            surname: $this->string('surname'),

            phonePrefix: $this->input('phone_prefix'),

            phone: $this->input('phone'),

            taxCode: $this->input('tax_code'),

            birthDate: $this->date('birth_date'),

        );
    }
}
