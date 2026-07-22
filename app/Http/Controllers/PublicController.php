<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

class PublicController extends Controller
{
    public function index(): View
    {
        return view('home.index');
    }

    public function not_found(): View
    {
        return view('utils.not-found');
    }
}
