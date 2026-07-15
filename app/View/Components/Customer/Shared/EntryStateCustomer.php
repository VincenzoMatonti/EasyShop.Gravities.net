<?php

namespace App\View\Components\Customer\Shared;

use App\ViewModels\Customer\Shared\EntryState\CustomerEntryViewModel;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class EntryStateCustomer extends Component
{
    public function __construct(
        public CustomerEntryViewModel $state
    ) {}

    public function render(): View|Closure|string
    {
        return view('components.customer.shared.entry-state-customer');
    }
}
