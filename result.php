<?php
    session_start();
if (!isset($_SESSION['AttendieCode'])) {
    echo "There was an error";
    echo ("<script>location.href = 'playentry.php';</script>");
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Result</title>
    </head>
    <body>
        <?php
            $conn = mysqli_connect("localhost", "root", "", "quiz3");
            $code = $_SESSION['player_code'];
            $AttendieCode = $_SESSION['AttendieCode'];
            $title = "SELECT qid,quiz_title FROM quiz_detail WHERE code='$code'";
            $qid = null;
            $title_result = mysqli_query($conn,$title);
            if (mysqli_num_rows($title_result) > 0) {
                $row = mysqli_fetch_array($title_result);
                $qTitle = $row['quiz_title'];
                $qid = $row['qid'];
            }
            $score = "SELECT name, SUM(CASE WHEN answer=1 THEN 1 ELSE 0 END) as rightans,
            SUM(CASE WHEN answer=0 THEN 1 ELSE 0 END) as wrongans
            FROM result
            WHERE attendi_code='$AttendieCode'";
            
            $score_result = mysqli_query($conn,$score); 
            if (mysqli_num_rows($score_result) > 0) {
                $row = mysqli_fetch_array($score_result);
                $rightans = $row['rightans'];
                $wrongans = $row['wrongans'];
                $totalQue = $rightans+$wrongans;
            }
        ?>
        <h1><?php echo $qTitle;?></h1>
        <p><?php echo $_SESSION['player_name'].' Score: '.$rightans.'/'.$totalQue;?></p>
        <form method="post"><input type="submit" name="view_score" value="View Score"></form>
        <?php
            if(isset($_POST["view_score"])){
               $view="SELECT questions.*,r.given_answer,r.answer as isAnsCorrect FROM que_table as questions 
               inner join quiz_detail as quiz on quiz.qid = questions.qid 
               inner join result as r on r.que_id = questions.que_id 
               WHERE quiz.CODE='$code'AND r.attendi_code = '$AttendieCode';";

                $view_result = mysqli_query($conn, $view);
                if (mysqli_num_rows($view_result) > 0) {
                    while ($row = mysqli_fetch_array($view_result)) {
                ?>
                        <label><?php echo $row["question"]; ?></label><br>
                        <input type="hidden" name="hidden_que_id_<?php echo $row["que_id"]; ?>" value="<?php echo $row["que_id"]; ?>" >
                        <input type="radio" name="r_<?php echo $row["que_id"]; ?>" value="<?php echo $row["A"]; ?>" <?php echo ($row["given_answer"]== $row["A"] ?  "checked" : "" )?> <?php  ($row["isAnsCorrect"]== true ?  "class='radioGreen'" : "class='radioRed'") ;  ?> disabled>
                        <label><?php echo $row["A"]; ?></label><br>
                        <input type="radio" name="r_<?php echo $row["que_id"]; ?>" value="<?php echo $row["B"]; ?>" <?php echo ($row["given_answer"]== $row["B"] ?  "checked" : "" )?> <?php  ($row["isAnsCorrect"]== true ?  "class='radioGreen'" : "class='radioRed'") ;  ?> disabled>
                        <label><?php echo $row["B"]; ?></label><br>
                        <input type="radio" name="r_<?php echo $row["que_id"]; ?>" value="<?php echo $row["C"]; ?>" <?php echo ($row["given_answer"]== $row["C"] ?  "checked" : "" )?> <?php  ($row["isAnsCorrect"]== true ?  "class='radioGreen'" : "class='radioRed'") ;  ?> disabled>
                        <label><?php echo $row["C"]; ?></label><br>
                        <input type="radio" name="r_<?php echo $row["que_id"]; ?>" value="<?php echo $row["D"]; ?>" <?php echo ($row["given_answer"]== $row["D"] ?  "checked" : "" )?> <?php  ($row["isAnsCorrect"]== true ?  "class='radioGreen'" : "class='radioRed'") ;  ?> disabled>
                        <label><?php echo $row["D"]; ?></label><br>
                        <?php echo ($row["isAnsCorrect"]== false) ?  "<span>Correct Answer is : ".$row["answer"]."</span>" : "" ;  ?>
                        <hr><br />
                <?php
                    }
                }    
            }
        ?>
    </body>
</html>