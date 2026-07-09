<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Identity\User;
use App\Services\Customer\CustomerContextService;
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


    public function switch(Request $request, CustomerContextService $context)
    {
        /** @var User $user */
        $user = Auth::user();

        $customerProfileId = $request->integer('customer_profile_id');

        if (!$user->hasCustomerProfile($customerProfileId)) {
            abort(403);
        }

        $context->setById($customerProfileId);

        return redirect()->route('customer.dashboard');
    }
}
