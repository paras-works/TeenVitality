<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - TeenVitality</title>
    <style>
        body {
            background: #f0f4f8;
            font-family: Arial, sans-serif;
            display: flex;
            height: 100vh;
            justify-content: center;
            align-items: center;
            margin: 0;
        }
        .dashboard-box {
            background: #fff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 8px 16px rgba(0,0,0,0.2);
            width: 350px;
            text-align: center;
        }
        h2 { color: #333; margin-bottom: 8px; }
        p { color: #555; }
        a.logout {
            display: inline-block;
            margin-top: 20px;
            padding: 12px;
            width: 100%;
            background-color: #007bff;
            color: #fff;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
            box-sizing: border-box;
        }
        a.logout:hover { background-color: #0056b3; }
    </style>
</head>
<body>
    <div class="dashboard-box">
        <h2>Welcome<?php echo isset($_SESSION['username']) ? ", " . htmlspecialchars($_SESSION['username']) : ""; ?>!</h2>
        <p>You are logged in as <?php echo htmlspecialchars($_SESSION['email']); ?>.</p>
        <a class="logout" href="logout.php">Logout</a>
    </div>
</body>
</html>
