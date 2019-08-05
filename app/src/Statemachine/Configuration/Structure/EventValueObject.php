<?php

declare(strict_types=1);

namespace Statemachine\Statemachine\Configuration\Structure;

class EventValueObject
{
    private const SUCCESS_STATE_KEY = 'successState';
    private const FAIL_STATE_KEY = 'failState';
    private const ACTIONS_KEY = 'actions';

    /** @var string */
    private $successState;
    /** @var string */
    private $failState;
    /** @var array */
    private $actions;
    /** @var string */
    private $name;

    public function __construct(array $eventData, string $eventName)
    {
        // TODO - think about validation
        $this->successState = $eventData[self::SUCCESS_STATE_KEY];
        $this->failState = $eventData[self::FAIL_STATE_KEY];
        $this->actions = $eventData[self::ACTIONS_KEY];
        $this->name = $eventName;
    }

    public function getSuccessState(): string
    {
        return $this->successState;
    }

    public function getFailState(): string
    {
        return $this->failState;
    }

    public function getActions(): array
    {
        return $this->actions;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
