<?php

declare(strict_types=1);

use Medoo\Configuration\ConfigurationInterface;

class SyBaseConfiguration implements ConfigurationInterface{

    public function getConfiguration(array $options, ?string $port) : array {
        $attr = [
            'driver' => 'dblib',
            'host' => $options['host'],
            'dbname' => $options['database']
        ];

        if (isset($port)) {
            $attr['port'] = $port;
        }

        return $attr;
    }
}