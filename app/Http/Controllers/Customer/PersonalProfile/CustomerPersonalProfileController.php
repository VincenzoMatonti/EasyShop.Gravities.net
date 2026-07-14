<?php

namespace App\Http\Controllers\Customer\PersonalProfile;

use App\Http\Controllers\Controller;
use App\Actions\Customer\Personal\CreatePersonalCustomerProfileAction;
use App\Http\Requests\Customer\Personal\CreatePersonalCustomerProfileRequest;

class CustomerPersonalProfileController extends Controller
{
    public function create_personal_profile()
    {
        return view('customer.personal-profile.create-personal-profile');
    }

    public function store_personal_profile(CreatePersonalCustomerProfileRequest $request, CreatePersonalCustomerProfileAction $action)
    {
        $action->execute($request->dto($this->user()));

        return redirect()->route('customer.index');
    }
}
