<?php

namespace App\ViewModels\Customer;

class PersonalAddressesViewModel
{
    public function __construct(
        public readonly array $shippingAddresses,
        public readonly array $billingAddresses,
    ) {}


    public function sections(): array
    {
        return [
            [
                'title' => $this->shippingTitle(),
                'icon' => '🚚',
                'addresses' => $this->shippingAddresses,
            ],
            [
                'title' => $this->billingTitle(),
                'icon' => '🧾',
                'addresses' => $this->billingAddresses,
            ],
        ];
    }

    public function hasAddresses(array $addresses): bool
    {
        return !empty($addresses);
    }


    public function emptyTitle(): string
    {
        return 'Nessun indirizzo disponibile';
    }


    public function emptyDescription(): string
    {
        return 'Aggiungi un indirizzo per completare il tuo profilo.';
    }


    public function shippingTitle(): string
    {
        return 'Indirizzi di spedizione';
    }


    public function billingTitle(): string
    {
        return 'Indirizzi di fatturazione';
    }
}
