<?php

declare(strict_types=1);

namespace Medoo\Configuration;

use MSSQLConfiguration;
use MySQLConfiguration;
use OracleConfiguration;
use PgSQLConfiguration;
use SQLiteConfiguration;
use SyBaseConfiguration;

abstract class ConfigurationFactory {

    public static function getConfiguration(string $type, array $options) : array {

        if (isset($options['dsn'])) {
            if(!is_array($options['dsn']) || !isset($options['dsn']['driver'])) {
                throw new \InvalidArgumentException('Invalid DSN option supplied.');
            }
            
            return $options['dsn'];
        } 

        if (isset($options['port']) && is_int($options['port'] * 1)) {
            $port = $options['port'];
        }

        switch ($type) {
            case 'mysql':
                $config = new MySQLConfiguration();
            case 'pgsql':
                $config = new PgSQLConfiguration();
            case 'sybase':
                $config = new SyBaseConfiguration();
            case 'oracle':
                $config = new OracleConfiguration();
            case 'mssql':
                $config = new MSSQLConfiguration();
            case 'sqlite':
                $config = new SQLiteConfiguration();
            default :
                return [];
        }

        return $config->getConfiguration($options, $port);
    }
}