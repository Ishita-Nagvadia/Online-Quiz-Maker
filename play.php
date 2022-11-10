<?php
session_start();
if (!isset($_SESSION['player_code'])) {
    echo "There was an error";
    echo ("<script>location.href = 'play.php';</script>");
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Play</title>
</head>


<body>
    <form method="post">
        <?php
        $conn = mysqli_connect("localhost", "root", "", "quiz3");
        $name = $_SESSION['player_name'];
        $counter = -1;

        $AttendieCode = uniqid();
        $IsAttendieCodeExists = mysqli_query($conn, "SELECT 1 FROM result WHERE attendi_code='$AttendieCode'");
        while (mysqli_num_rows($IsAttendieCodeExists) > 0) {
            $AttendieCode = uniqid();
            $IsAttendieCodeExists = mysqli_query($conn, "SELECT 1 FROM Result WHERE attendi_code='$AttendieCode'");
        }
        $_SESSION['AttendieCode']=$AttendieCode;

        $code = $_SESSION['player_code'];
        $detail = "SELECT questions.* FROM que_table as questions inner join quiz_detail as quiz on quiz.qid = questions.qid WHERE quiz.CODE='$code'";
        $result = mysqli_query($conn, $detail);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result)) {
                $counter++;
                $qid[$counter] = $row['qid'];
                $que_id[$counter] = $row['que_id'];
                $CorrectAnswer[$counter] = $row['answer'];
        ?>
                <label><?php echo $row["question"]; ?></label><br>
                <input type="hidden" name="hidden_que_id_<?php echo $row["que_id"]; ?>" value="<?php echo $row["que_id"]; ?>">
                <input type="radio" name="r_<?php echo $row["que_id"]; ?>" value="<?php echo $row["A"]; ?>">
                <label><?php echo $row["A"]; ?></label><br>
                <input type="radio" name="r_<?php echo $row["que_id"]; ?>" value="<?php echo $row["B"]; ?>">
                <label><?php echo $row["B"]; ?></label><br>
                <input type="radio" name="r_<?php echo $row["que_id"]; ?>" value="<?php echo $row["C"]; ?>">
                <label><?php echo $row["C"]; ?></label><br>
                <input type="radio" name="r_<?php echo $row["que_id"]; ?>" value="<?php echo $row["D"]; ?>">
                <label><?php echo $row["D"]; ?></label><br>
        <?php
            }
        }
        ?>
        <input type="submit" name="submit">
    </form>
</body>
<?php



if (isset($_POST["submit"])) {
    // print_r($que_id);
    for ($x = 0; $x < count($que_id); $x++) {
        $QuestionID = trim($_POST["hidden_que_id_" . $que_id[$x]]);
        $GivenAnswer = null;
        // $CurrectAnswer1 = mysqli_query($conn, "SELECT answer FROM que_table WHERE qid='$qid' AND que_id='$que_id[$x]'");
        $isAnswerCurrect = false;
        if (isset($_POST['r_' . $que_id[$x]])) {
            $GivenAnswer = $_POST['r_' . $que_id[$x]];
            if ($GivenAnswer != null) {
                $isAnswerCurrect = $CorrectAnswer[$x] == $GivenAnswer;
                
            }
        }

        $insert = "INSERT INTO result (qid,que_id,name,answer,given_answer,attendi_code) VALUES ('$qid[$x]','$que_id[$x]','$name','$isAnswerCurrect','$GivenAnswer','$AttendieCode')";
        $final = mysqli_query($conn, $insert);
    }
    echo ("<script>location.href = 'result.php';</script>");
}
?>

</html>