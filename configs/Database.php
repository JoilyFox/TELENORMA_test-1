<?php

class Database 
{

    /**
     * The instance of the Database class
     * 
     * @var Database
     */
    private static $instance = null;

    /**
     * The PDO connection to the database
     * 
     * @var PDO
     */
    private $connection;
    
    /**
     * The information to connect to the database
     * 
     * @var string
     * @var string
     * @var string
     * @var string
     */
    const DB_HOST = '127.0.0.1:3304';
    const DB_NAME = 'TELENORMA_test-1';
    const DB_USER = 'root';
    const DB_PASS = '';

    /**
     * Connect to the database
     */
    private function __construct() 
    {
        try 
        {
            $this->connection = new PDO("mysql:host=" . self::DB_HOST . ";dbname=" . self::DB_NAME, self::DB_USER, self::DB_PASS);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    /**
     * Returns the instance of the Database class
     * 
     * @return Database
     */
    public static function getInstance() : Database 
    {
        if (!self::$instance) 
        {
            self::$instance = new Database();
        }
        
        return self::$instance;
    }

    /**
     * Returns the PDO connection to the database
     * 
     * @return PDO
     */ 
    public function getConnection() : PDO 
    {
        return $this->connection;
    }
}

