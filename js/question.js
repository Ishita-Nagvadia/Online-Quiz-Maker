var error_question = false;
var error_op1 = false;
var error_op2 = false;
var error_op3 = false;
var error_op4 = false;
var error_answer = false;
$(document).ready(function() {
    $("#que_error_message").hide();
    $("#op1_error_message").hide();
    $("#op2_error_message").hide();
    $("#op3_error_message").hide();
    $("#op4_error_message").hide();
    $("#ans_error_message").hide();

    $("#form_que").focusout(function() {
        check_que();
    });
    $("#form_op1").focusout(function() {
        check_op1();
    });
    $("#form_op2").focusout(function() {
        check_op2();
    });
    $("#form_op3").focusout(function() {
        check_op3();
    });
    $("#form_op4").focusout(function() {
        check_op4();
    });
    $("#form_ans").focusout(function() {
        check_ans();
    });

    $("#registration_form").submit(function() {
        error_question = false;
        error_op1 = false;
        error_op2 = false;
        error_op3 = false;
        error_op4 = false;
        error_answer = false;
        formHasError = false;
        check_que();
        check_op1();
        check_op2();
        check_op3();
        check_op4();
        check_ans();

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


function check_que() {
    var ins = $("#form_que").val();
    if (ins == '') {
        $("#que_error_message").html("*shouldn't be null");
        $("#que_error_message").show();
        $("#form_que").css("border-bottom", "2px solid #F90A0A");
        error_class = true;
        formHasError = true;
    } else {
        $("#que_error_message").hide();
        $("#form_que").css("border-bottom", "2px solid #34F458");
    }
}

function check_op1() {
    var ins = $("#form_op1").val();
    if (ins == '') {
        $("#op1_error_message").html("*shouldn't be null");
        $("#op1_error_message").show();
        $("#form_op1").css("border-bottom", "2px solid #F90A0A");
        error_class = true;
        formHasError = true;
    } else {
        $("#op1_error_message").hide();
        $("#form_op1").css("border-bottom", "2px solid #34F458");
    }
}

function check_op2() {
    var ins = $("#form_op2").val();
    if (ins == '') {
        $("#op2_error_message").html("*shouldn't be null");
        $("#op2_error_message").show();
        $("#form_op2").css("border-bottom", "2px solid #F90A0A");
        error_class = true;
        formHasError = true;
    } else {
        $("#op1_error_message").hide();
        $("#form_op2").css("border-bottom", "2px solid #34F458");
    }
}

function check_op3() {
    var ins = $("#form_op3").val();
    if (ins == '') {
        $("#op3_error_message").html("*shouldn't be null");
        $("#op3_error_message").show();
        $("#form_op3").css("border-bottom", "2px solid #F90A0A");
        error_class = true;
        formHasError = true;
    } else {
        $("#op3_error_message").hide();
        $("#form_op3").css("border-bottom", "2px solid #34F458");
    }
}

function check_op4() {
    var ins = $("#form_op4").val();
    if (ins == '') {
        $("#op4_error_message").html("*shouldn't be null");
        $("#op4_error_message").show();
        $("#form_op4").css("border-bottom", "2px solid #F90A0A");
        error_class = true;
        formHasError = true;
    } else {
        $("#op4_error_message").hide();
        $("#form_op4").css("border-bottom", "2px solid #34F458");
    }
}

function check_ans() {
    var ins = $("#form_ans").val();
    if (ins == '') {
        $("#ans_error_message").html("*shouldn't be null");
        $("#ans_error_message").show();
        $("#form_ans").css("border-bottom", "2px solid #F90A0A");
        error_class = true;
        formHasError = true;
    } else {
        $("#ans_error_message").hide();
        $("#form_ans").css("border-bottom", "2px solid #34F458");
    }
}