<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $email = $_POST['email'];

    // MySQL database details
    $host = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbName = "mydatabase";

    // Creating a connection
    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and execute an SQL insert statement
    $stmt = $conn->prepare("INSERT INTO users (username, password, email) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $password, $email);
    $stmt->execute();

    if ($stmt->affected_rows === 1) {
        // Return the user's ID after successful registration
        $userId = $conn->insert_id;
        echo "Registration successful:" . $userId;
    } else {
        echo "Registration failed.";
    }

    $stmt->close();
    $conn->close();
}
?>
