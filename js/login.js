$(document).ready(function() {
    // Handle login button click
    $("#loginButton").click(function() {
        console.log('login ho raha hai ')
        var username = $("#username").val();
        var password = $("#password").val();

        // Perform AJAX request to the login PHP script
        $.ajax({
            type: "POST",
            url: "php/login.php",
            data: {
                username: username,
                password: password
            },
            success: function(response) {
                // Process the response from the server, e.g., show a message or redirect to the profile page.
                $("#message").html(response);
            }
        });
    });
});
