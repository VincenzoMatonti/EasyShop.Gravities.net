<?php

namespace App\Queries\Customer\Personal\Profile;

use App\Services\Customer\CustomerContextService;
use App\ViewModels\Customer\Personal\Profile\PersonalProfileInfoViewModel;

class GetPersonalProfileInfoQuery
{
     public function __construct(
        private CustomerContextService $context,
    ) {}

    public function execute(): PersonalProfileInfoViewModel
    {
        $profile = $this->context->current();

        $user = $profile->users()->first();

        $info = $user->userInfo;

        $email = $user->emails()->where('is_primary', true)->first();

        $phone = $user->phones()->where('is_primary', true)->first();

        return new PersonalProfileInfoViewModel(
            name: $info->name,
            surname: $info->surname,
            taxCode: $info->tax_code,
            birthDate: optional($info->birth_date)?->format('d/m/Y'),
            email: $email->email,
            emailVerified: (bool) $email->verified_at,
            phone: $phone ? "{$phone->prefix} {$phone->number}" : null,
            phoneVerified: (bool) optional($phone)->verified_at,
        );
    }
}
