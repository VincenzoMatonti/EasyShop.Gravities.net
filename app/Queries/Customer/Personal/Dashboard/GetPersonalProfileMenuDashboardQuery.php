<?php

namespace App\Queries\Customer\Personal\Dashboard;

use App\ViewModels\Customer\Personal\Dashboard\PersonalProfileMenuDashboardViewModel;

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
