<?php

declare(strict_types=1);

namespace Statemachine\Tests\Unit\Infrastructure\Json;

use PHPUnit\Framework\TestCase;
use Statemachine\Infrastructure\Exception\ConfigurationFileCouldNotBeParsedException;
use Statemachine\Infrastructure\Json\GetJson;
use Statemachine\Infrastructure\Json\LoadJsonInterface;

class GetJsonTest extends TestCase
{
    /** @var \PHPUnit\Framework\MockObject\MockObject|LoadJsonInterface */
    private $loadJsonInterfaceMock;

    public function setUp(): void
    {
        $this->loadJsonInterfaceMock = $this->getLoadJsonInterfaceMock();
    }

    /**
     * @dataProvider dataForTestGetJson
     *
     * @param string|null $stringJson
     * @param array $expectedArray
     * @param string|null $expectedException
     */
    public function testGetJson(
        ?string $stringJson,
        array $expectedArray,
        ?string $expectedException
    ) {
        if ($expectedException) {
            $this->expectException($expectedException);
        }

        $this->loadJsonInterfaceMock->expects($this->once())
            ->method('load')
            ->willReturn($stringJson);

        $getJsonService = new GetJson($this->loadJsonInterfaceMock);
        $resultArray = $getJsonService->get();

        $this->assertEquals($expectedArray, $resultArray);
    }

    public function dataForTestGetJson(): array
    {
        return [
            'Result OK' => [
                'jsonString' => '{"test": "ok"}',
                'expectedArray' => [
                    'test' => 'ok',
                ],
                'expectedException' => null,
            ],
            'Badly formatted Json' => [
                'jsonString' => 'this is just wrong{}',
                'expectedArray' => [],
                'expectedException' => ConfigurationFileCouldNotBeParsedException::class,
            ],
        ];
    }

    /**
     * @return \PHPUnit\Framework\MockObject\MockObject|LoadJsonInterface
     */
    private function getLoadJsonInterfaceMock()
    {
        return $this->getMockBuilder(LoadJsonInterface::class)
            ->disableOriginalConstructor()
            ->getMock();
    }
}
