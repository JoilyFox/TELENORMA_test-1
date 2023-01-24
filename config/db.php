<?php

// Connection information
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "TELENORMA_test-1";

// Create connection
$connection = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}