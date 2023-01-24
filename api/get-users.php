<?php
require_once '../config/db.php';

global $connection;

$query = "SELECT id, name, surname, position_id FROM users";
$result = mysqli_query($connection, $query);

$users = array();

while($row = mysqli_fetch_assoc($result)) {
    $users[] = $row;
}

echo json_encode($users);
?>