var error_name = false;
var error_class = false;
var error_password = false;
$(document).ready(function() {
    $("#name_error_message").hide();
    $("#email_error_message").hide();
    $("#password_error_message").hide();
    $("#form_name").focusout(function() {
        check_name();
    });
    $("#form_email").focusout(function() {
        check_email();
    });
    $("#form_password").focusout(function() {
        check_password();
    });

    $("#registration_form").submit(function() {
        error_name = false;
        error_class = false;
        error_password = false;
        formHasError = false;
        check_name();
        check_class();
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

function check_name() {
    var uname = $("#form_name").val();
    if (uname !== '') {
        $("#name_error_message").hide();
        $("#form_name").css("border-bottom", "2px solid #34F458");
    } else {
        $("#name_error_message").html("*Invalid Username");
        $("#name_error_message").show();
        $("#form_name").css("border-bottom", "2px solid #F90A0A");
        error_name = true;
        formHasError = true;
    }
}

function check_class() {
    var ins = $("#form_class").val();
    if (ins == '') {
        $("#class_error_message").html("*Please Enter class name");
        $("#class_error_message").show();
        $("#form_class").css("border-bottom", "2px solid #F90A0A");
        error_class = true;
        formHasError = true;
    } else {
        $("#class_error_message").hide();
        $("#form_class").css("border-bottom", "2px solid #34F458");
    }
}


function check_password() {
    var password_length = $("#form_password").val().trim().length;
    if (password_length < 10) {
        $("#password_error_message").html("*Enter 10 Character Code");
        $("#password_error_message").show();
        $("#form_password").css("border-bottom", "2px solid #F90A0A");
        error_password = true;
        formHasError = true;
    } else {
        $("#password_error_message").hide();
        $("#form_password").css("border-bottom", "2px solid #34F458");
    }
}