<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Registration</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <h2>Registration</h2>



<?php
// print_r($_POST);

require_once "libs/db.php";

$messages = [];

if (isset($_POST['role'])) {
    $role     = $_POST['role'];
    $full_name     = trim($_POST['full_name']);
    $email    = trim($_POST['email']);
    $password = $_POST['pass'];

    $student_id     = trim($_POST['student_id']);
    $class     = trim($_POST['class']);
    $employee_id     = trim($_POST['employee_id']);
    $subject     = trim($_POST['subject']);


    try {
        $pdo->beginTransaction();

        // Insert user
        $stmt = $pdo->prepare("
            INSERT INTO users (role, full_name, email, password)
            VALUES (?, ?, ?, ?)
        ");

        $stmt->execute([$role, $full_name, $email, $password]);

        $userId = $pdo->lastInsertId();

        // Role-specific insert
        if ($role === "student") {
            $stmt = $pdo->prepare("
                INSERT INTO students (user_id, student_id, class)
                VALUES (?, ?, ?)
            ");
            $stmt->execute([
                $userId,
                $_POST['student_id'],
                $_POST['class']
            ]);
        }

        if ($role === "teacher") {
            $stmt = $pdo->prepare("
                INSERT INTO teachers (user_id, employee_id, subject)
                VALUES (?, ?, ?)
            ");
            $stmt->execute([
                $userId,
                $_POST['employee_id'],
                $_POST['subject']
            ]);
        }

        $pdo->commit();

        $messages[] = "Registration successful";

    } catch (Exception $e) {
        $pdo->rollBack();
        // echo "Error: " . $e->getMessage();

        $messages[] = "Registration unsuccessful";
        $messages[] = "Error: " . $e->getMessage();
    }

}

foreach($messages as $msg) {
    echo "<p class=\"notice\">{$msg}</p>";
}

?>





    <form id="registrationForm" method="post">
        <!-- Role Selection -->
        <div class="form-group">
            <label>Register As</label>
            <select name="role" id="role" required>
                <option value="">Select Role</option>
                <option value="student">Student</option>
                <option value="teacher">Teacher</option>
            </select>
        </div>

        <!-- Common Fields -->
        <div class="form-group">
            <label>Full Name</label>
            <input name="full_name" type="text" id="name" required>
        </div>

        <div class="form-group">
            <label>Email Address</label>
            <input name="email" type="email" id="email" required>
        </div>

        <div class="form-group">
            <label>Password</label>
            <input name="pass" type="password" id="password" required>
        </div>

        <!-- Student Fields -->
        <div id="studentFields" class="hidden">
            <div class="form-group">
                <label>Student ID</label>
                <input name="student_id" type="text" id="studentId">
            </div>

            <div class="form-group">
                <label>Class / Grade</label>
                <input name="class" type="text" id="class">
            </div>
        </div>

        <!-- Teacher Fields -->
        <div id="teacherFields" class="hidden">
            <div class="form-group">
                <label>Teacher ID</label>
                <input name="employee_id" type="text" id="employeeId">
            </div>

            <div class="form-group">
                <label>Subject</label>
                <input name="subject" type="text" id="subject">
            </div>
        </div>

        <button type="submit">Register</button>
    </form>
</div>

<script src="script.js"></script>
</body>
</html>
