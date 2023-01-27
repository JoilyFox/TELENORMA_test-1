<?php require_once __DIR__.'/../configs/Database.php';

class Model {
    protected $db;
    protected $tableName;
    protected $columns;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    /**
     * Getting all db columns.
     * @return array
     */
    public function all() : Array {
        $columns = implode(', ', $this->columns);

        try {
            $connection = $this->db->getConnection();
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
     * Create method.
     * @param array $data
     * @return string
     */
    public function create(array $data) : String {
        // Validation
        if (empty($data['name']) || empty($data['surname']) || empty($data['position_id'])) {
            return 'Error: name, surname and position_id are required fields.';
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

