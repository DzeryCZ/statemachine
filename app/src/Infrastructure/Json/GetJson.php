<?php

declare(strict_types=1);

namespace Statemachine\Infrastructure\Json;

use Statemachine\Infrastructure\Exception\ConfigurationFileCouldNotBeParsedException;

final class GetJson implements GetJsonInterface
{
    /** @var LoadJsonInterface  */
    private $jsonLoader;

    public function __construct(
        LoadJsonInterface $jsonLoader
    ) {
        $this->jsonLoader = $jsonLoader;
    }

    public function get(): array
    {
        $jsonString = $this->jsonLoader->load();

        return $this->parseJson($jsonString);
    }

    private function parseJson(string $jsonString): array
    {
        $json = json_decode($jsonString, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw ConfigurationFileCouldNotBeParsedException::create();
        }

        return $json;
    }
}
