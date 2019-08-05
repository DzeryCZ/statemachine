<?php

declare(strict_types=1);

namespace Statemachine\Statemachine\Configuration\Structure;

class StateValueObject
{
    private const EVENTS_KEY = 'events';

    /** @var string */
    private $name;
    /** @var EventCollection  */
    private $eventCollection;

    public function __construct(array $data, string $stateName)
    {
        $this->name = $stateName;
        $this->eventCollection = new EventCollection($data[self::EVENTS_KEY]);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEventCollection(): EventCollection
    {
        return $this->eventCollection;
    }
}
