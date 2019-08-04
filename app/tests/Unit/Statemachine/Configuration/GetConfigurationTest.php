<?php

declare(strict_types=1);

namespace Statemachine\Test\Unit\Staemachine\Configuration;

use PHPUnit\Framework\TestCase;
use Statemachine\Infrastructure\Json\GetJsonInterface;
use Statemachine\Statemachine\Configuration\GetConfiguration;

class GetConfigurationTest extends TestCase
{
    private const STATE_1 = 'state#1';

    /** @var \PHPUnit\Framework\MockObject\MockObject|GetJsonInterface */
    private $configurationMock;

    public function setUp(): void
    {
        $this->configurationMock = $this->getConfigurationMock();
    }

    public function testGetAll(): void {
        $expectedResult = [
            self::STATE_1 => 'blah',
        ];

        $this->configurationMock->expects($this->once())
            ->method('get')
            ->willReturn($expectedResult);

        $getConfigurationService = new GetConfiguration($this->configurationMock);
        $resultConfiguration = $getConfigurationService->getAll();

        $this->assertEquals($expectedResult, $resultConfiguration);
    }

    public function testGetOneState(): void {
        $expectedResult = [
            self::STATE_1 => ['some' => 'content'],
        ];

        $this->configurationMock->expects($this->once())
            ->method('get')
            ->willReturn($expectedResult);

        $getConfigurationService = new GetConfiguration($this->configurationMock);
        $resultStateConfiguration = $getConfigurationService->getOneState(self::STATE_1);

        $this->assertEquals($expectedResult[self::STATE_1], $resultStateConfiguration);
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
