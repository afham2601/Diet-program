<?php
include 'db.php';

// Resequence Questions
function resequenceQuestions($conn) {
    $result = mysqli_query($conn, "SELECT question_id FROM manage_questions ORDER BY question_id");
    $index = 1;
    while ($row = mysqli_fetch_assoc($result)) {
        $current_id = $row['question_id'];
        mysqli_query($conn, "UPDATE manage_questions SET question_id = $index WHERE question_id = $current_id");
        $index++;
    }
    mysqli_query($conn, "ALTER TABLE manage_questions AUTO_INCREMENT = $index");
}

// Add Question
if (isset($_POST['add'])) {
    $question = $_POST['question'];
    $sql = "INSERT INTO manage_questions (question) VALUES ('$question')";
    if (mysqli_query($conn, $sql)) {
        echo "New question added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

// Update Question
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $question = $_POST['question'];
    $sql = "UPDATE manage_questions SET question='$question' WHERE question_id=$id";
    if (mysqli_query($conn, $sql)) {
        echo "Question updated successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    header("Location: managequestion.php");
}

// Delete Question
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM manage_questions WHERE question_id=$id";
    if (mysqli_query($conn, $sql)) {
        echo "Question deleted successfully";
        resequenceQuestions($conn);
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    header("Location: managequestion.php");
}

// Reset Table
if (isset($_GET['reset'])) {
    $sql = "TRUNCATE TABLE manage_questions";
    if (mysqli_query($conn, $sql)) {
        $sql = "ALTER TABLE manage_questions AUTO_INCREMENT = 1";
        if (mysqli_query($conn, $sql)) {
            echo "Table reset successfully";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    header("Location: managequestion.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Question</title>
    <link rel="stylesheet" href="managequestion.css">
</head>
<body>
    <a href="admin.php" class="back-button">Back</a>
    <a href="login.php" class="logout-button">LOGOUT</a>
    <div class="container">
        <h1>Manage Question</h1>
        
        <!-- Add Question Form -->
        <form action="managequestion.php" method="post">
            <input type="text" name="question" placeholder="Enter your question" required>
            <button type="submit" name="add">Add Question</button>
        </form>

        <!-- Reset Table -->
        

        <!-- Questions Table -->
        <table class="question-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Question</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $result = mysqli_query($conn, "SELECT * FROM manage_questions ORDER BY question_id");
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['question_id'] . "</td>";
                    echo "<td>" . $row['question'] . "</td>";
                    echo "<td>
                        <a href='managequestion.php?edit=" . $row['question_id'] . "' class='action-link'>Update</a> /
                        <a href='managequestion.php?delete=" . $row['question_id'] . "' class='action-link'>Remove</a>
                    </td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
        
        <!-- Edit Question Form -->
        <?php
        if (isset($_GET['edit'])) {
            $id = $_GET['edit'];
            $result = mysqli_query($conn, "SELECT * FROM manage_questions WHERE question_id=$id");
            $row = mysqli_fetch_assoc($result);
            ?>
            <form action="managequestion.php" method="post">
                <input type="hidden" name="id" value="<?php echo $row['question_id']; ?>">
                <input type="text" name="question" value="<?php echo $row['question']; ?>" required>
                <button type="submit" name="update">Update Question</button>
            </form>
        <?php } ?>

    </div>
</body>
</html>

<?php
// Close connection
mysqli_close($conn);
?>
