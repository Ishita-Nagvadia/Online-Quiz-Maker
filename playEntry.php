<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Play Entry</title>
    <!-- Bootstrap link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <!-- Bootstrap icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <!-- Bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="css/entry.css">
    <script src="js/entry.js"></script>
    <?php
    if (isset($_POST["play"])) {
        $name = trim($_POST["name"]);
        // $class = trim($_POST["class"]);
        $ucode = trim($_POST["code"]);
        $conn = mysqli_connect("localhost", "root", "", "quiz3");

        $query = "SELECT 1 FROM quiz_detail WHERE code='$ucode'";
        // $result = mysqli_query($conn, $query);
        // $rowCount = mysqli_num_rows($result);
        
        if (mysqli_query($conn, $query)) {
            session_start();
            $_SESSION['player_code'] = $ucode;
            $_SESSION['player_name'] = $name;
            echo ("<script>location.href = 'play.php';</script>");
        } else {
            echo '<script type="text/javascript">';
            echo ' alert("Something went wrong try again. Try Again")';
            echo '</script>';
        }

        /* if ($rowCount > 0) {
            $fetcharray = mysqli_fetch_assoc($result);
            $dbpass = $fetcharray['code'];
            if ($upass == $dbpass) {
                // session_start();
                // $_SESSION['attendi_code'] = $fetcharray['attendi_code'];
                $GUID = uniqid();
                $insert_id = "INSERT INTO result(qid,name,attendi_code) value('$GUID') WHERE $name";
                echo ("<script>location.href = 'play.php';</script>");
            } else {
                echo '<script type="text/javascript">';
                echo ' alert("Something went wrong try again. Try Again")';
                echo '</script>';
            }
        } */
    }
    ?>
</head>

<body>
    <div class="cnt">
        <div class="container-fluid">
            <div class="d-flex row main-pE card">
                <form id="registration_form" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post" class="row needs-validation g-4 p-2 m-auto" novalidate>
                    <h2 style="text-align: center;">Quiz Play</h2>
                    <div class="imgdiv has-validation">
                        <i class="bi bi-envelope-fill"></i>
                        <input class="inp form-control" type="text" name="name" id="form_name" placeholder="Full Name" aria-describedby="inputGroupPrepend">
                        <div class="errorDiv">
                            <span class="error_form errorTxt" id="name_error_message"></span>
                        </div>
                    </div>
                    <!-- <div class="imgdiv has-validation">
                        <i class="bi bi-envelope-fill"></i>
                        <input class="inp form-control" type="text" name="class" id="form_class" placeholder="Class Name" aria-describedby="inputGroupPrepend">
                        <div class="errorDiv">
                            <span class="error_form errorTxt" id="class_error_message"></span>
                        </div>
                    </div> -->
                    <div class="imgdiv has-validation">
                        <i class="bi bi-lock-fill"></i>
                        <input class="inp form-control" type="password" name="code" id="form_password" placeholder="Code" aria-describedby="inputGroupPrepend">
                        <div class="errorDiv">
                            <span class="error_form errorTxt" id="password_error_message"></span>
                        </div>
                    </div>
                    <div>
                        <button type="submit" name="play" class="btn btn-primary btn-sm btn-block mb-5" style="width: 100%;">PLAY</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>