<?php

require_once 'utils/Configs.php';

class EBRDB {

    private static $url;
    private static $user;
    private static $password;
    private static $conn;

    public static function init() {
        self::$url = Configs::DB_URL;
        self::$user = Configs::DB_USERNAME;
        self::$password = Configs::DB_PASSWORD;
    }

    /**
     * Connect to the PostgreSQL database
     * @return PDO a PDO object representing the connection
     * @throws PDOException if there is an error connecting to the database
     */
    public static function getConnection() {
        if (self::$conn == null || !self::$conn->query('SELECT 1')) {
            try {
                self::init();
                $options = [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_EMULATE_PREPARES => false,
                    PDO::ATTR_PERSISTENT => true,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ];
                self::$conn = new PDO(self::$url, self::$user, self::$password, $options);
                // echo "Connected to the PostgreSQL server successfully.";
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
        return self::$conn;
    }

    /**
     * @param args the command line arguments
     */
    public static function main($args) {
        try {
            self::getConnection();
        } catch (PDOException $throwables) {
            echo $throwables->getMessage();
        }
    }
}
