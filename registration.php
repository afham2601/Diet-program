<?php
include 'db.php'; // Ensure this path is correct

$success_message = "";
$error_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $IC = $_POST['IC'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $phone_number = $_POST['phone_number'];
    $weight = $_POST['weight'];
    $height = $_POST['height'];
    $TTMStage = $_POST['TTMStage'];

    // Validate input
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_message = "Invalid email format";
    } elseif (!preg_match('/^[0-9]{6}-[0-9]{2}-[0-9]{4}$/', $IC)) {
        $error_message = "IC number must be in the format 000000-00-0000";
    } elseif (!is_numeric($phone_number) || intval($phone_number) != $phone_number) {
        $error_message = "Phone number must be an integer";
    } elseif (!is_numeric($weight) || floatval($weight) != $weight) {
        $error_message = "Weight must be a float number";
    } elseif (!is_numeric($height) || floatval($height) != $height) {
        $error_message = "Height must be a float number";
    } elseif ($password !== $confirm_password) {
        $error_message = "Passwords do not match";
    } else {
        $conn->begin_transaction(); // Start transaction

        try {
            $sql_login = "INSERT INTO login (email, password) VALUES ('$email', '$password')";
            if ($conn->query($sql_login) === TRUE) {
                $login_id = $conn->insert_id;
                $sql_registration = "INSERT INTO registration (name, IC, email, password, phone_number, weight, height, TTMStage, login_id) VALUES ('$name', '$IC', '$email', '$password', '$phone_number', '$weight', '$height', '$TTMStage', '$login_id')";
                if ($conn->query($sql_registration) === TRUE) {
                    $registration_id = $conn->insert_id;
                    $sql_customer = "INSERT INTO customer (name, IC, phone_number, registration_id) VALUES ('$name', '$IC', '$phone_number', '$registration_id')";
                    if ($conn->query($sql_customer) === TRUE) {
                        $conn->commit(); // Commit transaction
                        $success_message = "New account created successfully";
                    } else {
                        throw new Exception("Error: " . $sql_customer . "<br>" . $conn->error);
                    }
                } else {
                    throw new Exception("Error: " . $sql_registration . "<br>" . $conn->error);
                }
            } else {
                throw new Exception("Error: " . $sql_login . "<br>" . $conn->error);
            }
        } catch (Exception $e) {
            $conn->rollback(); // Rollback transaction on error
            $error_message = $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="registration2.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script> <!-- Include FontAwesome for eye icon -->
</head>
<body>
    <div class="container">
        <h2>Create new Account</h2>
        <?php if (!empty($success_message)) { ?>
            <div class="success-message"><?php echo $success_message; ?></div>
        <?php } ?>
        <?php if (!empty($error_message)) { ?>
            <div class="error-message"><?php echo $error_message; ?></div>
        <?php } ?>
        <form action="registration.php" method="post" onsubmit="return validateForm()">
            <label for="name">Please enter your name</label>
            <input type="text" id="name" name="name" placeholder="Enter your name" required>

            <label for="IC">Please enter your IC number</label>
            <input type="text" id="IC" name="IC" placeholder="000000-00-0000" required>

            <label for="email">Please enter your email</label>
            <input type="email" id="email" name="email" placeholder="Enter your email" required>

            <label for="password">Please enter your password</label>
            <div class="password-container">
                <input type="password" id="password" name="password" placeholder="Enter your password" required>
                <span id="togglePassword" class="toggle-password">Show</span>
            </div>

            <label for="confirm_password">Please confirm your password</label>
            <div class="password-container">
                <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm your password" required>
                <span id="toggleConfirmPassword" class="toggle-password">Show</span>
            </div>

            <label for="phone_number">Please enter your phone number</label>
            <input type="number" id="phone_number" name="phone_number" placeholder="Enter your phone number" required>

            <label for="weight">Please enter your weight (KG)</label>
            <input type="number" step="0.01" id="weight" name="weight" placeholder="Enter your weight" required>

            <label for="height">Please enter your height (CM)</label>
            <input type="number" step="0.01" id="height" name="height" placeholder="Enter your height" required>

            <label for="TTMStage">Please enter TTM stage</label>
            <select id="TTMStage" name="TTMStage">
                <option value="Precontemplation">Precontemplation</option>
                <option value="Contemplation">Contemplation</option>
                <option value="Action">Action</option>
                <option value="Maintenance">Maintenance</option>
            </select>

            <button type="submit">SIGN UP</button>
        </form>
        <a href="frontpage.php">BACK</a>
    </div>
    <script>
        function validatePassword() {
            var password = document.getElementById("password").value;
            var confirmPassword = document.getElementById("confirm_password").value;
            if (password != confirmPassword) {
                alert("Passwords do not match.");
                return false;
            }
            return true;
        }

        function validateIC() {
            var ic = document.getElementById("IC").value;
            var icPattern = /^[0-9]{6}-[0-9]{2}-[0-9]{4}$/;
            if (!icPattern.test(ic)) {
                alert("IC number must be in the format 000000-00-0000.");
                return false;
            }
            return true;
        }

        function validateForm() {
            return validatePassword() && validateIC();
        }

        document.getElementById("togglePassword").addEventListener("click", function() {
            var password = document.getElementById("password");
            var type = password.getAttribute("type") === "password" ? "text" : "password";
            password.setAttribute("type", type);
            this.textContent = this.textContent === "Show" ? "Hide" : "Show";
        });

        document.getElementById("toggleConfirmPassword").addEventListener("click", function() {
            var confirmPassword = document.getElementById("confirm_password");
            var type = confirmPassword.getAttribute("type") === "password" ? "text" : "password";
            confirmPassword.setAttribute("type", type);
            this.textContent = this.textContent === "Show" ? "Hide" : "Show";
        });
    </script>
</body>
</html>
