<?php

namespace App\Queries\Customer;

use App\Enum\Customer\LabelAddress;
use App\Models\Customer\UserInfo;
use App\Services\Customer\CustomerContextService;
use App\ViewModels\Customer\PersonalProfileStatusViewModel;

class GetPersonalProfileStatusQuery
{
    public function __construct(
        private readonly CustomerContextService $context,
    ) {}


    public function execute(): PersonalProfileStatusViewModel
    {
        $profile = $this->context->current();

        if (!$profile) {
            abort(403);
        }

        $user = $profile->users()->first();

        if (!$user) {
            abort(403);
        }

        $info = $user->userInfo;

        $email = $user->emails()->where('is_primary', true)->first();

        $phone = $user->phones()->where('is_primary', true)->first();

        $addresses = $profile->addresses()->Where('is_deleted', false)->get();

        $checks = [
            [
                'key' => 'personal_data',
                'label' => 'Dati anagrafici completati',
                'completed' => $this->hasPersonalData($info),
            ],
            [
                'key' => 'email',
                'label' => 'Email verificata',
                'completed' => (bool) optional($email)->verified_at,
            ],
            [
                'key' => 'phone',
                'label' => 'Telefono verificato',
                'completed' => (bool) optional($phone)->verified_at,
            ],
            [
                'key' => 'shipping_address',
                'label' => 'Indirizzo di spedizione presente',
                'completed' => $addresses
                    ->contains('label', LabelAddress::Shipping),
            ],
            [
                'key' => 'billing_address',
                'label' => 'Indirizzo di fatturazione presente',
                'completed' => $addresses
                    ->contains('label', LabelAddress::Billing),
            ],
        ];

        return new PersonalProfileStatusViewModel(
            checks: $checks,
        );
    }


    private function hasPersonalData(?UserInfo $info): bool
    {
        if (!$info) {
            return false;
        }

        return filled($info->name) && filled($info->surname) && filled($info->tax_code) && filled($info->birth_date);
    }
}
