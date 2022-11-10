<?php
$conn = mysqli_connect("localhost", "root", "", "quiz3");
if (isset($_POST["download"])) {
    $qid = $_POST["qid"];
    echo "export in";
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=' . $_POST["title"] . '_result.csv');
    $output = fopen("php://output", "w");
    fputcsv($output, array('Name', 'Correct answer', 'Wrong answer'));
    $query = "SELECT name, SUM(CASE WHEN answer=1 THEN 1 ELSE 0 END) as rightans, 
                            SUM(CASE WHEN answer=0 THEN 1 ELSE 0 END) as wrongans 
                            FROM result 
                            WHERE qid='$qid'
                            GROUP BY attendi_code";
    $result = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        fputcsv($output, $row);
    }
    fclose($output);
}
?>