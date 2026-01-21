<?php

class Database
{
    private static ?PDO $conexion = null;

    /**
     * Devuelve una conexión PDO reutilizable.
     */
    public static function getConnection(): PDO
    {
        if (self::$conexion instanceof PDO) {
            return self::$conexion;
        }

        $host = 'localhost';
        $dbname = 'realmadrid';
        $user = 'root';
        $password = '';
        $charset = 'utf8mb4';

        $dsn = "mysql:host={$host};dbname={$dbname};charset={$charset}";
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ];

        self::$conexion = new PDO($dsn, $user, $password, $options);

        return self::$conexion;
    }
}
