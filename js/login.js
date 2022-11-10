var error_email = false;
var error_password = false;
$(document).ready(function() {
    $("#email_error_message").hide();
    $("#password_error_message").hide();

    $("#form_email").focusout(function() {
        check_email();
    });
    $("#form_password").focusout(function() {
        check_password();
    });
    $("#registration_form").submit(function() {
        error_email = false;
        error_password = false;
        formHasError = false;
        check_email();
        check_password();

        if (formHasError == false) {
            // alert("Registration Successfull");
            window.location.replace("detail.php");
            return true;
        } else {
            alert("Please Fill the form Correctly");
            return false;
        }
        // if (formHasError === false) {
        //     return true;
        // } else {
        //     return false;
        // }
    });
});


function check_email() {
    var pattern = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
    var email = $("#form_email").val();
    if (pattern.test(email) && email !== '') {
        $("#email_error_message").hide();
        $("#form_email").css("border-bottom", "2px solid #34F458");
    } else {
        $("#email_error_message").html("*Invalid Email");
        $("#email_error_message").show();
        $("#form_email").css("border-bottom", "2px solid #F90A0A");
        error_email = true;
        formHasError = true;
    }
}

function check_password() {
    var password_length = $("#form_password").val().trim().length;
    if (password_length < 8) {
        $("#password_error_message").html("*Atleast 8 Characters");
        $("#password_error_message").show();
        $("#form_password").css("border-bottom", "2px solid #F90A0A");
        error_password = true;
        formHasError = true;
    } else {
        $("#password_error_message").hide();
        $("#form_password").css("border-bottom", "2px solid #34F458");
    }
}