<?php

namespace App\View\Components\Customer\PersonalProfile;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class EmptyState extends Component
{
    public function __construct(
        public readonly string $title,
        public readonly ?string $description = null,
        public readonly string $icon = '📭',
    ) {
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.customer.personal-profile.empty-state');
    }
}
