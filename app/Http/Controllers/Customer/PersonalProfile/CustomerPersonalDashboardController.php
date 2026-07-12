<?php

namespace App\Http\Controllers\Customer\PersonalProfile;

use App\Http\Controllers\Controller;
use App\Queries\Customer\GetPersonalAddressesQuery;
use App\Queries\Customer\GetPersonalProfileInfoQuery;

class CustomerPersonalDashboardController extends Controller
{
    public function index_personal_profile()
    {
        return view('customer.personal-dashboard.index-personal-profile');
    }

    public function show_personal_info(GetPersonalProfileInfoQuery $query)
    {
        $profile = $query->execute();
        return view('customer.personal-dashboard.show-personal-info',compact('profile'));
    }

    public function show_personal_addresses(GetPersonalAddressesQuery $query)
    {
        $addresses = $query->execute();
        return view('customer.personal-dashboard.show-personal-addresses', compact('addresses'));
    }
}
