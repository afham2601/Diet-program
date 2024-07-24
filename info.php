<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TTM Information</title>
    <link rel="stylesheet" href="info2.css">
</head>
<body>
    <header>
        <a href="bmiresult.php" class="back-button">&laquo; Back</a>
    </header>
    <main>
        <h1>Stages of Change (TTM)</h1>
        <div class="info-container">
            <table class="ttm-table">
                <tr>
                    <th>Stage</th>
                    <th>Description</th>
                </tr>
                <tr class="row-1">
                    <td><span style="color: red;">Precontemplation</span></td>
                    <td>You are not yet considering any changes to your diet or lifestyle.</td>
                </tr>
                <tr class="row-2">
                    <td><span style="color: red;">Contemplation</span></td>
                    <td>You recognize the need to make changes and are considering your options.</td>
                </tr>
                <tr class="row-3">
                    <td><span style="color: green;">Action</span></td>
                    <td>You are actively taking steps to change your diet and lifestyle.</td>
                </tr>
                <tr class="row-4">
                    <td><span style="color: green;">Maintenance</span></td>
                    <td>You have made significant changes and are maintaining your new lifestyle.</td>
                </tr>
            </table>
            <p class="recommendation">If you are in the stages highlighted in green, we recommend joining our program.</p>
            <p class="explanation">
                Now that you understand the stages, you are ready to answer some questions that will help us better understand your needs and progress.
            </p>
            <form action="question1.php" method="get">
                <button type="submit" class="continue-button">Continue</button>
            </form>
        </div>
    </main>
</body>
</html>

