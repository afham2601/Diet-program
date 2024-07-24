<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $height = $_POST['height'];
    $weight = $_POST['weight'];
    
    if ($height > 0 && $weight > 0) {
        $bmi = ($weight / (($height / 100) * ($height / 100)));
        $_SESSION['bmi'] = $bmi;
    } else {
        $_SESSION['bmi'] = 0;
    }
    header("Location: bmiresult.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weight-Loss Plan</title>
    <link rel="stylesheet" href="bmicalculation.css">
</head>
<body>
    <div class="container">
        <header>
            <a href="frontpage.php" class="back-button">&laquo; Back</a>
        </header>
        <main>
            <h1>What is your height and weight?</h1>
            <div class="form-container">
                <form action="bmicalculation.php" method="post">
                    <div class="input-group">
                        <label for="height">Height (CM)</label>
                        <input type="number" id="height" name="height" required>
                    </div>
                    <div class="input-group">
                        <label for="weight">Current Weight (KG)</label>
                        <input type="number" id="weight" name="weight" required>
                    </div>
                    <button type="submit">Submit</button>
                </form>
                <img src="picture/bmi.png" alt="WHO Adult BMI Categories" class="bmi-image">
            </div>
        </main>
    </div>
</body>
</html>
