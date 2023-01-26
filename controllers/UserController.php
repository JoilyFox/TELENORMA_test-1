<?php require_once __DIR__.'/../models/User.php';

class UserController {
    
    /**
     * Summary of getUsers
     * @return string
     */
    public function getUsers() : String {
        try {
            $users = new User();
            $data = $users->all();
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
    public function addUser(array $data) : Array {
        try {
            $users = new User();
            $users->create($data);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return ['error' => $e->getMessage()];
        }
    }
}