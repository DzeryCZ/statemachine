<?php

declare(strict_types=1);

namespace Statemachine\Statemachine\Exceptions;

use Exception;

class ActionIsNotCallableException extends Exception
{
    public static function withData(
        string $action
    ): self {
        return new self(sprintf(
            'Action %s is not callable',
            $action
        ));
    }
}
