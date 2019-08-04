<?php

declare(strict_types=1);

namespace Statemachine\Statemachine\Exceptions;

use Exception;

class TransitionIsNotAllowedException extends Exception
{
    public static function withData(
        string $currentState,
        string $eventState
    ): self {
        return new self(sprintf(
            'State %s does not allow Event %s',
            $currentState,
            $eventState
        ));
    }
}
