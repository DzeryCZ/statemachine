<?php

declare(strict_types=1);

namespace Statemachine\Statemachine\Command;

use Statemachine\Statemachine\Configuration\GetConfiguration;
use Statemachine\Statemachine\Entity\EntityInterface;
use Statemachine\Statemachine\Exceptions\TransitionIsNotAllowedException;
use Throwable;

final class RunEvent
{
    /** @var GetConfiguration  */
    private $configurationLoader;

    public function __construct(
        GetConfiguration $configurationLoader
    ) {
        $this->configurationLoader = $configurationLoader;
    }

    /**
     * @param EntityInterface $entity
     * @param string          $eventName
     *
     * @throws TransitionIsNotAllowedException
     */
    public function run(
        EntityInterface $entity,
        string $eventName
    ): void {
        $currentState = $entity->getState();
        $stateConfiguration = $this->configurationLoader->getOneState($currentState);

        if (!$this->isTransitionAllowed($stateConfiguration, $eventName)) {
            // Todo - Log
            throw TransitionIsNotAllowedException::withData($currentState, $eventName);
        }
        $event = $stateConfiguration[GetConfiguration::EVENTS_KEY][$eventName];
        $this->processActions($entity, $event);
    }

    private function isTransitionAllowed(
        array $stateConfiguration,
        string $eventName
    ): bool {
        return isset($stateConfiguration[GetConfiguration::EVENTS_KEY][$eventName]);
    }

    private function processActions(
        EntityInterface $entity,
        array $event
    ): void {
        try {
            $this->runActions($entity, $event[GetConfiguration::ACTIONS_KEY]);
            $this->moveEntityToStatus($entity, $event[GetConfiguration::SUCCESS_STATE_KEY]);
        } catch (Throwable $exception) {
            // Todo - Log
            $this->moveEntityToStatus($entity, $event[GetConfiguration::FAIL_STATE_KEY]);
        }
    }

    private function runActions(
        EntityInterface $entity,
        array $actions
    ): void {
        foreach ($actions as $action) {
            $action($entity);
        }
    }

    private function moveEntityToStatus(
        EntityInterface $entity,
        string $status
    ): void {
        $entity->setState($status);
    }
}
