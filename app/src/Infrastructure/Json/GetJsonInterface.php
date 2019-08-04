<?php

declare(strict_types=1);

namespace Statemachine\Infrastructure\Json;

interface GetJsonInterface
{
    public function get(): array;
}
