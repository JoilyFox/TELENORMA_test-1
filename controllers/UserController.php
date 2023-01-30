<?php require_once __DIR__.'/../models/User.php';

class UserController 
{

    /**
     * User model variable
     * 
     * @var mixed
     */
    protected $user;

    /**
     * Constructor function to instantiate the User model
     */
    public function __construct() 
    {
        $this->user = new User();
    }
    
    /**
     * Get all users
     * 
     * @return string Returns a JSON encoded string of all users
     */
    public function getUsers() : String 
    {
        try 
        {
            $data = $this->user->all();
            header('Content-Type: application/json');

            return json_encode($data);
        } catch (PDOException $e) 
        {
            error_log($e->getMessage());

            return ['error' => $e->getMessage()];
        }
    }

    /**
     * Add a new user
     * 
     * @param array $data Array of data to create
     * @return string Returns status of add operation
     */
    public function addUser(array $data) : String 
    {
        try 
        {
            $responce = $this->user->create($data);

            return $responce;
        } catch (PDOException $e) 
        {
            error_log($e->getMessage());

            return $e->getMessage();
        }
    }

    /**
     * Delete a user
     * 
     * @param int $id ID of user to delete
     * @return string Returns status of delete operation
     */
    public function deleteUser(array $params) : String 
    {
        try 
        {
            $responce = $this->user->delete($params['id']);
    
            return $responce;
        } catch (PDOException $e) 
        {
            error_log($e->getMessage());
    
            return $e->getMessage();
        }
    }

    /**
     * Edit a user
     * 
     * @param array $params Array of data to update
     * @return string Returns status of update operation
     */
    public function editUser(array $params) : String 
    {
        try 
        {
            $responce = $this->user->update($params['id'], [   
                    'name' => $params['name'], 
                    'surname' => $params['surname'], 
                    'position_id' => $params['position_id']
                ]);
    
            return $responce;
        } catch (PDOException $e) 
        {
            error_log($e->getMessage());
    
            return $e->getMessage();
        }
    }
}