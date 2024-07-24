<?php
include 'db.php';
session_start();

$success_message = "";
$error_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];

    // Validate input
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_message = "Invalid email format";
    } else {
        // Check if the email exists in the login table
        $sql_user = "SELECT * FROM login WHERE email='$email'";
        $result_user = $conn->query($sql_user);

        if ($result_user->num_rows > 0) {
            // Send reset password email (dummy implementation for now)
            $success_message = "A password reset link has been sent to your email address.";
        } else {
            $error_message = "Email address not found.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="forgotpassword.css">
</head>
<body>
    <div class="container">
        <h2>Forgot Password</h2>
        <p>Enter your email to reset your password</p>
        <?php if (!empty($success_message)) { ?>
            <div class="success-message"><?php echo $success_message; ?></div>
        <?php } ?>
        <?php if (!empty($error_message)) { ?>
            <div class="error-message"><?php echo $error_message; ?></div>
        <?php } ?>
        <form action="forgotpassword.php" method="post">
            <label for="email">Please enter Email</label>
            <input type="email" id="email" name="email" required>

            <div class="buttons">
                <button type="button" onclick="window.location.href='login.php'">BACK</button>
                <button type="submit">SUBMIT</button>
            </div>
        </form>
    </div>
</body>
</html>
