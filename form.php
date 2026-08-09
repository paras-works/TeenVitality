<?php
// Alternate registration handler, linked from login.html ("Sign up here").
// Kept for compatibility - uses the same shared `users` table as connect1.php.
include 'includes/db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username      = trim($_POST['username']);
    $email         = trim($_POST['email']);
    $mobile_number = trim($_POST['mobile_number']);
    $user_id       = trim($_POST['user_id']);
    $password      = trim($_POST['password']);

    // Check if email already exists
    $check = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $check->bind_param("s", $email);
    $check->execute();
    $result = $check->get_result();

    if ($result->num_rows > 0) {
        echo "<p style='color:red;'>❌ Email already exists. Please log in instead.</p>";
    } else {
        // Hash password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insert user into DB (user_id is text, so bind it as a string "s", not "i")
        $stmt = $conn->prepare(
            "INSERT INTO users (username, email, mobile_number, user_id, password) VALUES (?, ?, ?, ?, ?)"
        );
        $stmt->bind_param("sssss", $username, $email, $mobile_number, $user_id, $hashed_password);

        if ($stmt->execute()) {
            echo "<p style='color:green;'>✅ Registration successful! You can now <a href='login.html'>log in</a>.</p>";
        } else {
            echo "<p style='color:red;'>❌ Error: " . $stmt->error . "</p>";
        }

        $stmt->close();
    }

    $check->close();
    $conn->close();
}
