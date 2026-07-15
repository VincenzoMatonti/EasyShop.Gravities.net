<?php

namespace App\Exceptions\Customer\Personal;

use RuntimeException;

class PersonalCustomerProfileAlreadyExistsException extends RuntimeException
{
    public function __construct()
    {
        parent::__construct('Personal customer profile already exists.');
    }
}
