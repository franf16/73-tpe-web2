<?php 

require_once './config/config.php';

/** Singleton con método estático para obtener una conexión al DB, 
 *  con autoload de database si no está cargado. */
class Database {

    private static $db; 

    private function __construct() {}

    public static function getConnection() {
        if (isset(self::$db)) {
            return self::$db;
        }
        else {
            try {
                self::$db = new PDO('mysql:host='.HOST.';dbname='.DB_NAME.';charset=utf8', DB_USER, DB_PASSWORD);
                return self::$db;
            }
            catch (PDOException $e) {
                try {
                    $database = file_get_contents(DB_PATH);
                    $server = new PDO('mysql:host='.HOST.';dbname=;charset=utf8', DB_USER, DB_PASSWORD);
                    $server->exec($database);
                    sleep(2);
                    return self::getConnection();
                }
                catch (Exception $e) {
                    echo "<p><strong>Error: </strong>{$e->getMessage()}";
                    die();
                }
            }
        }
    }
}