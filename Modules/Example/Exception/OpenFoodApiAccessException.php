<?php

namespace Modules\Example\Exception;

use Exception;
use Throwable;

class OpenFoodApiAccessException extends Exception
{
    public function __construct(Throwable $previous = null)
    {
        parent::__construct('', 0, $previous);
    }
}
