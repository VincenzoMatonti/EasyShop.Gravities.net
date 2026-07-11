<?php

namespace App\Http\Controllers;

use App\Models\Identity\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

abstract class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected function user(): User
    {
        /** @var User $user */
        $user = Auth::user();

        return $user;
    }
}
