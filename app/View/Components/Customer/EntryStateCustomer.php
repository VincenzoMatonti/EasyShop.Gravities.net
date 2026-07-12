<?php

namespace App\View\Components\Customer;

use App\ViewModels\Customer\CustomerEntryViewModel;
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
        return view('components.customer.entry-state-customer');
    }
}
