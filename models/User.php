<?php require_once 'Model.php';

class User extends Model {
    protected $tableName = 'users';
    
    protected $columns = [
        'id',
        'name',
        'position_id',
        'surname',
    ];

    public function __construct() {
        parent::__construct();
    }
    
}
    