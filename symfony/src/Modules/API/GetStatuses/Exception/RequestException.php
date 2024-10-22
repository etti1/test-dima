<?php

namespace App\Modules\API\GetStatuses\Exception;

use Throwable;

class RequestException extends \Exception
{
    public function __construct(string $message = "", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

}