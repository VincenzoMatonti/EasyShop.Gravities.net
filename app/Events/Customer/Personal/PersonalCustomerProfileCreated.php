<?php

namespace App\Events\Customer\Personal;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PersonalCustomerProfileCreated
{
    use Dispatchable, SerializesModels;

    public function __construct(public readonly int $profileId){}
}
