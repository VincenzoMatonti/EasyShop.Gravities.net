<?php

namespace App\Services\System\Exception;

use Throwable;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Exceptions\Customer\Personal\PersonalCustomerProfileAlreadyExistsException;
use App\Exceptions\Customer\Personal\PersonalProfileCreationException;

class ExceptionDecisionService
{
    public function handle(Throwable $exception, Request $request): ?Response
    {
        return match (true) {

            $exception instanceof PersonalCustomerProfileAlreadyExistsException =>
            redirect()->back()->with('error', $exception->getMessage()),

            $exception instanceof PersonalProfileCreationException =>
            redirect()->back()->withInput()->with('error', 'Non è stato possibile creare il profilo personale.'),

            default => null,
        };
    }
}
