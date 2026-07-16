<?php

namespace App\View\Components\Customer\PersonalProfile;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class BackButton extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public readonly string $route,
        public readonly string $label = 'Indietro',
    ) {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.customer.personal-profile.back-button');
    }
}
