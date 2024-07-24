<?php
include 'db.php'; // Ensure this path is correct
session_start(); // Start the session

$success_message = "";
$error_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validate input
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_message = "Invalid email format";
    } else {
        // Check if the email exists in the administrator table
        $sql_admin = "SELECT * FROM administrator WHERE email='$email' AND password='$password'";
        $result_admin = $conn->query($sql_admin);

        if ($result_admin->num_rows > 0) {
            // Admin login
            $_SESSION['admin'] = true;
            $success_message = "Admin login successful";

            // Redirect to admin.php
            header("Location: admin.php");
            exit();
        } else {
            // Check if the email exists in the login table
            $sql_user = "SELECT * FROM login WHERE email='$email' AND password='$password'";
            $result_user = $conn->query($sql_user);

            if ($result_user->num_rows > 0) {
                $row = $result_user->fetch_assoc();
                $login_id = $row['login_id'];

                // Get the registration_id associated with this login_id
                $sql_registration = "SELECT registration_id FROM registration WHERE login_id='$login_id'";
                $result_registration = $conn->query($sql_registration);

                if ($result_registration->num_rows > 0) {
                    $registration_row = $result_registration->fetch_assoc();
                    $registration_id = $registration_row['registration_id'];

                    // Store registration_id in session
                    $_SESSION['registration_id'] = $registration_id;
                    $success_message = "Login successful";

                    // Redirect to readiness.php
                    header("Location: readiness.php");
                    exit();
                } else {
                    $error_message = "Registration not found for this user.";
                }
            } else {
                $error_message = "Invalid email or password";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="login4.css">
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <p>Sign in to continue</p>
        <?php if (!empty($success_message)) { ?>
            <div class="success-message"><?php echo $success_message; ?></div>
        <?php } ?>
        <?php if (!empty($error_message)) { ?>
            <div class="error-message"><?php echo $error_message; ?></div>
        <?php } ?>
        <form action="login.php" method="post">
            <label for="email">Please enter Email</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Please enter password</label>
            <input type="password" id="password" name="password" required>

            <p class="forgot-password">
                <a href="forgotpassword.php">Forgot Password?</a>
            </p>

            <div class="buttons">
                <button type="button" onclick="window.location.href='frontpage.php'">BACK</button>
                <button type="submit">LOGIN</button>
            </div>
        </form>
    </div>
</body>
</html>
