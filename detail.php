<?php
session_start();
if (!isset($_SESSION['uid'])) {
    echo "You have Logged Out";
    echo ("<script>location.href = 'login.php';</script>");
}
$name = $_SESSION['creator'];
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

    <link rel="stylesheet" type="text/css" href="css/detail.css">
    <script src="js/detail.js"></script>
    <?php
    $conn = mysqli_connect("localhost", "root", "", "quiz3");
    if (isset($_POST["next"])) {
        $title = $_POST["title"];
        $sub = $_POST["subject"];
        $code = $_POST["code"];
        $uid = $_SESSION['uid'];

        $check = "SELECT uid,quiz_title,subject from quiz_detail WHERE quiz_title='$title' AND subject='$sub' AND uid=$uid";
        $check_result = mysqli_query($conn, $check);
        $rowCount_check = mysqli_num_rows($check_result);
        if ($rowCount_check > 0) {
            echo '<script type="text/javascript">';
            echo ' alert("Quiz Title already exist for this subject. Try Again")';
            echo '</script>';
        } else {
            $query = "INSERT INTO quiz_detail (uid,quiz_title,subject,code) VALUES ('$uid','$title','$sub','$code')";
            //$result = mysqli_query($conn,$query);
            if (mysqli_query($conn, $query)) {
                $query1 = "SELECT qid,uid from quiz_detail WHERE quiz_title='$title' AND subject='$sub' AND uid=$uid";
                $result = mysqli_query($conn, $query1);
                $rowCount = mysqli_num_rows($result);
                if ($rowCount > 0) {
                    // echo "id";
                    $fetcharray = mysqli_fetch_assoc($result);
                    // $_SESSION['qid'] = $fetcharray['qid'];
                    $qid = $fetcharray['qid'];
                    // $_SESSION['uid'] = $fetcharray['uid'];
                    // echo ("<script>location.href = 'question.php';</script>");
                    echo ("<script>location.href = 'question.php?qid=".$qid."';</script>");
                }
            } else {
                echo "<script>alert('There was an error');</script>";
                echo ("<script>location.href = 'detail.php';</script>");
            }
        }
    }
    ?>
</head>

<body>
    <div class="cnt">
        <div class="container-fluid">
            <div class="d-flex row main-pE card p-3">
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
                                <a class="nav-link active" style="color: black;"  href="detail.php">New quiz</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="logout.php">Logout</a>
                            </li>
                        </ul>
                    </div>
                </nav>
                <form method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" class="row needs-validation g-4 p-2 m-auto">
                    <h2 style="text-align: center;margin-top:20px">Enter details</h2>
                    <div class="imgdiv has-validation">
                        <i class="bi bi-person-circle"></i>
                        <input class="inp form-control" id="form_title" style="margin-top:20px" type="text" name="title" placeholder="Enter Quiz Title" aria-describedby="inputGroupPrepend">
                        <div class="errorDiv">
                            <span class="error_form errorTxt" id="title_error_message"></span>
                        </div>
                    </div>
                    <div class="imgdiv has-validation">
                        <i class="bi bi-journal"></i>
                        <input class="inp form-control" id="form_sub" style="margin-top:20px" type="text" name="subject" placeholder="Enter Subject" aria-describedby="inputGroupPrepend">
                        <div class="errorDiv">
                            <span class="error_form errorTxt" id="sub_error_message"></span>
                        </div>
                    </div>
                    <div class="imgdiv has-validation">
                        <i class="bi bi-lock-fill"></i>
                        <input class="inp form-control" id="form_code" style="margin-top:20px" type="text" name="code" placeholder="Enter Code" aria-describedby="inputGroupPrepend">
                        <div class="errorDiv">
                            <span class="error_form errorTxt" id="code_error_message"></span>
                        </div>
                    </div>
                    <div>
                        <button type="submit" name="next" class="btn btn-primary btn-sm btn-block mb-5" style="width: 100%;">Next</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</body>

</html>