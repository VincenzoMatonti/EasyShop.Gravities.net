<?php

namespace App\ViewModels\Customer\Shared\EntryState;

use App\Models\Customer\CustomerProfile;

class CustomerEntryViewModel
{
    public function __construct(
        public readonly bool $hasProfiles,
        public readonly bool $hasDefaultProfile,
        public readonly int $profilesCount,
        public readonly bool $hasPersonalProfile,
        public readonly ?CustomerProfile $defaultProfile,
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
        return $this->hasProfiles && $this->profilesCount > 1;
    }

    public function canCreatePersonalProfile(): bool
    {
        return ! $this->hasPersonalProfile;
    }

    public function profileLabel(): string
    {
        return match (true) {
            ! $this->hasProfiles => 'Nessun profilo creato',
            $this->profilesCount === 1 => '1 profilo disponibile',
            default => "{$this->profilesCount} profili disponibili",
        };
    }

    public function defaultProfileLabel(): ?string
    {
        if (! $this->defaultProfile) {
            return null;
        }

        return $this->defaultProfile->name;
    }

    public function createProfileLabel(): string
    {
        return $this->hasProfiles ? 'Nuovo profilo' : 'Crea profilo';
    }
}
