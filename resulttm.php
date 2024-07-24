<?php
session_start();

function getStage($q1, $q2, $q3, $q4) {
    if ($q1 == 'true') {
        if ($q2 == 'true') {
            if ($q3 == 'true') {
                if ($q4 == 'true') return 'Stage 4 (Maintenance)';
                return 'Stage 3 (Action)';
            } else {
                if ($q4 == 'true') return 'Stage 4 (Maintenance)';
                return 'Stage 3 (Action)';
            }
        } else {
            if ($q3 == 'true') {
                if ($q4 == 'true') return 'Stage 4 (Maintenance)';
                return 'Stage 3 (Action)';
            } else {
                if ($q4 == 'true') return 'Stage 4 (Maintenance)';
                return 'Stage 3 (Action)';
            }
        }
    } else {
        if ($q2 == 'false') {
            if ($q3 == 'false') {
                if ($q4 == 'false') return 'Stage 1 (Precontemplation)';
                return 'Stage 1 (Precontemplation)';
            } else {
                if ($q4 == 'false') return 'Stage 2 (Contemplation)';
                return 'Stage 2 (Contemplation)';
            }
        } else {
            if ($q3 == 'false') {
                if ($q4 == 'false') return 'Stage 3 (Action)';
                return 'Stage 4 (Maintenance)';
            } else {
                if ($q4 == 'false') return 'Stage 3 (Action)';
                return 'Stage 4 (Maintenance)';
            }
        }
    }
}

function getBmiCategory($bmi) {
    if ($bmi < 16) {
        return 'Severely Underweight';
    } elseif ($bmi >= 16 && $bmi < 18.5) {
        return 'Underweight';
    } elseif ($bmi >= 18.5 && $bmi < 25) {
        return 'Normal';
    } elseif ($bmi >= 25 && $bmi < 30) {
        return 'Overweight';
    } elseif ($bmi >= 30 && $bmi < 35) {
        return 'Moderately Obese';
    } elseif ($bmi >= 35 && $bmi < 40) {
        return 'Severely Obese';
    } else {
        return 'Morbidly Obese';
    }
}

function getDescription($bmiCategory, $stage) {
    $descriptions = [
        'Severely Underweight' => [
            'Stage 1 (Precontemplation)' => "You are currently not considering any changes to your diet or lifestyle.",
            'Stage 2 (Contemplation)' => "You are beginning to think about making changes to improve your weight.",
            'Stage 3 (Action)' => "You are actively taking steps to increase your caloric intake and improve nutrition.",
            'Stage 4 (Maintenance)' => "You are maintaining your new eating habits and monitoring your weight regularly."
        ],
        'Underweight' => [
            'Stage 1 (Precontemplation)' => "You are not yet thinking about addressing your underweight status.",
            'Stage 2 (Contemplation)' => "You recognize the need to gain weight and are considering your options.",
            'Stage 3 (Action)' => "You are following a plan to gain weight through diet and lifestyle changes.",
            'Stage 4 (Maintenance)' => "You have achieved a healthier weight and are maintaining your progress."
        ],
        'Normal' => [
            'Stage 1 (Precontemplation)' => "You are not currently focused on changing your weight.",
            'Stage 2 (Contemplation)' => "You are considering ways to maintain your healthy weight.",
            'Stage 3 (Action)' => "You are actively engaging in healthy behaviors to maintain your weight.",
            'Stage 4 (Maintenance)' => "You are consistently practicing healthy habits to keep your weight stable."
        ],
        'Overweight' => [
            'Stage 1 (Precontemplation)' => "You are not currently considering weight loss.",
            'Stage 2 (Contemplation)' => "You are thinking about losing weight to improve your health.",
            'Stage 3 (Action)' => "You are actively working on a plan to reduce your weight through diet and exercise.",
            'Stage 4 (Maintenance)' => "You have reached a healthier weight and are working to maintain it."
        ],
        'Moderately Obese' => [
            'Stage 1 (Precontemplation)' => "You are not yet thinking about addressing your obesity.",
            'Stage 2 (Contemplation)' => "You recognize the need to lose weight and are considering your options.",
            'Stage 3 (Action)' => "You are following a structured plan to lose weight and improve your health.",
            'Stage 4 (Maintenance)' => "You have successfully lost weight and are maintaining your new lifestyle."
        ],
        'Severely Obese' => [
            'Stage 1 (Precontemplation)' => "You are not currently focused on your severe obesity.",
            'Stage 2 (Contemplation)' => "You are thinking about the health risks and considering weight loss.",
            'Stage 3 (Action)' => "You are actively working on a comprehensive plan to lose weight.",
            'Stage 4 (Maintenance)' => "You have made significant progress and are maintaining your healthier weight."
        ],
        'Morbidly Obese' => [
            'Stage 1 (Precontemplation)' => "You are not considering addressing your morbid obesity at this time.",
            'Stage 2 (Contemplation)' => "You are aware of the serious health risks and are thinking about weight loss.",
            'Stage 3 (Action)' => "You are undergoing a medically supervised weight loss program.",
            'Stage 4 (Maintenance)' => "You have achieved substantial weight loss and are working to maintain it."
        ]
    ];

    return $descriptions[$bmiCategory][$stage];
}

$q1 = isset($_SESSION['q1']) ? $_SESSION['q1'] : 'false';
$q2 = isset($_SESSION['q2']) ? $_SESSION['q2'] : 'false';
$q3 = isset($_SESSION['q3']) ? $_SESSION['q3'] : 'false';
$q4 = isset($_SESSION['q4']) ? $_SESSION['q4'] : 'false';
$bmi = isset($_SESSION['bmi']) ? $_SESSION['bmi'] : 0;

$stage = getStage($q1, $q2, $q3, $q4);
$bmiCategory = getBmiCategory($bmi);
$description = getDescription($bmiCategory, $stage);

// Get gender from session
$gender = isset($_SESSION['gender']) ? $_SESSION['gender'] : 'male';

// Determine the color class for the stage
$stageColorClass = '';
if ($stage == 'Stage 1 (Precontemplation)' || $stage == 'Stage 2 (Contemplation)') {
    $stageColorClass = 'stage-red';
} else {
    $stageColorClass = 'stage-green';
}

// Determine the emoji for the stage
$stageEmoji = '';
if ($stage == 'Stage 1 (Precontemplation)') {
    $stageEmoji = '😞';
} elseif ($stage == 'Stage 2 (Contemplation)') {
    $stageEmoji = '😐';
} elseif ($stage == 'Stage 3 (Action)') {
    $stageEmoji = '🙂';
} else {
    $stageEmoji = '😊';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Result TTM</title>
    <link rel="stylesheet" href="resulttm2.css">
</head>
<body>
    <div class="container">
        <header>
            <a href="question4.php" class="back">&laquo; Back</a>
        </header>
        <main>
            <h1>Result</h1>
            <div class="result-box">
                <h2><span class="stage-emoji-left"><?php echo $stageEmoji; ?></span> Stage TTM <span class="stage-emoji-right"><?php echo $stageEmoji; ?></span></h2>
                <p class="stage <?php echo $stageColorClass; ?>"><?php echo $stage; ?></p>
                <p class="note">You may want to take notes for future reference.</p>
                <p class="bmi-category">BMI Category: <?php echo $bmiCategory; ?></p>
                <p class="description"><?php echo $description; ?></p>
                <?php if ($gender == 'female') { ?>
                    <a href="registration.php" class="register">REGISTER NOW!</a>
                <?php } ?>
                <a href="frontpage.php" class="home">HOME</a>
            </div>
        </main>
    </div>
</body>
</html>
