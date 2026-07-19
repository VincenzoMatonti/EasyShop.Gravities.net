<?php

namespace App\ViewModels\Customer\Personal\Addresses;

class PersonalAddressesViewModel
{
    public function __construct(
        public readonly array $shippingAddresses,
        public readonly array $billingAddresses,
    ) {}

    public function headerTitle(): string
    {
        return 'Indirizzi personali';
    }

    public function headerSubtitle(): string
    {
        return 'Consulta e gestisci gli indirizzi del tuo account.';
    }

    public function sections(): array
    {
        return [
            [
                'title' => $this->shippingSectionTitle(),
                'icon' => '🚚',
                'addresses' => $this->shippingAddresses,
            ],
            [
                'title' => $this->billingSectionTitle(),
                'icon' => '🧾',
                'addresses' => $this->billingAddresses,
            ],
        ];
    }

    public function hasAddresses(array $addresses): bool
    {
        return ! empty($addresses);
    }

    public function emptyTitle(): string
    {
        return 'Nessun indirizzo disponibile';
    }

    public function emptyDescription(): string
    {
        return 'Aggiungi un indirizzo per completare il tuo profilo.';
    }

    private function shippingSectionTitle(): string
    {
        return 'Indirizzi di spedizione';
    }

    private function billingSectionTitle(): string
    {
        return 'Indirizzi di fatturazione';
    }
}
