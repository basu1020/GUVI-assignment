$(document).ready(function() {
    // Handle register button click
    $("#registerButton").click(function() {
        var username = $("#username").val();
        var password = $("#password").val();
        var email = $("#email").val();

        // Perform AJAX request to the register PHP script
        $.ajax({
            type: "POST",
            url: "php/register.php",
            data: {
                username: username,
                password: password,
                email: email
            },
            success: function(response) {
                // Process the response from the server, e.g., show a message or redirect to the login page.
                $("#message").html(response);
            }
        });
    });
});
