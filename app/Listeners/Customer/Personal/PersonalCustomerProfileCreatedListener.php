<?php

namespace App\Listeners\Customer\Personal;

use App\Events\Customer\Personal\PersonalCustomerProfileCreated;
use App\Jobs\Customer\Personal\SendPersonalProfileCreatedMailJob;

class PersonalCustomerProfileCreatedListener
{
    public function __construct() {}

    /**
     * Handle the event.
     */
    public function handle(PersonalCustomerProfileCreated $event): void
    {
        SendPersonalProfileCreatedMailJob::dispatch(
            profileId: $event->profileId,
            userId: $event->userId
        );
    }
}
