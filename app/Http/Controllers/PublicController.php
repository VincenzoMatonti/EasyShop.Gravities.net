<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function index()
    {
        return view('home.index');
    }

    public function not_found()
    {
        return view('utils.not-found');
    }
}
