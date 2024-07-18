<?php
session_start();
if(isset($_SESSION['user_id'])) header('Location: /')

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    
<div class="login">
    <a class="login__back-button" href="/"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAACXBIWXMAAAsTAAALEwEAmpwYAAAAk0lEQVR4nO3ZsQ3CQBQE0Wnin6D/SogQyCQ4oBwspAsQDbD/NK+CW40D+wySOhjAA7jQfMQOvIEbTRXwnCNewImGHJHCEikskcISKSyRwhIpLJGifBUPUSuU+NjmiH1+rra1rTKkfh6tM42VY0KVZUKVZUKVZUJZJpVlUlkmlWVSLVVmfP2evtPcmHcA138fRFrVAcl0dB8tu9fZAAAAAElFTkSuQmCC"></a>
    <h1>
        Login
    </h1>
    <form data-type="login-form" action="POST">
        <div class="form-row">
            <label for="email">E-mail</label>
            <input id="email" placeholder="" type="email">
            <span class="error">Email musi być w formacie email</span>
        </div>
        <div class="form-row">
            <label for="password">Hasło</label>
            <input id="password" placeholder="" type="password">
            <span class="error">Hasło musi mieć minimum 8 znaków</span>
        </div>
        <button type="submmit">Zaloguj się</button>
    </form>
</div>

<script src="/js/login.js"></script>
</body>
</html>