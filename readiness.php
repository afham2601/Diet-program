<?php
include 'db.php'; // Ensure this path is correct
session_start(); // Start the session

$registration_id = isset($_SESSION['registration_id']) ? $_SESSION['registration_id'] : null;

if ($registration_id) {
    $sql = "SELECT * FROM registration WHERE registration_id = '$registration_id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $status = $row['status'];
        $name = $row['name'];
        $IC = $row['IC'];
        $TTMStage = $row['TTMStage'];
        $registerdate = $row['registerdate'];
        $phone_number = $row['phone_number'];
        $weight = $row['weight'];
        $height = $row['height'];

        if ($status == 'approved') {
            $message = "<span class='status-approved'>Your registration is approved</span>";
        } elseif ($status == 'rejected') {
            $message = "<span class='status-rejected'>Your registration is rejected</span>";
        } else {
            $message = "<span class='status-in-process'>Your registration is in process</span>";
        }
    } else {
        $message = "Registration not found";
    }
} else {
    $message = "You are not logged in. Please log in to view your registration status.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Readiness</title>
    <link rel="stylesheet" href="readiness2.css">
</head>
<body>
<a href="login.php" class="logout">LOGOUT</a>
    <div class="container">
        <h2>Registration Status</h2>
        <div class="status-message"><?php echo $message; ?></div>
        <?php if ($registration_id && isset($row)) { ?>
            <div class="info-box">
                <p><strong>name :</strong> <?php echo $name; ?></p>
                <p><strong>customer IC:</strong> <?php echo $IC; ?></p>
                <p><strong>TTMStage:</strong> <?php echo $TTMStage; ?></p>
                <p><strong>registration Date:</strong> <?php echo $registerdate; ?></p>
                <p><strong>phone number:</strong> <?php echo $phone_number; ?></p>
                <p><strong>weight :</strong> <?php echo $weight; ?> kg</p>
                <p><strong>height :</strong> <?php echo $height; ?> cm</p>
            </div>
        <?php } ?>
    </div>
</body>
</html>
