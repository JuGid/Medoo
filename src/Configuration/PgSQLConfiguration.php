<?php

declare(strict_types=1);

use Medoo\Configuration\ConfigurationInterface;

class PgSQLConfiguration implements ConfigurationInterface{

    public function getConfiguration(array $options, ?string $port) : array {
        $attr = [
            'driver' => 'pgsql',
            'host' => $options['host'],
            'dbname' => $options['database']
        ];

        if (isset($port)) {
            $attr['port'] = $port;
        }

        return $attr;
    }
}