<?php
session_start();

// Check if the user is an admin
if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>
    <div class="container">
        <div class="button-container">
            <a href="managequestion.php" class="action-button">Manage Question</a>
            <a href="manageregistration.php" class="action-button">Manage Registration</a>
        </div>
        <a href="logout.php" class="logout-button">LOGOUT</a>
    </div>
</body>
</html>
