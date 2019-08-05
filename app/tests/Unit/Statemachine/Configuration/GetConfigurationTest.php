<?php

declare(strict_types=1);

namespace Statemachine\Test\Unit\Staemachine\Configuration;

use PHPUnit\Framework\TestCase;
use Statemachine\Infrastructure\Json\GetJsonInterface;
use Statemachine\Statemachine\Configuration\GetConfiguration;
use Statemachine\Statemachine\Configuration\Structure\EventCollection;
use Statemachine\Statemachine\Configuration\Structure\EventValueObject;
use Statemachine\Statemachine\Configuration\Structure\StateCollection;
use Statemachine\Statemachine\Configuration\Structure\StateValueObject;

class GetConfigurationTest extends TestCase
{
    private const STATE_1 = 'state#1';

    /** @var \PHPUnit\Framework\MockObject\MockObject|GetJsonInterface */
    private $configurationMock;
    private $config = [
        GetConfiguration::STATES_KEY => [
            self::STATE_1 => [
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
        $this->configurationMock = $this->getConfigurationMock();
    }

    public function testGetAll(): void
    {
        $expectedStateCollection = new StateCollection($this->config[GetConfiguration::STATES_KEY]);

        $this->configurationMock->expects($this->once())
            ->method('get')
            ->willReturn($this->config);

        $getConfigurationService = new GetConfiguration($this->configurationMock);
        $resultConfiguration = $getConfigurationService->getAll();

        $this->assertEquals($expectedStateCollection, $resultConfiguration);
    }

    public function testGetOneState(): void
    {
        $expectedStateValueObject = new StateValueObject(
            $this->config[GetConfiguration::STATES_KEY][self::STATE_1],
            self::STATE_1
        );

        $this->configurationMock->expects($this->once())
            ->method('get')
            ->willReturn($this->config);

        $getConfigurationService = new GetConfiguration($this->configurationMock);
        $resultStateConfiguration = $getConfigurationService->getOneState(self::STATE_1);

        $this->assertEquals($expectedStateValueObject, $resultStateConfiguration);
    }


    /**
     * @return \PHPUnit\Framework\MockObject\MockObject|GetJsonInterface
     */
    private function getConfigurationMock()
    {
        return$this->getMockBuilder(GetJsonInterface::class)
            ->disableOriginalConstructor()
            ->getMock();
    }
}
