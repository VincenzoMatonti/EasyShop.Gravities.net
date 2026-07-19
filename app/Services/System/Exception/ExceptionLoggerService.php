<?php

namespace App\Services\System\Exception;

use App\Models\System\SystemError;
use Illuminate\Support\Facades\Auth;
use Throwable;

class ExceptionLoggerService
{
    public function report(Throwable $exception, array $context = []): SystemError
    {
        return SystemError::create([

            'user_id' => Auth::id(),

            'exception_class' => $exception::class,

            'message' => $exception->getMessage(),

            'file' => $exception->getFile(),

            'line' => $exception->getLine(),

            'trace' => $exception->getTraceAsString(),

            'context' => array_merge([
                'url' => request()?->fullUrl(),
                'method' => request()?->method(),
                'ip' => request()?->ip(),
                'previous' => $exception->getPrevious()?->getMessage(),
            ], $context),

        ]);
    }
}
