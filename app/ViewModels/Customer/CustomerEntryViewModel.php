<?php

namespace App\ViewModels\Customer;

class CustomerEntryViewModel
{
    public function __construct(
        public readonly bool $hasProfiles,
        public readonly bool $hasDefaultProfile,
        public readonly int $profilesCount,
    ) {}

    public function showCreateProfile(): bool
    {
        return true;
    }

    public function showDashboard(): bool
    {
        return $this->hasDefaultProfile;
    }

    public function showProfileSelection(): bool
    {
        return $this->hasProfiles;
    }

    public function profileLabel(): string
    {
        return match (true) {
            !$this->hasProfiles => 'Nessun profilo creato',
            $this->profilesCount === 1 => '1 profilo disponibile',
            default => "{$this->profilesCount} profili disponibili",
        };
    }

    public function createProfileLabel(): string
    {
        return $this->hasProfiles ? 'Crea nuovo profilo' : 'Crea profilo';
    }
}
