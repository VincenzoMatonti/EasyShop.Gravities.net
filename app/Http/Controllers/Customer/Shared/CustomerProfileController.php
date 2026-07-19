<?php

namespace App\Http\Controllers\Customer\Shared;

use App\Actions\Customer\Shared\SwitchCustomerProfileAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\Shared\SwitchCustomerProfileRequest;
use App\Queries\Customer\Shared\EntryState\GetCustomerEntryStateQuery;
use App\Queries\Customer\Shared\SelectState\GetActiveCustomerProfilesQuery;

class CustomerProfileController extends Controller
{
    public function index(GetCustomerEntryStateQuery $query)
    {
        $state = $query->execute($this->user());

        return view('customer.shared.index', compact('state'));
    }

    public function select(GetActiveCustomerProfilesQuery $query)
    {
        $profiles = $query->execute($this->user());

        return view('customer.shared.select', compact('profiles'));
    }

    public function switch(SwitchCustomerProfileRequest $request, SwitchCustomerProfileAction $action)
    {
        $action->execute($request->dto($this->user()));

        return redirect()->route('customer.dashboard');
    }
}
