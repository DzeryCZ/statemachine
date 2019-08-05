<?php

declare(strict_types=1);

namespace Statemachine\Statemachine\Command;

use mysql_xdevapi\Exception;
use Statemachine\Statemachine\Configuration\GetConfiguration;
use Statemachine\Statemachine\Configuration\Structure\EventCollection;
use Statemachine\Statemachine\Configuration\Structure\EventValueObject;
use Statemachine\Statemachine\Entity\EntityInterface;
use Statemachine\Statemachine\Exceptions\ActionIsNotCallableException;
use Statemachine\Statemachine\Exceptions\TransitionIsNotAllowedException;
use Throwable;

// Todo - split this service - it has a lot of responsibility
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

        if (!$this->isTransitionAllowed($stateConfiguration->getEventCollection(), $eventName)) {
            // Todo - Log
            throw TransitionIsNotAllowedException::withData($currentState, $eventName);
        }
        $event = $stateConfiguration->getEventCollection()->getByName($eventName);
        $this->processActions($entity, $event);
    }

    private function isTransitionAllowed(
        EventCollection $eventCollection,
        string $eventName
    ): bool {
        return !empty($eventCollection->getByName($eventName));
    }

    private function processActions(
        EntityInterface $entity,
        EventValueObject $event
    ): void {
        try {
            $this->runActions($entity, $event->getActions());
            $this->moveEntityToStatus($entity, $event->getSuccessState());
        } catch (Throwable $exception) {
            // Todo - Log
            $this->moveEntityToStatus($entity, $event->getFailState());
        }
    }

    private function runActions(
        EntityInterface $entity,
        array $actions
    ): void {
        foreach ($actions as $action) {
            $actionInstance = new $action(); // Todo - Move to DI factory

            if (!is_callable($actionInstance)) {
                throw ActionIsNotCallableException::withData($action);
            }

            $actionInstance($entity);
        }
    }

    private function moveEntityToStatus(
        EntityInterface $entity,
        string $status
    ): void {
        $entity->setState($status);
    }
}
