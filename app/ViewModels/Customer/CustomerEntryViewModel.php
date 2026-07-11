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
}
