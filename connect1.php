<?php
// Handles the registration form on index.html
// (fields: username, email, mobile_number, user_id, password)
include 'includes/db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username      = trim($_POST['username']);
    $email         = trim($_POST['email']);
    $mobile_number = trim($_POST['mobile_number']);
    $user_id       = trim($_POST['user_id']);
    $password      = $_POST['password'];

    // Check if email is already registered (prepared statement - no SQL injection)
    $check = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $check->bind_param("s", $email);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        echo "<script>alert('Email already registered! Please log in instead.'); window.location.href='login.html';</script>";
    } else {
        // Hash the password before storing it (never store plain text)
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $conn->prepare(
            "INSERT INTO users (username, email, mobile_number, user_id, password) VALUES (?, ?, ?, ?, ?)"
        );
        $stmt->bind_param("sssss", $username, $email, $mobile_number, $user_id, $hashed_password);

        if ($stmt->execute()) {
            echo "<script>alert('Registration successful! Please log in.'); window.location.href='login.html';</script>";
        } else {
            echo "<script>alert('Registration failed. Please try again.'); window.location.href='index.html';</script>";
        }

        $stmt->close();
    }

    $check->close();
    $conn->close();
}
