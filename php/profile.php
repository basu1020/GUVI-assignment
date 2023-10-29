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
        // Return user profile data (e.g., in JSON format)
        $profileData = array(
            "age" => $age,
            "dob" => $dob,
            "contact" => $contact
        );
        echo json_encode($profileData);
    } else {
        // User profile not found
        echo "User profile not found.";
    }

    $stmt->close();
    $conn->close();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Update user profile data in the database
    // You can use a similar approach as in the registration script.
}
?>
