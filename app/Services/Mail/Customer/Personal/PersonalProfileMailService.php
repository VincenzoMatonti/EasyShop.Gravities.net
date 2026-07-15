<?php

namespace App\Services\Mail\Customer\Personal;

use App\Mail\Customer\Personal\PersonalProfileCreatedMail;
use Illuminate\Support\Facades\Mail;

class PersonalProfileMailService
{
    /**
     * Create a new class instance.
     */
    public function __construct() {}

    public function sendProfileCreated(string $email, string $customerName, string $profileUrl): void
    {
        Mail::to($email)->queue(new PersonalProfileCreatedMail(customerName: $customerName, url: $profileUrl));
    }
}
