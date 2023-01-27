<?php require_once __DIR__.'/../configs/Database.php';

class Model {

    /**
    * @var Database $db The database connection instance
    * @var string $tableName The name of the table to interact with
    * @var array $columns The columns of the table
    */
    protected $db;
    protected $tableName;
    protected $columns;

    /**
     * Getting instance of the Database class
     */
    public function __construct() {
        $this->db = Database::getInstance();
    }

    /**
     * Get all the records from the table
     * 
     * @return array Returns an array of rows from the table
     */
    public function all() : Array {
        $connection = $this->db->getConnection();

        $columns = implode(', ', $this->columns);

        try {
            $stmt = $connection->prepare("SELECT " . $columns . " FROM " . $this->tableName);
            $stmt->execute();
            $results = $stmt->fetchAll();
            
            return $results;
        } catch (PDOException $e) {
            error_log($e->getMessage());
            
            return ['error' => $e->getMessage()];
        }
    }

    /**
     * Method to create a new record in the database
     * 
     * @param array $data  Array of data to create
     * @return string A message indicating the success or failure of the operation
     */
    public function create(array $data) : String {
        // Validation
        foreach($data as $val){
            if (empty($val) || $val === null) {
                return 'Error: All fields are required.';
            }
        }

        $connection = $this->db->getConnection();

        $keys = implode(', ', array_keys($data));
        $quotedValues = array_map(function($value){
            return "'" . $value . "'";
        }, array_values($data));
        $values = implode(', ', $quotedValues);

        try {
            $stmt = $connection->prepare("INSERT INTO " . $this->tableName . " (" . $keys . ") VALUES (" . $values . ")");
            $stmt->execute();

            return 'Successfully added!';
        } catch (PDOException $e) {
            error_log($e->getMessage());
            
            return $e->getMessage();
        }
    }

    /**
     * Method for deleting a record from the database
     * 
     * @param int $id The id of the record to be deleted
     * @return string A message indicating the success or failure of the operation
    */
    public function delete(int $id) : String {
        $connection = $this->db->getConnection();
        
        try {
            $stmt = $connection->prepare("DELETE FROM " . $this->tableName . " WHERE id = " . $id);
            $stmt->execute();

            return 'Successfully deleted!';
        } catch (PDOException $e) {
            error_log($e->getMessage());

            return $e->getMessage();
        }
    }

    /**
     * Method to update an existing record in the database
     * 
     * @param int $id The id of the record to be deleted
     * @param array $data The data to update the record with. All fields are required.
     * @return string A message indicating the success or failure of the operation
    */
    public function update(int $id, array $data) : String {
        // Validation
        foreach($data as $val){
            if (empty($val) || $val === null) {
                return 'Error: All fields are required.';
            }
        }

        $connection = $this->db->getConnection();

        $set ='';
        foreach($data as $key=>$val){
            $set .= $key."='".$val."',";
        }
        $set = rtrim($set, ',');

        try {
            $stmt = $connection->prepare("UPDATE " . $this->tableName . " SET ".$set." WHERE id = ".$id);
            $stmt->execute();

            return 'Successfully updated!';
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return $e->getMessage();
        }
    }

}

