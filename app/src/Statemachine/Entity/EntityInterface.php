<?php

declare(strict_types=1);

namespace Statemachine\Statemachine\Entity;

interface EntityInterface
{
    public function getState(): string;
    public function setState(string $state): void;
}
