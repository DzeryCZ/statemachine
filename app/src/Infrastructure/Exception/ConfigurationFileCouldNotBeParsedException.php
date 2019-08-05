<?php

declare(strict_types=1);

namespace Statemachine\Infrastructure\Exception;

use Exception;
use Throwable;

class ConfigurationFileCouldNotBeParsedException extends Exception
{
    public static function create(): Throwable
    {
        return new self('Statemachine configuration could not be loaded');
    }
}
