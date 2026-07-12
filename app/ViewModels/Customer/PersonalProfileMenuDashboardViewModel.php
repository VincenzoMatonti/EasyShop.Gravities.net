<?php

namespace App\ViewModels\Customer;

class PersonalProfileMenuDashboardViewModel
{
    public function __construct(
        public readonly PersonalProfileStatusViewModel $status,
    ) {}


    public function menuItems(): array
    {
        return [
            [
                'route' => route('customer.dashboard.info.personal'),
                'icon' => '👤',
                'title' => 'Profilo personale',
                'description' => 'Dati anagrafici, telefono e informazioni personali',
                'style' => 'primary',
            ],
            [
                'route' => route('customer.dashboard.addresses.personal'),
                'icon' => '📦',
                'title' => 'Indirizzi',
                'description' => 'Gestisci gli indirizzi di spedizione e fatturazione',
                'style' => 'primary',
            ],
            [
                'route' => '#',
                'icon' => '🛒',
                'title' => 'Ordini',
                'description' => 'Consulta lo storico dei tuoi ordini e lo stato delle spedizioni',
                'style' => 'success',
            ],
            [
                'route' => route('customer.index'),
                'icon' => '⇦',
                'title' => 'Area cliente',
                'description' => 'Torna alla gestione generale del tuo account cliente',
                'style' => 'secondary',
            ],
        ];
    }
}
