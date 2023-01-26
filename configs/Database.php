<?php

class Database {
    private static $instance = null;
    private $connection;
    
    const DB_HOST = '127.0.0.1:3304';
    const DB_NAME = 'TELENORMA_test-1';
    const DB_USER = 'root';
    const DB_PASS = '';

    /**
     * Summary of __construct
     */
    private function __construct() {
        // Connect to the database
        try {
            $this->connection = new PDO("mysql:host=".self::DB_HOST.";dbname=".self::DB_NAME, self::DB_USER, self::DB_PASS);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    /**
     * Summary of getInstance
     * @return Database
     */
    public static function getInstance() : Database {
        if (!self::$instance) {
            self::$instance = new Database();
        }
        
        return self::$instance;
    }

    /**
     * Summary of getConnection
     * @return PDO
     */
    public function getConnection() : PDO {
        return $this->connection;
    }
}

