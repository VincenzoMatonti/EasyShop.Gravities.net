<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CustomerProfileController extends Controller
{
    public function create()
    {
        return view('customer.profile.create');
    }

    public function select()
    {
        return view('customer.profile.select');
    }
}
