<?php

namespace App\Http\Controllers\Customer\PersonalProfile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CustomerPersonalDashboardController extends Controller
{
    public function index_personal_profile()
    {
        return view('customer.personal-dashboard.index-personal-profile');
    }


    public function show_personal_info()
    {
        return view('customer.personal-dashboard.show-personal-info');
    }
}
