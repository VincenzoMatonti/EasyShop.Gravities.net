<?php

namespace App\Queries\Customer\Personal\Addresses;

use App\Enum\Customer\LabelAddress;
use App\Enum\Customer\PersonalProfileBadgeType;
use App\Models\Customer\Address;
use App\Services\Customer\CustomerContextService;
use App\ViewModels\Customer\Personal\Addresses\PersonalAddressesViewModel;

class GetPersonalAddressesQuery
{
    public function __construct(
        private readonly CustomerContextService $context,
    ) {}


    public function execute(): PersonalAddressesViewModel
    {
        $profile = $this->context->current();

        if (!$profile) {
            abort(403);
        }

        $addresses = $profile->addresses()->where('is_deleted', false)->get();

        $shippingAddresses = $addresses->filter(fn(Address $address) => $address->label === LabelAddress::Shipping)->map($this->mapAddress(...))->values()->toArray();

        $billingAddresses = $addresses->filter(fn(Address $address) => $address->label === LabelAddress::Billing)->map($this->mapAddress(...))->values()->toArray();

        return new PersonalAddressesViewModel(
            shippingAddresses: $shippingAddresses,
            billingAddresses: $billingAddresses,
        );
    }



    private function mapAddress(Address $address): array
    {
        return [
            'id' => $address->id,
            'rows' => [
                [
                    'label' => 'Indirizzo',
                    'value' => "{$address->street} {$address->number}",
                ],
                [
                    'label' => 'CAP',
                    'value' => $address->zip_code,
                ],
                [
                    'label' => 'Città',
                    'value' => $address->city,
                ],
                [
                    'label' => 'Provincia',
                    'value' => $address->province,
                ],
                [
                    'label' => 'Paese',
                    'value' => $address->country,
                ],
            ],

            'badge' => $address->is_default ? ['label' => 'Indirizzo predefinito', 'type' => PersonalProfileBadgeType::Success,] : null,
        ];
    }
}
