<?php

declare(strict_types=1);

namespace Statemachine\Infrastructure\Json;

final class LoadJsonFromFile implements LoadJsonInterface
{
    /** @var string */
    private $pathToFile;

    public function __construct(
        string $pathToFile
    ) {
        $this->pathToFile = $pathToFile;
    }

    public function load(): string
    {
        return file_get_contents($this->pathToFile);
    }
}

