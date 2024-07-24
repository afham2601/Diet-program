<?php
session_start();

function getBmiCategory($bmi) {
    if ($bmi < 16) {
        return 'severely underweight';
    } elseif ($bmi >= 16 && $bmi < 18.5) {
        return 'underweight';
    } elseif ($bmi >= 18.5 && $bmi < 25) {
        return 'normal';
    } elseif ($bmi >= 25 && $bmi < 30) {
        return 'overweight';
    } elseif ($bmi >= 30 && $bmi < 35) {
        return 'moderately obese';
    } elseif ($bmi >= 35 && $bmi < 40) {
        return 'severely obese';
    } else {
        return 'morbidly obese';
    }
}

$bmi = isset($_SESSION['bmi']) ? $_SESSION['bmi'] : 0;
$bmiCategory = getBmiCategory($bmi);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BMI Status</title>
    <link rel="stylesheet" href="bmiresult2.css">
</head>
<body>
    <div class="container">
        <header>
            <a href="bmicalculation.php" class="back">&laquo; Back</a>
        </header>
        <main>
            <h1>BMI STATUS</h1>
            <div class="result-container">
                <img src="picture/people.png" alt="Character" class="character-image">
                <div class="result-message">
                    <p>Your BMI is <?php echo number_format($bmi, 2); ?>, which is considered <?php echo $bmiCategory; ?></p>
                </div>
            </div>
            <form action="info.php" method="get">
                <button type="submit" class="continue">Continue</button>
            </form>
        </main>
    </div>
</body>
</html>

