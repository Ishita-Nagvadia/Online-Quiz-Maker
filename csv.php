<?php
session_start();
if (!isset($_SESSION['uid'])) {
    echo "You have Logged Out";
    echo ("<script>location.href = 'login.php';</script>");
}
?>
<html>

<head>
    <title>CSV Upload</title>
</head>

<?php

if (isset($_POST["csv_submit"])) {
    // $qid = $_SESSION['qid'];
    $conn = mysqli_connect("localhost", "root", "", "quiz3");
    $row = 0;
    $qid = $_GET['qid'];
    $filename = $_FILES["file"]["tmp_name"];
    if ($_FILES["file"]["size"] > 0) {
        $file = fopen($filename, "r");
        while (($getData = fgetcsv($file, 10000, ",")) !== FALSE) {
            $row++;
            if ($row == 1) continue;
            $sql = "INSERT into que_table (qid,question,A,B,C,D,answer) 
                   values ('$qid','" . $getData[0] . "','" . $getData[1] . "','" . $getData[2] . "','" . $getData[3] . "','" . $getData[4] . "','" . $getData[5] . "')";
            $result = mysqli_query($conn, $sql);
            // if (!empty($result)) {
            //     echo "<script type=\"text/javascript\">
            //     alert(\"CSV File has been successfully Imported.\");
            //   </script>";
            // } else {
            //     echo "<script type=\"text/javascript\">
            //     alert(\"Invalid File:Please Upload CSV File.\");
            //     </script>";
            // }
        }

        fclose($file);
        echo ("<script>location.href = 'dashboard.php';</script>");
    }
}
?>


<body>
    <h2>CSV file upload</h2>
    <p>Step 1: File Creation</p>
    <ul>
        <li>Create an excel file</li>
        <li>Write 6 column headers in first coloumn as shown in image</li>
        <li>Add your questions, options and answers</li>
        <li>After complition the file should look like the image below</li>
    </ul>
    <img src="images/fileFormat.PNG">
    <p>Step 2: Saving File</p>
    <ul>
        <li>Go to files</li>
        <li>Click on Saveas</li>
        <li>Type the file name</li>
        <li>Choose the format shown in the image below</li>
    </ul>
    <p><b>Note:<b> Select the correct format or else the file would not be uploaded in the databse</p>
    <img src="images/fileType.PNG">
    <p>Step 3: Upload CSV File</p>
    <form method="post" enctype="multipart/form-data">
        <input type="file" id="file" name="file" accept=".csv">
        <button type="submit" name="csv_submit">Submit</button>
    </form>
</body>

</html>