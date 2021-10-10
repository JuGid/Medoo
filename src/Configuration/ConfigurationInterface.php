<?php

declare(strict_types=1);

namespace Medoo\Configuration;

interface ConfigurationInterface {

    public function getConfiguration(array $options, ?string $port) : array;

}