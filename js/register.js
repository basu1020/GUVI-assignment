$(document).ready(function() {
    // Handle register button click
    $("#registerButton").click(function() {
        var username = $("#username").val();
        var password = $("#password").val();
        var email = $("#email").val();

        // Check for empty fields
        if (username === '' || password === '' || email === '') {
            alert("Please fill in all fields.");
            return;
        }

        // Perform AJAX request to the register PHP script
        $.ajax({
            method: "POST",
            url: "../php/register.php",
            data: {
                username: username,
                password: password,
                email: email
            },
            success: function(response) {
                if (response === "Registration successful.") {
                    // Extracting the user ID from the response
                    var userId = response.split(':')[1]; 
 
                    // Store the user ID in local storage for session management
                    localStorage.setItem('userId', userId);

                    // Redirect to the login page after successful registration
                    window.location.href = "profile.html";
                } else {
                    // Display an alert for registration failure with the reason
                    alert("Registration failed. " + response);
                }
            }
        });
    });
});
