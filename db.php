<?php
$servername = "localhost";
$username = "root";
$password = ""; // Change this if you have set a password for the root user
$dbname = "program diet"; // Updated to match your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
