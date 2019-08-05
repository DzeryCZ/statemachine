<?php

declare(strict_types=1);

namespace Statemachine\Test\Unit\Staemachine\Command;

use PHPUnit\Framework\TestCase;
use Statemachine\ProcessOrderExample\Entity\Order;
use Statemachine\Statemachine\Command\RunEvent;
use Statemachine\Statemachine\Configuration\GetConfiguration;
use Statemachine\Statemachine\Configuration\Structure\StateValueObject;

class RunEventTest extends TestCase
{
    private const EVENT_NAME = 'testEvent';
    private const CURRENT_STATE = 'state#1';

    /** @var \PHPUnit\Framework\MockObject\MockObject|GetConfiguration */
    private $configurationLoaderMock;

    private $config = [
        GetConfiguration::STATES_KEY => [
            self::CURRENT_STATE => [
                GetConfiguration::EVENTS_KEY => [
                    'testEvent' => [
                        'successState' => '',
                        'failState' => '',
                        'actions' => [],
                    ],
                ],
            ],
        ],
    ];

    public function setUp(): void
    {
        $this->configurationLoaderMock = $this->getConfigurationLoaderMock();
    }

    public function testRun(): void
    {
        $orderEntity = new Order();
        $orderEntity->setState(self::CURRENT_STATE);

        $state = new StateValueObject(
            $this->config[GetConfiguration::STATES_KEY][self::CURRENT_STATE],
            self::CURRENT_STATE
        );
        $this->configurationLoaderMock->expects($this->once())
            ->method('getOneState')
            ->willReturn($state);

        $runEventService = new RunEvent($this->configurationLoaderMock);
        $runEventService->run($orderEntity, self::EVENT_NAME);
    }

    /**
     * @return \PHPUnit\Framework\MockObject\MockObject|GetConfiguration
     */
    private function getConfigurationLoaderMock()
    {
        return $this->getMockBuilder(GetConfiguration::class)
            ->disableOriginalConstructor()
            ->getMock();
    }
}
