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

    <form id="registrationForm">
        <!-- Role Selection -->
        <div class="form-group">
            <label>Register As</label>
            <select id="role" required>
                <option value="">Select Role</option>
                <option value="student">Student</option>
                <option value="teacher">Teacher</option>
            </select>
        </div>

        <!-- Common Fields -->
        <div class="form-group">
            <label>Full Name</label>
            <input type="text" id="name" required>
        </div>

        <div class="form-group">
            <label>Email Address</label>
            <input type="email" id="email" required>
        </div>

        <div class="form-group">
            <label>Password</label>
            <input type="password" id="password" required>
        </div>

        <!-- Student Fields -->
        <div id="studentFields" class="hidden">
            <div class="form-group">
                <label>Student ID</label>
                <input type="text" id="studentId">
            </div>

            <div class="form-group">
                <label>Class / Grade</label>
                <input type="text" id="class">
            </div>
        </div>

        <!-- Teacher Fields -->
        <div id="teacherFields" class="hidden">
            <div class="form-group">
                <label>Employee ID</label>
                <input type="text" id="employeeId">
            </div>

            <div class="form-group">
                <label>Subject</label>
                <input type="text" id="subject">
            </div>
        </div>

        <button type="submit">Register</button>
    </form>
</div>

<script src="script.js"></script>
</body>
</html>
