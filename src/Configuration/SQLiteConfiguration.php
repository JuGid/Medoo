<?php

declare(strict_types=1);

use Medoo\Configuration\ConfigurationInterface;

class SQLiteConfiguration implements ConfigurationInterface{

    public function getConfiguration(array $options, ?string $port) : array {
        return [
            'driver' => 'sqlite', 
            $options['database']
        ];
    }
}