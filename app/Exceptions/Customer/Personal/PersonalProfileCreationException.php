<?php

namespace App\Exceptions\Customer\Personal;

use RuntimeException;
use Throwable;

class PersonalProfileCreationException extends RuntimeException
{
    public function __construct(
        string $message = 'An error occurred while creating the personal profile.',
        ?Throwable $previous = null
    ) {
        parent::__construct(
            message: $message,
            previous: $previous
        );
    }
}
