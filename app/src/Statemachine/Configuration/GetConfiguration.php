<?php

declare(strict_types=1);

namespace Statemachine\Statemachine\Configuration;

use Statemachine\Infrastructure\Json\GetJsonInterface;
use Statemachine\Statemachine\Configuration\Structure\StateCollection;
use Statemachine\Statemachine\Configuration\Structure\StateValueObject;

class GetConfiguration
{
    public const EVENTS_KEY = 'events';
    public const ACTIONS_KEY = 'actions';
    public const STATES_KEY = 'states';
    public const SUCCESS_STATE_KEY = 'successState';
    public const FAIL_STATE_KEY = 'failState';

    /** @var StateCollection  */
    private $configuration;

    public function __construct(
        GetJsonInterface $configuration
    ) {
        // Todo - convert to a ValueObjects
        $this->configuration = new StateCollection($configuration->get()[self::STATES_KEY]);
    }

    public function getAll(): StateCollection
    {
        return $this->configuration;
    }

    public function getOneState(string $stateName): StateValueObject
    {
        return $this->configuration->getByName($stateName);
    }
}
