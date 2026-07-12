<?php

namespace App\ViewModels\Customer;

use App\Enum\Customer\PersonalProfileBadgeType;

class PersonalProfileInfoViewModel
{
    public function __construct(
        public readonly string $name,
        public readonly string $surname,
        public readonly ?string $taxCode,
        public readonly ?string $birthDate,
        public readonly string $email,
        public readonly bool $emailVerified,
        public readonly ?string $phone,
        public readonly bool $phoneVerified,
    ) {}

    public function personalInfoRows(): array
    {
        return [
            [
                'label' => 'Nome',
                'value' => $this->name,
            ],
            [
                'label' => 'Cognome',
                'value' => $this->surname,
            ],
            [
                'label' => 'Codice fiscale',
                'value' => $this->taxCode,
            ],
            [
                'label' => 'Data di nascita',
                'value' => $this->formattedBirthDate(),
            ],
        ];
    }

    public function sections(): array
    {
        return [
            [
                'title' => 'Dati anagrafici',
                'icon' => '👤',
                'rows' => $this->personalInfoRows(),
            ],
            [
                'title' => 'Email',
                'icon' => '✉️',
                'rows' => $this->emailRows(),
                'badge' => [
                    'label' => $this->emailStatusLabel(),
                    'type' => $this->emailStatusType(),
                ],
            ],
            [
                'title' => 'Telefono',
                'icon' => '📱',
                'rows' => $this->phoneRows(),
                'badge' => [
                    'label' => $this->phoneStatusLabel(),
                    'type' => $this->phoneStatusType(),
                ],
            ],
        ];
    }

    public function emailRows(): array
    {
        return [
            [
                'label' => 'Email principale',
                'value' => $this->email,
            ],
        ];
    }
    public function emailStatusLabel(): string
    {
        return $this->emailVerified ? 'Verificata' : 'Da verificare';
    }

    public function emailStatusType(): PersonalProfileBadgeType
    {
        return $this->emailVerified ? PersonalProfileBadgeType::Success : PersonalProfileBadgeType::Warning;
    }

    public function phoneRows(): array
    {
        return [
            [
                'label' => 'Telefono principale',
                'value' => $this->formattedPhone(),
            ],
        ];
    }

    public function phoneStatusLabel(): string
    {
        return $this->phoneVerified ? 'Verificato' : 'Da verificare';
    }

    public function phoneStatusType(): PersonalProfileBadgeType
    {
        return $this->phoneVerified ? PersonalProfileBadgeType::Success : PersonalProfileBadgeType::Warning;
    }

    public function formattedPhone(): string
    {
        return $this->phone ?? '-';
    }

    public function formattedBirthDate(): string
    {
        return $this->birthDate ?? '-';
    }
}
