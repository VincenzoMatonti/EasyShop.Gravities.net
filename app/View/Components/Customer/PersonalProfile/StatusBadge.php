<?php

namespace App\View\Components\Customer\PersonalProfile;

use App\Enum\Customer\PersonalProfileBadgeType;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class StatusBadge extends Component
{
    public function __construct(
        public readonly string $label,
        public readonly PersonalProfileBadgeType $type = PersonalProfileBadgeType::Secondary,
    ) {}

    public function cssClass(): string
    {
        return match ($this->type) {
            PersonalProfileBadgeType::Success => 'bg-success',
            PersonalProfileBadgeType::Warning => 'bg-warning text-dark',
            PersonalProfileBadgeType::Danger => 'bg-danger',
            PersonalProfileBadgeType::Secondary => 'bg-secondary',
        };
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.customer.personal-profile.status-badge');
    }
}
