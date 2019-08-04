<?php

declare(strict_types=1);

namespace Statemachine\ProcessOrderExample\Entity;

use Statemachine\Statemachine\Entity\EntityInterface;

final class Order implements EntityInterface
{
    /** @var string */
    private $state;

    // Todo - Add more business logic

    public function setState(string $state): void
    {
        $this->state = $state;
    }

    public function getState(): string
    {
        return $this->state;
    }
}
