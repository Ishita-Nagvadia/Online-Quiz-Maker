<?php
session_start();
if (!isset($_SESSION['uid'])) {
    echo "You have Logged Out";
    echo ("<script>location.href = 'login.php';</script>");
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            var tbl1 = $('#myTable').DataTable({
                "scrollY": "440px",
                "scrollCollapse": true,
                "paging": false,
                "info": false,
                "searching": false,
                "responsive": true
            });
        });
    </script>
    <link rel="stylesheet" href="css/dashboard.css">

</head>

<body style="background-color: rgb(232, 193, 255);">
    <?php
    $conn = mysqli_connect("localhost", "root", "", "quiz3");
    $name = $_SESSION['creator'];
    $uid = $_SESSION['uid'];
    ?>
    <div class="container">
        <div class="d-flex">
            <nav class="navi navbar fixed-top navbar-expand-lg navbar-dark bg-dark">
                <div class="collapse navbar-collapse align-items-start">
                    <div class="col me-auto">
                        <h3 style="margin-left: 10px;color:white;">Welcome <?php echo $name; ?></h3>
                    </div>
                    <ul class="navbar-nav nav justify-content-end nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" style="color: black;" href="dashboard.php">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <!-- <button type="button" class="btn btn-outline-success" style="margin-right: 15px;" onclick="window.location.href='detail.php';">Create new quiz</button> -->
                            <a class="nav-link" href="detail.php">New quiz</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php">Logout</a>
                        </li>
                    </ul>
                </div>
            </nav>
            <hr>
            <div class="d-flex main card">
                <div class="card-header" style="width: 100%"><b>Dashboard</b></div>
                <div class="card-body" style="width:100%">
                    <table id="myTable" class="table responsive display cell-border">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Subject</th>
                                <th>Code</th>
                                <th>Edit</th>
                                <th>Delete</th>
                                <th>Result</th>
                            </tr>
                        </thead>
                        <!-- tbody in notepad -->
                        <tbody>
                            <?php
                            $conn = mysqli_connect("localhost", "root", "", "quiz3");
                            $query = "SELECT * FROM quiz_detail WHERE uid='$uid'";
                            $result = mysqli_query($conn, $query);
                            if (mysqli_num_rows($result) > 0) {
                                $i = 0;
                                while ($row = mysqli_fetch_array($result)) {
                            ?>
                                    <tr>
                                        <td><?php echo $row["quiz_title"] ?></td>
                                        <td><?php echo $row["subject"]; ?></td>
                                        <td><?php echo $row["code"]; ?></td>
                                        <td><button type="button" name="edit" class="btn btn-outline-success btn-sm" <?php echo 'onclick="window.location.href=\'edit.php?qid=' . $row['qid'] . '\'";' ?>><i class="bi bi-pencil"></i></button></td>
                                        <td>
                                            <form method="post">
                                                <button type="submit" id="delete" name="delete" class="btn btn-outline-danger btn-sm" tooltip="Delete"><i class="bi bi-trash"></i></button>
                                                <input type="hidden" name="qid" value="<?php echo $row['qid']; ?>">
                                            </form>
                                        </td>
                                        <td><button type="button" name="result" class="btn btn-outline-primary btn-sm" tooltip="Download" <?php echo 'onclick="window.location.href=\'view_result.php?qid=' . $row['qid'] . '?title='. $row['quiz_title'].'\'";' ?>><i class="bi bi-download"></i></button></td>
                                    </tr>
                            <?php
                                    $i++;
                                }
                                // <?php echo '<a href="edit.php?pid=' . $row["pid"] . '"></a>'
                            }
                            if (!empty($_POST) && isset($_POST["delete"])) {
                                $qid = $_POST['qid'];
                                $query2 = "DELETE FROM result WHERE qid=$qid";
                                $query3 = "DELETE FROM que_table WHERE qid=$qid;";
                                $query4 = "DELETE FROM quiz_detail WHERE qid=$qid";
                                echo ('<script>if (confirm("Are you sure you want to Delete this product?")) {
                                    ' . mysqli_query($conn, $query2) . mysqli_query($conn, $query3) . mysqli_query($conn, $query4) . '
                                    location.href = "dashboard.php";
                                  }</script>');
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>