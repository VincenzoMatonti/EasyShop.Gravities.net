<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Queries\Customer\GetCustomerEntryStateQuery;

class CustomerController extends Controller
{
    public function index(GetCustomerEntryStateQuery $query)
    {
        $state = $query->execute($this->user());

        return view('customer.index', compact('state'));
    }
}
