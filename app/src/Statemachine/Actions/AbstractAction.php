<?php

declare(strict_types=1);

namespace Statemachine\Statemachine\Actions;

use Statemachine\Statemachine\Entity\EntityInterface;

abstract class AbstractAction
{
    abstract public function __invoke(EntityInterface $entity);
}
