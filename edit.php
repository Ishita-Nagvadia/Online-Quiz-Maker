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
    <title>Edit Quiz</title>
    <!-- Bootstrap link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <!-- Bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="js/question.js"></script>
    <script type="text/javascript">
        function onConfirm(queId) {
            debugger;
            $("#del_confirm_" + queId).removeClass('display-none');
            $("#del_" + queId).removeClass('display-none');
            $("#no_" + queId).removeClass('display-none');
        }

        function onCancel(queId) {
            debugger;
            $("#del_confirm_" + queId).addClass('display-none');
            $("#del_" + queId).addClass('display-none');
            $("#no_" + queId).addClass('display-none');
        }
    </script>
    <style>
        .d-flex {
            display: flex;
        }

        .top {
            margin-top: 70px;
        }

        .navi {
            color: rgb(0, 0, 0) !important;
        }

        .display-none {
            display: none;
        }
    </style>
</head>

<body style="background-color: rgb(232, 193, 255);">
    <div class="container">
        <div class="d-flex">
            <nav class="navi navbar fixed-top navbar-expand-lg navbar-dark bg-dark">
                <div class="collapse navbar-collapse align-items-start">
                    <div class="me-auto">
                        <h3 style="margin-left: 10px;color:white;">Welcome <?php echo $name; ?></h3>
                    </div>
                    <ul class="navbar-nav nav justify-content-end">
                        <li class="nav-item">
                            <a class="nav-link" href="dashboard.php">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <!-- <button type="button" class="btn btn-outline-success" style="margin-right: 15px;" onclick="window.location.href='question.php?qid=<?php echo $qid ?>">Add question</button> -->
                            <a class="nav-link" href="question.php?qid=<?php echo $qid ?>">Add Question</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php">Logout</a>
                        </li>
                    </ul>
                </div>
            </nav>
            <hr>
            <div class="d-felx top">
                <div class="conatiner">
                    <?php
                    $conn = mysqli_connect("localhost", "root", "", "quiz3");
                    $query = "SELECT * FROM que_table WHERE qid='$qid'";
                    $result = mysqli_query($conn, $query);
                    $counter = -1;
                    if (mysqli_num_rows($result) > 0) {
                        $i = 1;
                        while ($row = mysqli_fetch_array($result)) {
                            $counter++;
                            $qid[$counter] = $row['qid'];
                            $que_id[$counter] = $row['que_id'];
                    ?>
                            <div class="card m-3 p-2" style="border-radius: 30px;">
                                <div class="card-body">
                                    <form class="row justify-content-evenly needs-validation" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
                                        <div style="margin: 10px;" class="col-md-12">
                                            <label class="form-label">Question <?php echo $i; ?>:</label>
                                            <input type="text" id="form_que" class="form-control" name="question" value="<?php echo $row["question"]; ?>">
                                            <input type="hidden" name="hidden_que_id" value="<?php echo $row["que_id"]; ?>">
                                            <div class="errorDiv">
                                                <span class="error_form errorTxt" id="que_error_message"></span>
                                            </div>
                                        </div>
                                        <div style="margin: 10px;" class="col-md-4">
                                            <label class="form-label">Option 1:</label>
                                            <input type="text" id="form_op1" class="form-control" name="op1" value="<?php echo $row["A"]; ?>">
                                            <div class="errorDiv">
                                                <span class="error_form errorTxt" id="op1_error_message"></span>
                                            </div>
                                        </div>
                                        <div style="margin: 10px;" class="col-md-4">
                                            <label class="form-label">Option 2:</label>
                                            <input type="text" id="form_op2" class="form-control" name="op2" value="<?php echo $row["B"]; ?>">
                                            <div class="errorDiv">
                                                <span class="error_form errorTxt" id="op2_error_message"></span>
                                            </div>
                                        </div>
                                        <div style="margin: 10px;" class="col-md-4">
                                            <label class="form-label">Option 3:</label>
                                            <input type="text" id="form_op3" class="form-control" name="op3" value="<?php echo $row["C"]; ?>">
                                            <div class="errorDiv">
                                                <span class="error_form errorTxt" id="op3_error_message"></span>
                                            </div>
                                        </div>
                                        <div style="margin: 10px;" class="col-md-4">
                                            <label class="form-label">Option 4:</label>
                                            <input type="text" id="form_op4" class="form-control" name="op4" value="<?php echo $row["D"]; ?>">
                                            <div class="errorDiv">
                                                <span class="error_form errorTxt" id="op4_error_message"></span>
                                            </div>
                                        </div>
                                        <div style="margin: 10px;" class="col-md-12">
                                            <label class="form-label">Answer:</label>
                                            <input type="text" id="form_ans" class="form-control" name="ans" value="<?php echo $row["answer"]; ?>">
                                            <div class="errorDiv">
                                                <span class="error_form errorTxt" id="ans_error_message"></span>
                                            </div>
                                        </div>
                                        <input type="hidden" name="qid" value="<?php echo $row["qid"]; ?>">
                                        <div style="margin: 10px;">
                                            <button type="submit" name="edit" class="btn btn-outline-success">Save</button>
                                            <input type="button" name="confirm" class="btn btn-outline-danger" id="confirm" value="Delete" onclick="onConfirm(<?php echo $row['que_id']; ?>)" />
                                        </div>
                                        <label class="display-none" id="del_confirm_<?php echo $row["que_id"]; ?>">Are you sure you want to delete?</label>
                                        <button type="submit" class="display-none" name="delete" id="del_<?php echo $row["que_id"]; ?>">Yes</button>
                                        <input type="button" class="display-none" name="no" id="no_<?php echo $row["que_id"]; ?>" value="No" onclick="onCancel(<?php echo $row['que_id']; ?>)">
                                    </form>
                                </div>
                            </div>

                    <?php
                            $i++;
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <?php
    if (!empty($_POST) && isset($_POST["edit"])) {
        $QuestionID = trim($_POST["hidden_que_id"]);
        $que = trim($_POST["question"]);
        $op1 = trim($_POST["op1"]);
        $op2 = trim($_POST["op2"]);
        $op3 = trim($_POST["op3"]);
        $op4 = trim($_POST["op4"]);
        $answer = trim($_POST["ans"]);
        $qid_update = $_POST["qid"];
        $query2 = "UPDATE que_table SET question='$que',A='$op1',B='$op2',C='$op3',D='$op4',answer='$answer' WHERE qid=$qid_update AND que_id=$QuestionID";
        $result2 =  mysqli_query($conn, $query2);
        header("Location: edit.php?qid=" . $qid_update);
    }
    if (!empty($_POST) && isset($_POST["delete"])) {
        $QuestionID = trim($_POST["hidden_que_id"]);
        $que = trim($_POST["question"]);
        $op1 = trim($_POST["op1"]);
        $op2 = trim($_POST["op2"]);
        $op3 = trim($_POST["op3"]);
        $op4 = trim($_POST["op4"]);
        $answer = trim($_POST["ans"]);
        $qid_update = $_POST["qid"];

        $query2 = "DELETE FROM result WHERE qid=$qid_update AND que_id=$QuestionID";
        $query3 = "DELETE FROM que_table WHERE qid=$qid_update AND que_id=$QuestionID";

        // echo ('<script>if (confirm("Are you sure you want to Delete this product?")) {
        //         ' . mysqli_query($conn, $query2) . mysqli_query($conn, $query3) . '
        //         location.href = "edit.php?qid="'.$qid_update.'";
        //     }</script>');
        // echo ('<script>if (confirm("Are you sure you want to Delete this product?")) {
        //     document.cookie = "confirm=1";
        //         location.href = "edit.php?qid=' . $qid_update . '";

        //     }
        //     else {
        //         document.cookie = "confirm=0";
        //         location.href = "edit.php?qid=' . $qid_update . '";
        //     }
        //     </script>');

        mysqli_query($conn, $query2);
        mysqli_query($conn, $query3);
        header("Location: edit.php?qid=" . $qid_update);
    }
    ?>
</body>

</html>