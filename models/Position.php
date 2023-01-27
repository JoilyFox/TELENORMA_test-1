<?php require_once 'Model.php';

class Position extends Model {

    /**
     * The name of the table to interact with
     * 
     * @var string $tableName
     */
    protected $tableName = 'positions';
    
    /**
     * The columns of the table
     * 
     * @var array $columns
     */
    protected $columns = [
        'id',
        'name',
    ];

    /**
     * Constructor for the class
     */
    public function __construct() {
        parent::__construct();
    }
    
}
    