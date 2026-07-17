<?php

namespace App\Providers;

use App\Events\Customer\Personal\PersonalCustomerProfileCreated;
use App\Listeners\Customer\Personal\PersonalCustomerProfileCreatedListener;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * Event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [

        PersonalCustomerProfileCreated::class => [PersonalCustomerProfileCreatedListener::class],

    ];
}
