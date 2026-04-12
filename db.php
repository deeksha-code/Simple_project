<?php
$conn = new mysqli("localhost", "root", "", "", 3307); // 👈 ADD PORT

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    exit();
}

// Create database
$conn->query("CREATE DATABASE IF NOT EXISTS test_db");

// Select DB
$conn->select_db("test_db");

// Create table
$conn->query("CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    email VARCHAR(100)
)");
?>