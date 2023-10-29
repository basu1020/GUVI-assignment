$(document).ready(function() {
    // Handle login button click
    $("#loginButton").click(function() {
        var username = $("#username").val();
        var password = $("#password").val();

        // Check for empty fields
        if (username === '' || password === '') {
            alert("Please fill in all fields.");
            return;
        }

        // Perform AJAX request to the login PHP script
        $.ajax({
            type: "POST",
            url: "../php/login.php",
            data: {
                username: username,
                password: password
            },
            success: function(response) {
                if (response === "Login successful.") {

                    // Extracting the user ID from the response
                    var userId = response.split(':')[1]; 
 
                    // Store the user ID in local storage for session management
                    localStorage.setItem('userId', userId);
 
                    // Redirect to the profile page
                    window.location.href = 'profile.html';
                } else {
                    // Display an alert for login failure with the reason
                    alert("Login failed. " + response);
                }
            }
        });
    });
});
