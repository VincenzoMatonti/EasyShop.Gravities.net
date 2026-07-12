<?php

namespace App\View\Components\Customer\Dashboard;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MenuCard extends Component
{
    public function __construct(
        public readonly string $route,
        public readonly string $title,
        public readonly string $icon,
        public readonly ?string $description = null,
        public readonly string $style = 'primary',
    ) {}
    
    public function render(): View|Closure|string
    {
        return view('components.customer.personal-profile.menu-card');
    }
}
