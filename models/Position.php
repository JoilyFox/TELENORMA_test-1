<?php require_once 'Model.php';

class Position extends Model {
    protected $tableName = 'positions';
    
    protected $columns = [
        'id',
        'name',
    ];

    public function __construct() {
        parent::__construct();
    }
    
}
    