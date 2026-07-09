<?php

namespace App\Http\Controllers\Customer;

use App\Actions\Customer\SwitchCustomerProfileAction;
use App\Http\Controllers\Controller;
use App\Models\Identity\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerProfileController extends Controller
{
    public function create()
    {
        return view('customer.profile.create');
    }

    public function select()
    {
        /** @var User $user */
        $user = Auth::user();

        $profiles = $user->getActiveCustomerProfiles();

        return view('customer.profile.select', compact('profiles'));
    }


    public function switch(Request $request, SwitchCustomerProfileAction $action)
    {
        /** @var User $user */
        $user = Auth::user();

        $action->execute($user,$request->integer('customer_profile_id'));

        return redirect()->route('customer.index');
    }
}
