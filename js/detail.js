var error_title = false;
var error_sub = false;
var error_code = false;
$(document).ready(function() {
    $("#title_error_message").hide();
    $("#sub_error_message").hide();
    $("#code_error_message").hide();
    $("#form_title").focusout(function() {
        check_title();
    });
    $("#form_sub").focusout(function() {
        check_sub();
    });
    $("#form_code").focusout(function() {
        check_code();
    });

    $("#registration_form").submit(function() {
        error_title = false;
        error_sub = false;
        error_code = false;
        formHasError = false;
        check_title();
        check_sub();
        check_code();

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

function check_title() {
    var title = $("#form_title").val();
    if (title !== '') {
        $("#title_error_message").hide();
        $("#form_title").css("border-bottom", "2px solid #34F458");
    } else {
        $("#title_error_message").html("*Cant be empty");
        $("#title_error_message").show();
        $("#form_title").css("border-bottom", "2px solid #F90A0A");
        error_title = true;
        formHasError = true;
    }
}

function check_sub() {
    var title = $("#form_sub").val();
    if (title !== '') {
        $("#sub_error_message").hide();
        $("#form_sub").css("border-bottom", "2px solid #34F458");
    } else {
        $("#sub_error_message").html("*Cant be empty");
        $("#sub_error_message").show();
        $("#form_sub").css("border-bottom", "2px solid #F90A0A");
        error_title = true;
        formHasError = true;
    }
}


function check_code() {
    var code_length = $("#form_code").val().trim().length;
    if (code_length < 10 || code_length > 10) {
        $("#code_error_message").html("*Enter 10 Character Code");
        $("#code_error_message").show();
        $("#form_code").css("border-bottom", "2px solid #F90A0A");
        error_code = true;
        formHasError = true;
    } else {
        $("#code_error_message").hide();
        $("#form_code").css("border-bottom", "2px solid #34F458");
    }
}