<?php

class Database
{
    public static function connect(): PDO
    {
        $databasePath = __DIR__ . '/database.db';
        $pdo = new PDO('sqlite:' . $databasePath);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->exec('PRAGMA foreign_keys = ON');

        $schema = file_get_contents(__DIR__ . '/schema.sql');

        if ($schema === false) {
            throw new RuntimeException('Unable to read schema.sql');
        }

        $pdo->exec($schema);

        return $pdo;
    }
}
