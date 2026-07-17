<?php

namespace App\Services\Mail\Customer\Personal;

use App\Mail\Customer\Personal\PersonalProfileCreatedMail;
use App\Models\Customer\CustomerProfile;
use App\Models\Identity\User;
use Illuminate\Support\Facades\Mail;

class PersonalProfileMailService
{
    /**
     * Create a new class instance.
     */
    public function __construct() {}

    public function sendProfileCreated(User $user, CustomerProfile $profile): void
    {
        Mail::to($user->email)->queue(new PersonalProfileCreatedMail(customerName: $profile->name, url: route('customer.dashboard.personal')));
    }
}
