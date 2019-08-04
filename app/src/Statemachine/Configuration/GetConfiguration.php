<?php

declare(strict_types=1);

namespace Statemachine\Statemachine\Configuration;

use Statemachine\Infrastructure\Json\GetJsonInterface;

class GetConfiguration
{
    public const EVENTS_KEY = 'events';
    public const ACTIONS_KEY = 'actions';
    public const SUCCESS_STATE_KEY = 'successState';
    public const FAIL_STATE_KEY = 'failState';

    /** @var array  */
    private $configuration;

    public function __construct(
        GetJsonInterface $configuration
    ) {
        // Todo - convert to a ValueObjects
        $this->configuration = $configuration->get();
    }

    public function getAll(): array
    {
        return $this->configuration;
    }

    public function getOneState(string $stateName): array
    {
        return $this->configuration[$stateName];
    }
}
