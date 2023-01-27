<?php require_once 'Model.php';

class User extends Model {

    /**
     * The name of the table to interact with
     * 
     * @var string $tableName
     */
    protected $tableName = 'users';
    
    /**
     * The columns of the table
     * 
     * @var array $columns
     */
    protected $columns = [
        'id',
        'name',
        'position_id',
        'surname',
    ];

    /**
     * Constructor for the class
     */
    public function __construct() {
        parent::__construct();
    }
    
}
    