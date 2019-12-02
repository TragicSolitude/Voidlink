jQuery(function ($) {
    var emailField = $("[name = email]");
    var usernameField = $("[name = username]");
    var passwordField = $("[name = password]");
    var confirmField = $("[name = confirmpassword]");

    function dirty(e) {
        $(e.target).addClass("dirty");
    }

    function showErrors(errors) {
        $(".errors").empty();

        if (errors.length > 0) {
            var i;
            for (i = 0; i < errors.length; i++) {
                $('<p class="error">' + errors[i] + '</p>').appendTo(".errors");
            }

            $("#submit-btn").addClass("disabled");
        } else {
            $("#submit-btn").removeClass("disabled");
        }
    }

    function validate() {
        var errors = [];

        if (usernameField.hasClass("dirty")) {
            var username = usernameField.val();
            if (username.length === 0) {
                errors.push("Please enter a username");
            }
        }

        if (emailField.hasClass("dirty")) {
            var email = emailField.val();
            // This is definitely an imperfect email regex (no such thing as a
            // perfect email regex) but its good enough
            if (!/[A-z0-9+_.-]+\@(?:[A-z0-9_-]+\.?)+/.test(email)) {
                errors.push("Please enter a valid email address");
            }
        }

        if (passwordField.hasClass("dirty") && confirmField.hasClass("dirty")) {
            var password = passwordField.val();
            var confirmpassword = confirmField.val();
            if (password.length === 0 && confirmpassword.length === 0) {
                errors.push("Please enter a password");
            } else if (password !== confirmpassword) {
                errors.push("Passwords do not match");
            }
        }

        showErrors(errors);
    }

    // We only want to validate fields after the user interacts with them
    emailField.on("focus", dirty);
    usernameField.on("focus", dirty);
    passwordField.on("focus", dirty);
    confirmField.on("focus", dirty);

    $("input").on("blur", validate);
});
