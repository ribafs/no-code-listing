<?php

class Connection {
    private static $host    = 'localhost';
    public static $sgbd    = 'mysql';// mysql, pgsql, sqlite
    private static $db      = 'testes';
    private static $charset = 'utf8mb4'; // utf8mb4, utf8
    private static $port    = '3306';// 3306, 5432

    private static $dsn     = '';
    private static $user    = 'root';
    private static $pass    = 'root';

    protected static $pdo;
    const REGS_PER_PAGE = 7;
    const LINKS_PER_PAGE = 20;
    const TABLE = 'produtos';

    private function __construct() {
        try {
            $options = [
                PDO::ATTR_EMULATE_PREPARES   => false, // turn off emulation mode for "real" prepared statements
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8',
                PDO::NULL_EMPTY_STRING,
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, //turn on errors in the form of exceptions
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, //make the default fetch be an associative array
            ];
				    self::$dsn = self::$sgbd.':host='.self::$host.';dbname='.self::$db.';port='.self::$port.';charset='.self::$charset;
            self::$pdo = new PDO(self::$dsn, self::$user, self::$pass, $options);
        } catch (PDOException $e) {
            echo "MySql Connection Error: " . $e->getMessage();
        }
    }

    public static function getInstance() {
        if (!self::$pdo) {
            new Connection();
        }

        return self::$pdo;
    }

}
