<?php require_once __DIR__.'/../models/User.php';

class UserController {

    /**
     * User model variable
     * @var mixed
     */
    protected $user;

    public function __construct() {
        $this->user = new User();
    }
    
    /**
     * Summary of getUsers
     * @return string
     */
    public function getUsers() : String {
        try {
            $data = $this->user->all();
            header('Content-Type: application/json');

            return json_encode($data);
        } catch (PDOException $e) {
            error_log($e->getMessage());

            return ['error' => $e->getMessage()];
        }
    }

    /**
     * Summary of addUser
     * @param array $data
     * @return array
     */
    public function addUser(array $data) : String {
        try {
            $responce = $this->user->create($data);

            return $responce;
        } catch (PDOException $e) {
            error_log($e->getMessage());

            return $e->getMessage();
        }
    }

    /**
     * Summary of deleteUser
     * @param int $id
     * @return string
     */
    public function deleteUser(array $params) : String {
        try {
            $responce = $this->user->delete($params['id']);
    
            return $responce;
        } catch (PDOException $e) {
            error_log($e->getMessage());
    
            return $e->getMessage();
        }
    }

    public function editUser(array $params) : String {
        try {
            $responce = $this->user->update($params['id'], [   
                    'name' => $params['name'], 
                    'surname' => $params['surname'], 
                    'position_id' => $params['position_id']
                ]);
    
            return $responce;
        } catch (PDOException $e) {
            error_log($e->getMessage());
    
            return $e->getMessage();
        }
    }
}