<?php
session_start();
if (!isset($_SESSION['uid'])) {
    echo "You have Logged Out";
    echo ("<script>location.href = 'login.php';</script>");
}
$name = $_SESSION['creator'];
$qid = $_GET['qid'];
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Quiz Maker</title>
    <!-- Bootstrap link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <!-- Bootstrap icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <!-- Bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="css/question.css">
    <script src="js/question.js"></script>
    <?php
    if (isset($_POST["add"])) {
        $que = $_POST["question"];
        $A = $_POST["op1"];
        $B = $_POST["op2"];
        $C = $_POST["op3"];
        $D = $_POST["op4"];
        $ans = $_POST["ans"];
        // $qid = $_SESSION['qid'];
        // $qid = $_GET['qid'];
        
        $conn = mysqli_connect("localhost", "root", "", "quiz3");
        $query = "INSERT INTO que_table (qid,question,A,B,C,D,answer) VALUES ('$qid','$que','$A','$B','$C','$D','$ans')";
        if (mysqli_query($conn, $query)) {
            echo ("<script>location.href = 'question.php?qid=" . $qid . "';</script>");
        } else {
            echo "<script>alert('There was an error');</script>";
            echo ("<script>location.href = 'question.php';</script>");
        }
    } elseif (isset($_POST["complete"])) {
        $que = $_POST["question"];
        $A = $_POST["op1"];
        $B = $_POST["op2"];
        $C = $_POST["op3"];
        $D = $_POST["op4"];
        $ans = $_POST["ans"];
        // $qid = $_SESSION['qid'];
        $qid = $_GET['qid'];
        $conn = mysqli_connect("localhost", "root", "", "quiz3");
        $query = "INSERT INTO que_table (qid,question,A,B,C,D,answer) VALUES ('$qid','$que','$A','$B','$C','$D','$ans')";
        if (mysqli_query($conn, $query)) {
            echo ("<script>location.href = 'dashboard.php';</script>");
        } else {
            echo "<script>alert('There was an error');</script>";
            echo ("<script>location.href = 'question.php?qid=" . $qid . "';</script>");
        }
        // echo ("<script>location.href = 'question.php';</script>");
    }
    ?>
</head>

<body>

    <body>
        <div class="cnt">
            <div class="container-fluid">
                <nav class="navi navbar fixed-top navbar-expand-lg navbar-dark bg-dark">
                    <div class="collapse navbar-collapse align-items-start">
                        <div class="col me-auto">
                            <h3 style="margin-left: 10px;color:white;">Welcome <?php echo $name; ?></h3>
                        </div>
                        <ul class="navbar-nav nav justify-content-end nav-tabs">
                            <li class="nav-item">
                                <a class="nav-link" href="dashboard.php">Dashboard</a>
                            </li>
                            <li class="nav-item">
                                <!-- <button type="button" class="btn btn-outline-success" style="margin-right: 15px;" onclick="window.location.href='detail.php';">Create new quiz</button> -->
                                <a class="nav-link active" style="color: black;" href="#">Add Question</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="logout.php">Logout</a>
                            </li>
                        </ul>
                    </div>
                </nav>
                <div class="d-flex row main-pE card p-3">
                    <form method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">
                        <h2 style="text-align: center;margin-top:20px"> Add Question</h2>
                        <div class="imgdiv has-validation">
                            <i class="bi bi-question-circle-fill"></i>
                            <input class="inp form-control" id="form_que" type="text" name="question" placeholder="Enter Question" aria-describedby="inputGroupPrepend">
                            <div class="errorDiv">
                                <span class="error_form errorTxt" id="que_error_message"></span>
                            </div>
                        </div>

                        <div class="imgdiv has-validation">
                            <i class="bi bi-ui-radios-grid"></i>
                            <input class="inp form-control" id="form_op1" type="text" name="op1" placeholder="Enter Option1" aria-describedby="inputGroupPrepend" style="margin-top: 20px;">
                            <div class="errorDiv">
                                <span class="error_form errorTxt" id="op1_error_message"></span>
                            </div>
                        </div>
                        <div class="imgdiv has-validation">
                            <i class="bi bi-ui-radios-grid"></i>
                            <input class="inp form-control" id="form_op2" type="text" name="op2" placeholder="Enter Option2" aria-describedby="inputGroupPrepend" style="margin-top: 20px;">
                            <div class="errorDiv">
                                <span class="error_form errorTxt" id="op2_error_message"></span>
                            </div>
                        </div>
                        <div class="imgdiv has-validation">
                            <i class="bi bi-ui-radios-grid"></i>
                            <input class="inp form-control" id="form_op3" type="text" name="op3" placeholder="Enter Option3" aria-describedby="inputGroupPrepend" style="margin-top: 20px;">
                            <div class="errorDiv">
                                <span class="error_form errorTxt" id="op3_error_message"></span>
                            </div>
                        </div>
                        <div class="imgdiv has-validation">
                            <i class="bi bi-ui-radios-grid"></i>
                            <input class="inp form-control" id="form_op4" type="text" name="op4" placeholder="Enter Option4" aria-describedby="inputGroupPrepend" style="margin-top: 20px;">
                            <div class="errorDiv">
                                <span class="error_form errorTxt" id="op4_error_message"></span>
                            </div>
                        </div>
                        <div class="imgdiv has-validation">
                            <i class="bi bi-check-circle-fill"></i>
                            <input class="inp form-control" id="form_ans" type="text" name="ans" placeholder="Enter Answer" aria-describedby="inputGroupPrepend" style="margin-top: 20px;">
                            <div class="errorDiv">
                                <span class="error_form errorTxt" id="ans_error_message"></span>
                            </div>
                        </div>
                        <div>
                            <button type="submit" style="margin-left:13rem;margin-top:20px" name="add" class="btn btn-primary btn-sm btn-block mb-5" style="width: 100%;display:inline-block">ADD</button>
                            <button type="submit" style="margin-left:13rem;margin-top:20px" name="complete" class="btn btn-primary btn-sm btn-block mb-5" style="width: 100%;display:inline-block">Complete</button>
                            <h4 style="margin-left:13rem;margin-top:20px" name="add" class="btn btn-primary btn-sm btn-block mb-5" style="width: 100%;color:white"><a style="color:white;display:inline-block" 
                            href="csv.php?qid=<?php echo $qid?>">Upload csv</a></h4>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>

</html>