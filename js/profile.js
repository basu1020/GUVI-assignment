$(document).ready(function() {
    // Load user profile data when the page loads
    var userId = 1; // Retrieve user ID from local storage

    $.ajax({
        method: "GET",
        url: "../php/profile.php",
        data: {
            user_id: userId // Pass user ID as a parameter
        },
        success: function(response) {
            console.log(response)
            // Process the user profile data and update the UI.
            var userData = JSON.parse(response);
            $("#profileInfo").html("Username: " + userData.username + "<br>Email: " + userData.email);
        }
    });

    // Handle update profile button click
    $("#updateProfileButton").click(function() {
        // You can implement a form for updating profile information here.
        // Use AJAX to send updated data to the server.
    });
});
