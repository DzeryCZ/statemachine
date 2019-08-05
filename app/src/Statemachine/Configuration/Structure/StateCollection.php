<?php

declare(strict_types=1);

namespace Statemachine\Statemachine\Configuration\Structure;

use ArrayIterator;
use IteratorAggregate;

class StateCollection implements IteratorAggregate
{
    private $states = [];

    public function __construct(array $states)
    {
        foreach ($states as $stateName => $state) {
            $this->states[$stateName] = new StateValueObject($state, $stateName);
        }
    }

    public function getByName($name)
    {
        // Todo - proper Exception
        return $this->states[$name];
    }

    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator($this->states);
    }
}
