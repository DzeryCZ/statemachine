<?php

declare(strict_types=1);

namespace Statemachine\Statemachine\Configuration\Structure;

use ArrayIterator;
use IteratorAggregate;

class EventCollection implements IteratorAggregate
{
    private $events = [];

    public function __construct(array $events)
    {
        foreach ($events as $eventName => $event) {
            $this->events[$eventName] = new EventValueObject($event, $eventName);
        }
    }

    public function getByName($name)
    {
        // Todo - proper Exception
        return $this->events[$name];
    }

    public function getIterator()
    {
        return new ArrayIterator($this->events);
    }
}
