<?php

namespace App\Exceptions\Customer;

use RuntimeException;

class PersonalCustomerProfileAlreadyExistsException extends RuntimeException
{
    public function __construct()
    {
        parent::__construct('Hai già un profilo personale associato al tuo account.');
    }
}
