<?php

declare(strict_types=1);

use Medoo\Configuration\ConfigurationInterface;

class OracleConfiguration implements ConfigurationInterface{

    public function getConfiguration(array $options, ?string $port) : array {
        $port = isset($port) ? ':' . $port : ':1521';

        $attr = [
            'driver' => 'oci',
            'dbname' => $options['host'] ?
                '//' . $options['host'] . $port . '/' . $options['database'] : $options['database']
        ];

        if (isset($options['charset'])) {
            $attr['charset'] = $options['charset'];
        }

        return $attr;
    }
}