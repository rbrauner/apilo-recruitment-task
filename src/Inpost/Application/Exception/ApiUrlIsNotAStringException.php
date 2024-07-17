<?php

declare(strict_types=1);

namespace App\Inpost\Application\Exception;

use Exception;

/**
 * "API URL is not a string" exception.
 */
final class ApiUrlIsNotAStringException extends Exception
{
    public function __construct()
    {
        parent::__construct('API URL is not a string');
    }
}
