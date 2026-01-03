<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <h2>Login</h2>


<?php
// print_r($_POST);

$messages = [];

require_once "libs/db.php";

$messages = [];

if (isset($_POST['email'])) {
    $email     = $_POST['email'];
    $password = $_POST['password'];


    $stmt = $pdo->prepare("
        SELECT id, role, full_name, email, password
        FROM users
        WHERE email = ?
        LIMIT 1
    ");

    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if (!$user || $password !== $user['password']) {
        // exit("Invalid email or password");
        $messages[] = "Invalid email or password";
    } else {
        header("Location: dashboard.php");
    }

}

foreach($messages as $msg) {
    echo "<p class=\"notice\">{$msg}</p>";
}

?>






    <form id="registrationForm" method="post">


        <div class="form-group">
            <label>Email Address</label>
            <input name="email" type="email" id="email" required>
        </div>

        <div class="form-group">
            <label>Password</label>
            <input name="password" type="password" id="password" required>
        </div>

        <div class="btn-wrap">
            <button type="submit">Login</button>
            <p class="text-center"><a href="registration.php">Create an account <strong>Register</strong></a></p>
        </div>

        
    </form>
</div>

</body>
</html>
