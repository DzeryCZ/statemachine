<?php

declare(strict_types=1);

namespace Statemachine\Test\Unit\Staemachine\Command;

use PHPUnit\Framework\TestCase;
use Statemachine\ProcessOrderExample\Entity\Order;
use Statemachine\Statemachine\Command\RunEvent;
use Statemachine\Statemachine\Configuration\GetConfiguration;

class RunEventTest extends TestCase
{
    private const EVENT_NAME = 'testEvent';
    private const CURRENT_STATE = 'state#1';

    /** @var \PHPUnit\Framework\MockObject\MockObject|GetConfiguration */
    private $configurationLoaderMock;

    private $stateConfigurations = [
        GetConfiguration::EVENTS_KEY => [
            self::EVENT_NAME => [
                GetConfiguration::SUCCESS_STATE_KEY => 'paid',
                GetConfiguration::FAIL_STATE_KEY => 'paymentFailed',
                GetConfiguration::ACTIONS_KEY => [],
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

        $this->configurationLoaderMock->expects($this->once())
            ->method('getOneState')
            ->willReturn($this->stateConfigurations);

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
