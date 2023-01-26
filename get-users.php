<?php require_once __DIR__.'/configs/Database.php';

function gu() {
    $db = Database::getInstance();

    try {
        $connection = $db->getConnection();
        $stmt = $connection->prepare("SELECT * FROM users");
        $stmt->execute();
        $results = $stmt->fetchAll();

        return json_encode($results);
    } catch (PDOException $e) {
        // log the error message
        error_log($e->getMessage());
        
        return ['error' => $e->getMessage()];
    }
}