<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // MySQL database details
    $host = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbName = "guvi_user_database";

    // Create a connection
    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Query the database to check the user's credentials
    $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($id, $dbUsername, $hashedPassword);

    if ($stmt->fetch() && password_verify($password, $hashedPassword)) {
        // Authentication successful
        echo "Login successful:" . $id; // Return the user's ID

    } else {
        // Authentication failed
        echo "Login failed.";
    }

    $stmt->close();
    $conn->close();
}
?>
