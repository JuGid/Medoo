<?php

declare(strict_types=1);

use Medoo\Configuration\ConfigurationInterface;

class MySQLConfiguration implements ConfigurationInterface{

    public function getConfiguration(array $options, ?string $port) : array {
        $attr = [
            'driver' => 'mysql',
            'dbname' => $options['database']
        ];

        if (isset($options['socket'])) {
            $attr['unix_socket'] = $options['socket'];
        } else {
            $attr['host'] = $options['host'];

            if (isset($port)) {
                $attr['port'] = $port;
            }
        }

        return $attr;
    }
}