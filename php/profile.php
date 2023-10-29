<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Retrieve user profile data based on the user's session or another identifier
    // You can use the session or local storage data to identify the user.
    $userId = $_GET['user_id'];  // Replace with the logic to get the user ID.

    // MySQL database details
    $host = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbName = "mydatabase";  

    // Create a connection
    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Query the database to retrieve user profile data
    $stmt = $conn->prepare("SELECT age, dob, contact FROM profiles WHERE user_id = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $stmt->bind_result($age, $dob, $contact);

    if ($stmt->fetch()) {
        $profileData = array(
            "age" => $age,
            "dob" => $dob,
            "contact" => $contact
        );
        echo json_encode($profileData);
    } else {
        echo "User profile not found.";
    }

    $stmt->close();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_POST['user_id'];
    $username = $_POST['username']; // New username
    $email = $_POST['email']; // New email

    $host = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbName = "mydatabase"; 

    // Create a connection
    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and execute an SQL update statement to change the username and email
    $stmt = $conn->prepare("UPDATE profiles SET username = ?, email = ? WHERE user_id = ?");
    $stmt->bind_param("ssi", $username, $email, $userId);
    $stmt->execute();

    if ($stmt->affected_rows === 1) {
        echo "Profile updated successfully.";
    } else {
        echo "Profile update failed.";
    }

    $stmt->close();
    $conn->close();
}

?>
