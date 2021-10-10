<?php

declare(strict_types=1);

use Medoo\Configuration\ConfigurationInterface;

class MSSQLConfiguration implements ConfigurationInterface{

    private const MSSQL_CONFIG_KEYS = [
        'ApplicationIntent',
        'AttachDBFileName',
        'Authentication',
        'ColumnEncryption',
        'ConnectionPooling',
        'Encrypt',
        'Failover_Partner',
        'KeyStoreAuthentication',
        'KeyStorePrincipalId',
        'KeyStoreSecret',
        'LoginTimeout',
        'MultipleActiveResultSets',
        'MultiSubnetFailover',
        'Scrollable',
        'TraceFile',
        'TraceOn',
        'TransactionIsolation',
        'TransparentNetworkIPResolution',
        'TrustServerCertificate',
        'WSID',
    ];
    
    public function getConfiguration(array $options, ?string $port) : array {
        $isPort = isset($port);

        if (isset($options['driver']) && $options['driver'] === 'dblib') {
            $attr = [
                'driver' => 'dblib',
                'host' => $options['host'] . ($isPort ? ':' . $port : ''),
                'dbname' => $options['database']
            ];

            if (isset($options['appname'])) {
                $attr['appname'] = $options['appname'];
            }

            if (isset($options['charset'])) {
                $attr['charset'] = $options['charset'];
            }
        } else {
            $attr = [
                'driver' => 'sqlsrv',
                'Server' => $options['host'] . ($isPort ? ',' . $port : ''),
                'Database' => $options['database']
            ];

            if (isset($options['appname'])) {
                $attr['APP'] = $options['appname'];
            }

            foreach (self::MSSQL_CONFIG_KEYS as $value) {
                $keyname = strtolower(preg_replace(['/([a-z\d])([A-Z])/', '/([^_])([A-Z][a-z])/'], '$1_$2', $value));

                if (isset($options[$keyname])) {
                    $attr[$value] = $options[$keyname];
                }
            }
        }

        return $attr;
    }
}