<?php

namespace App\Http\Controllers\Customer;

use App\Actions\Customer\CreatePersonalCustomerProfileAction;
use App\Actions\Customer\SwitchCustomerProfileAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\CreatePersonalCustomerProfileRequest;
use Illuminate\Http\Request;

class CustomerProfileController extends Controller
{
    public function create()
    {
        return view('customer.profile.create');
    }

    public function store(CreatePersonalCustomerProfileRequest $request, CreatePersonalCustomerProfileAction $action)
    {
        $action->execute($request->dto($this->user()));

        return redirect()->route('customer.index');
    }

    public function select()
    {
        $profiles = $this->user()->getActiveCustomerProfiles();

        return view('customer.profile.select', compact('profiles'));
    }


    public function switch(Request $request, SwitchCustomerProfileAction $action)
    {
        $action->execute($this->user(), $request->integer('customer_profile_id'));

        return redirect()->route('customer.index');
    }
}
