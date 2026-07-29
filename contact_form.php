<?php
// Include the database connection file
include 'includes/db_connect.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name          = trim($_POST['name']);
    $email         = trim($_POST['email']);
    $mobile_number = trim($_POST['mobile_number']);
    $message       = trim($_POST['message']);

    // Prepared statement - no SQL injection
    $stmt = $conn->prepare(
        "INSERT INTO contact_messages (name, email, mobile_number, message) VALUES (?, ?, ?, ?)"
    );
    $stmt->bind_param("ssss", $name, $email, $mobile_number, $message);

    if (!$stmt->execute()) {
        echo "Error: " . $stmt->error;
        exit;
    }

    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Message Sent</title>
    <style>
        body {
            background: linear-gradient(135deg, #00c6ff, #0072ff);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }

        .message-box {
            background-color: #fff;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            text-align: center;
            max-width: 400px;
            width: 100%;
        }

        .message-box h1 {
            color: #28a745;
            font-size: 28px;
            margin-bottom: 10px;
        }

        .message-box p {
            font-size: 16px;
            color: #333;
        }

        .back-button {
            margin-top: 20px;
            padding: 10px 20px;
            border: none;
            background-color: #007bff;
            color: white;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            text-decoration: none;
        }

        .back-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="message-box">
        <h1>✅ Message Sent Successfully!</h1>
        <p>Thank you for contacting us. We will respond shortly.</p>
        <a href="index.html" class="back-button">Back to Home</a>
    </div>
</body>
</html>
