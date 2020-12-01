<?php

namespace app\services;

use PDO;

class ConnectionCreator
{
    public static $instance = null;

    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new static();
        }

        return self::$instance;
    }

    /**
     * @return PDO
     */
    public function createConnection(): PDO
    {
        $env = parse_ini_file(__DIR__ . '/../.env');
        $pdo = new PDO(
            'mysql:host=' . $env['DB_HOST'] . ';dbname=' . $env['DB_NAME'],
            $env['DB_USER'],
            $env['DB_PASSWORD']
        );
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

        return $pdo;
    }
}
