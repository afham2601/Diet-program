<?php
session_start();
include 'db.php';

// Fetch question
$question_id = 2; // Assuming the question ID for question 2 is 2
$result = mysqli_query($conn, "SELECT question FROM manage_questions WHERE question_id=$question_id");
$row = mysqli_fetch_assoc($result);
$question = $row['question'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $_SESSION['q2'] = $_POST['answer'];
    header("Location: question3.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weight-Loss Question</title>
    <link rel="stylesheet" href="question1.css">
</head>
<body>
    <div class="container">
        <header>
            <a href="question1.php" class="back">&laquo; Back</a>
        </header>
        <main>
            <h1>Question 2</h1>
            <div class="content-wrapper">
                <div class="question-wrapper">
                    <p><?php echo $question; ?></p>
                    <form method="post">
                        <div class="options-container">
                            <label class="option">
                                <input type="radio" name="answer" value="true" required> Yes
                            </label>
                            <label class="option">
                                <input type="radio" name="answer" value="false" required> No
                            </label>
                        </div>
                        <div class="submit-container">
                            <button type="submit" class="submit">Submit</button>
                        </div>
                    </form>
                </div>
                <div class="image-wrapper">
                    <img src="picture/weightloss.png" alt="Weight Loss" class="weightloss-image">
                </div>
            </div>
        </main>
    </div>
</body>
</html>

