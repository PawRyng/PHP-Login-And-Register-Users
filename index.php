<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main</title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/css/home.css">
</head>
<body>
    <main>
        <?php if(isset($_SESSION['user_id'])): ?>
            <h1>Witaj</h1>
            <p>Twój email to: <strong><?= $_SESSION['user_email'] ?></strong></p>
            <p>Twoje ID to: <strong><?= $_SESSION['user_id'] ?></strong></p>

            <a href="#" data-type="logout-user" class="logout">Wyloguj się</a>
        <?php else: ?>
                <a class="login-button" href="/login.php">Login</a>
                <a class="register-button" href="/register.php">Register</a>
        <?php endif ?>
    </main>
    <script src="/js/logout.js"></script>
</body>
</html>