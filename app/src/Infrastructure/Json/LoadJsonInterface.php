<?php

declare(strict_types=1);

namespace Statemachine\Infrastructure\Json;

interface LoadJsonInterface
{
    public function load(): string;
}
