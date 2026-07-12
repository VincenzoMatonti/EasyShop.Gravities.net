<?php

namespace App\Queries\Customer;

use App\ViewModels\Customer\PersonalProfileMenuDashboardViewModel;

class GetPersonalProfileMenuDashboardQuery
{
    public function __construct(
        private readonly GetPersonalProfileStatusQuery $statusQuery,
    ) {}


    public function execute(): PersonalProfileMenuDashboardViewModel
    {
        return new PersonalProfileMenuDashboardViewModel(
            status: $this->statusQuery->execute(),
        );
    }
}