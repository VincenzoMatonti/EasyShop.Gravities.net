<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Actions\Customer\SwitchCustomerProfileAction;
use App\Queries\Customer\GetActiveCustomerProfilesQuery;
use App\Http\Requests\Customer\SwitchCustomerProfileRequest;
use App\Queries\Customer\GetCustomerEntryStateQuery;

class CustomerProfileController extends Controller
{
    public function index(GetCustomerEntryStateQuery $query)
    {
        $state = $query->execute($this->user());

        return view('customer.index', compact('state'));
    }

    public function select(GetActiveCustomerProfilesQuery $query)
    {
        $profiles = $query->execute($this->user());

        return view('customer.select', compact('profiles'));
    }


    public function switch(SwitchCustomerProfileRequest $request, SwitchCustomerProfileAction $action)
    {
        $action->execute($request->dto($this->user()));

        return redirect()->route('customer.index');
    }
}
