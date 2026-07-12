<?php

namespace App\Http\Controllers\Customer\PersonalProfile;

use App\Http\Controllers\Controller;
use App\Queries\Customer\GetPersonalAddressesQuery;
use App\Queries\Customer\GetPersonalProfileInfoQuery;
use App\Queries\Customer\GetPersonalProfileMenuDashboardQuery;
use App\Queries\Customer\GetPersonalProfileStatusQuery;

class CustomerPersonalDashboardController extends Controller
{
    public function index_personal_profile(GetPersonalProfileStatusQuery $query, GetPersonalProfileMenuDashboardQuery $query_menu)
    {
        $status = $query->execute();
        $dashboard = $query_menu->execute();
        return view('customer.personal-dashboard.index-personal-profile',compact(['status','dashboard']));
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
