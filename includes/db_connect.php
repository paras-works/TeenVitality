<?php
/**
 * Central database connection for TeenVitality.
 * Update these values to match your local MySQL / XAMPP setup.
 */
$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "teenvitality";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$conn->set_charset("utf8mb4");
