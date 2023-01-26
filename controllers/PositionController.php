<?php require_once __DIR__.'/../models/Position.php';

class PositionController {
    public function getPositions() : String {
        try {
            $positions = new Position();
            $data = $positions->all();
            header('Content-Type: application/json');

            return json_encode($data);
        } catch (PDOException $e) {
            error_log($e->getMessage());

            return ['error' => $e->getMessage()];
        }
    }
}