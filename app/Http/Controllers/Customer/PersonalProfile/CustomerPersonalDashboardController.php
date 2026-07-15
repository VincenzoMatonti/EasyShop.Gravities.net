<?php

namespace App\Http\Controllers\Customer\PersonalProfile;

use App\Http\Controllers\Controller;
use App\Queries\Customer\Personal\Addresses\GetPersonalAddressesQuery;
use App\Queries\Customer\Personal\Dashboard\GetPersonalProfileMenuDashboardQuery;
use App\Queries\Customer\Personal\Profile\GetPersonalProfileInfoQuery;

class CustomerPersonalDashboardController extends Controller
{
    public function index_personal_profile(GetPersonalProfileMenuDashboardQuery $query_menu)
    {
        $dashboard = $query_menu->execute();
        return view('customer.personal.dashboard.index',compact('dashboard'));
    }

    public function show_personal_info(GetPersonalProfileInfoQuery $query)
    {
        $profile = $query->execute();
        return view('customer.personal.dashboard.show-personal-info',compact('profile'));
    }

    public function show_personal_addresses(GetPersonalAddressesQuery $query)
    {
        $addresses = $query->execute();
        return view('customer.personal.dashboard.show-personal-addresses', compact('addresses'));
    }
}
