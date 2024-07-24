<?php
include 'db.php'; // Ensure this path is correct

if (isset($_GET['action']) && isset($_GET['registration_id'])) {
    $action = $_GET['action'];
    $registration_id = $_GET['registration_id'];

    if ($action == 'approve') {
        $sql = "UPDATE registration SET status = 'approved' WHERE registration_id = '$registration_id'";
    } elseif ($action == 'reject') {
        $sql = "UPDATE registration SET status = 'rejected' WHERE registration_id = '$registration_id'";
    }

    if ($conn->query($sql) === TRUE) {
        $message = "Registration status updated successfully";
    } else {
        $message = "Error updating registration status: " . $conn->error;
    }
}

$sql = "SELECT registration_id, name, IC, TTMStage, registerdate, phone_number, status FROM registration";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Registration</title>
    <link rel="stylesheet" href="manageregistration.css">
</head>
<body>
    <a href="admin.php" class="back">&laquo; Back</a>
    <a href="login.php" class="logout">LOGOUT</a>
    <div class="container">
        <header>
            <h2>REGISTRATION</h2>
        </header>
        <?php if (!empty($message)) { ?>
            <div class="status-message"><?php echo $message; ?></div>
        <?php } ?>
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Details</th>
                    <th>Actions</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['registration_id'] . "</td>";
                        echo "<td>";
                        echo "<strong>name:</strong> " . $row['name'] . "<br>";
                        echo "<strong>customer ID:</strong> " . $row['IC'] . "<br>";
                        echo "<strong>TTMStage:</strong> " . $row['TTMStage'] . "<br>";
                        echo "<strong>registration Date:</strong> " . $row['registerdate'] . "<br>";
                        echo "<strong>phone number:</strong> " . $row['phone_number'];
                        echo "</td>";
                        echo "<td><a href='manageregistration.php?action=reject&registration_id=" . $row['registration_id'] . "' class='btn btn-reject'>refuse</a> / <a href='manageregistration.php?action=approve&registration_id=" . $row['registration_id'] . "' class='btn btn-approve'>approve</a></td>";
                        echo "<td>" . ucfirst($row['status']) . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No registrations found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
