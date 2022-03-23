<?php
namespace Src\Models;

class Database
{
	private static $database = null;

	private function __construct(){}

	public static function getInstance(){
		if (self::$database == null)
			self::$database = self::init();
		return self::$database;
	}

    private static function init() {
        $container = require __DIR__ . '/../settings.php';
        $settings = $container["settings"];
        $dsn = 'mysql:host='.$settings['db']['host'].';dbname=' . $settings['db']['database'];
        $pdo = new \PDO($dsn, $settings['db']['login'], $settings['db']['mdp']);
        $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false); // Disable emulate prepared statements
        $pdo->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_OBJ); // Set default fetch mode
        return $pdo;
    }

}