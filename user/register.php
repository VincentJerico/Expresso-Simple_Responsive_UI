<?php
session_start();
include 'includes/connection.php'; // Include your database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    $stmt = $conn->prepare("INSERT INTO users (username, password, email) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $hashed_password, $email);

    if ($stmt->execute()) {
        header("Location: user/login.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}
?>

<form method="POST">
    <label>Username:</label>
    <input type="text" name="username" required>
    <label>Email:</label>
    <input type="email" name="email" required>
    <label>Password:</label>
    <input type="password" name="password" required>
    <button type="submit">Register</button>
</form>
