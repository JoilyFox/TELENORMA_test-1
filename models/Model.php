<?php require_once __DIR__.'/../configs/Database.php';

class Model {
    protected $db;
    protected $tableName;
    protected $columns;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function all() : Array {
        $columns = implode(', ', $this->columns);

        try {
            $connection = $this->db->getConnection();
            $stmt = $connection->prepare("SELECT " . $columns . " FROM " . $this->tableName);
            $stmt->execute();
            $results = $stmt->fetchAll();
            
            return $results;
        } catch (PDOException $e) {
            // log the error message
            error_log($e->getMessage());
            
            return ['error' => $e->getMessage()];
        }
    }

    public function create(array $data) : Array {
        prinf($data);
        // try {
        //     $connection = $this->db->getConnection();
        //     $columns = implode(', ', array_keys($data));
        //     $values = ':' . implode(', :', array_keys($data));

        //     $stmt = $connection->prepare("INSERT INTO " . $this->tableName . " (" . $columns . ") VALUES (" . $values . ")");
            
        //     foreach ($data as $key => $value) {
        //         $stmt->bindValue(':' . $key, $value);
        //     }
            
        //     $stmt->execute();

        //     return ['Success' => 'Successfully added!'];
        // } catch (PDOException $e) {
        //     // log the error message
        //     error_log($e->getMessage());
            
        //     return ['Error' => $e->getMessage()];
        // }
    }

}

