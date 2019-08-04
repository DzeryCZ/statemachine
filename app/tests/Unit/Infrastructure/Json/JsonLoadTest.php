<?php

namespace Statemachine\Tests\Unit\Infrastructure\Json;

use PHPUnit\Framework\TestCase;
use Statemachine\Infrastructure\Json\LoadJsonFromFile;

class JsonLoadTest extends TestCase
{
    public function testLoadJson(): void
    {
        $jsonFilePath = __DIR__ . '/fixtures/JsonTest.json';
        $jsonLoader = new LoadJsonFromFile($jsonFilePath);
        $jsonString = $jsonLoader->load();

        $this->assertStringContainsString('status', $jsonString);
    }
}
