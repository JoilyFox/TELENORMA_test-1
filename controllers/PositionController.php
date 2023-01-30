<?php require_once __DIR__.'/../models/Position.php';

class PositionController 
{

    /**
     * The Position instance.
     * 
     * @var Position
     */
    protected $position;

    /**
     * Constructor function to instantiate the Position model
     */
    public function __construct() 
    {
        $this->position = new Position();
    }

    /**
     * Get all positions
     * 
     * @return string Returns a JSON encoded string of all positions
     */
    public function getPositions() : String 
    {
        try 
        {
            $data = $this->position->all();
            header('Content-Type: application/json');

            return json_encode($data);
        } catch (PDOException $e) 
        {
            error_log($e->getMessage());

            return $e->getMessage();
        }
    }
}