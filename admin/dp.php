<?php 
$servername = "localhost";
$username = "ringus_infra";
$password = "ringus_infra";
$dbname = "ringus_infra";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>