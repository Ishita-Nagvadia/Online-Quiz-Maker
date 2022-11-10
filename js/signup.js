var error_uname = false;
var error_email = false;
var error_ins = false;
var error_password = false;
var error_cpassword = false;

$(document).ready(function() {
    $("#uname_error_message").hide();
    $("#email_error_message").hide();
    $("#ins_error_message").hide();
    $("#password_error_message").hide();
    $("#cpassword_error_message").hide();

    $("#form_uname").focusout(function() {
        check_uname();
    });
    $("#form_email").focusout(function() {
        check_email();
    });
    $("#form_ins").focusout(function() {
        check_ins();
    });
    $("#form_password").focusout(function() {
        check_password();
    });
    $("#form_cpassword").focusout(function() {
        check_cpassword();
    });

    $("#registration_form").submit(function() {
        error_uname = false;
        error_email = false;
        error_ins = false;
        error_password = false;
        error_cpassword = false;
        formHasError = false;
        check_uname();
        check_email();
        check_ins();
        check_password();
        check_cpassword();

        if (formHasError == false) {
            //alert("Registration Successfull");
            window.location.href = 'detail.php';
            return true;
        } else {
            alert("Please Fill the form Correctly");
            return false;
        }
        /* if (formHasError === false) {
            return true;
        } else {
            return false;
        } */
    });
});

function check_uname() {
    var uname = $("#form_uname").val();
    if (uname !== '') {
        $("#uname_error_message").hide();
        $("#form_uname").css("border-bottom", "2px solid #34F458");
    } else {
        $("#uname_error_message").html("*Invalid Username");
        $("#uname_error_message").show();
        $("#form_uname").css("border-bottom", "2px solid #F90A0A");
        error_uname = true;
        formHasError = true;
    }
}

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

function check_ins() {
    var ins = $("#form_ins").val();
    if (ins == '') {
        $("#ins_error_message").html("*Please Enter institute name");
        $("#ins_error_message").show();
        $("#form_ins").css("border-bottom", "2px solid #F90A0A");
        error_ins = true;
        formHasError = true;
    } else {
        $("#ins_error_message").hide();
        $("#form_ins").css("border-bottom", "2px solid #34F458");
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

function check_cpassword() {
    var password = $("#form_password").val();
    var cpassword = $("#form_cpassword").val();
    if (password !== cpassword) {
        $("#cpassword_error_message").html("*Passwords does not match");
        $("#cpassword_error_message").show();
        $("#form_cpassword").css("border-bottom", "2px solid #F90A0A");
        error_cpassword = true;
        formHasError = true;
    } else {
        $("#cpassword_error_message").hide();
        $("#form_cpassword").css("border-bottom", "2px solid #34F458");
    }
}