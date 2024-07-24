<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weight-Loss Plan</title>
    <link rel="stylesheet" href="frontpage2.css">
</head>
<body>
    <div class="container">
        <header>
            <nav class="navbar">
                <div class="menu-icon" onclick="toggleMenu()">☰</div>
                <div class="nav-links" id="navLinks">
                    <div class="close-menu" onclick="toggleMenu()">✖</div>
                    <a href="login.php">LOGIN</a>
                </div>
            </nav>
        </header>
        <main>
            <h1>HEALTHY DIET PROGRAM</h1>
            <div class="buttons">
                <div class="buttonfemale">
                    <img src="picture/avatar-profile-icon-in-flat-style-female-user-profile-illustration-on-isolated-background-women-profile-sign-business-concept-vector-removebg-preview (1).png" alt="Female">
                    <button onclick="setGenderAndNavigate('female')">FEMALE</button>
                </div>
                <div class="buttonmale">
                    <img src="picture/male-face-removebg-preview (1).png" alt="Male">
                    <button onclick="setGenderAndNavigate('male')">MALE</button>
                </div>
            </div>
        </main>
    </div>
    <script>
        function toggleMenu() {
            var navLinks = document.getElementById('navLinks');
            navLinks.classList.toggle('active');
        }

        function setGenderAndNavigate(gender) {
            fetch('setGender.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ gender: gender })
            }).then(() => {
                window.location.href = 'bmicalculation.php';
            });
        }
    </script>
</body>
</html>
