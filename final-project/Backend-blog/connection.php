<?php
$servername = "localhost";
$username = "root";
$password = "8236";
$dbname = "mj_schema";

$connection = new mysqli($servername, $username, $password, $dbname);

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
echo "Connected successfully";
?>


