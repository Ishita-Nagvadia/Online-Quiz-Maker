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
    <title>Result</title>
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
    $qid = $_GET['qid'];
    $title = $_GET['title'];
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
                            <a class="nav-link " href="dashboard.php">Dashboard</a>
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
            <div class="d-flex main-r card">
                <div class="card-header" style="width: 100%">
                    <b><?php echo $title; ?></b>
                    <form action="export.php" method="post">
                        <button type="submit" name="download" class="btn btn-outline-primary" style="float: right;">CSV Export</button>
                        <input type="hidden" name="qid" value="<?php echo $qid; ?>">
                        <input type="hidden" name="title" value="<?php echo $title; ?>">
                    </form>
                </div>
                <div class="card-body" style="width:100%">
                    <table id="myTable" class="table responsive display cell-border">
                        <thead>
                            <tr>
                                <th>SR.No</th>
                                <th>Participents</th>
                                <th>Correct answer</th>
                                <th>Wrong answer</th>
                                <th>Percentage</th>
                            </tr>
                        </thead>
                        <!-- tbody in notepad -->
                        <tbody>
                            <?php
                            $query1 = "SELECT name, SUM(CASE WHEN answer=1 THEN 1 ELSE 0 END) as rightans, 
                            SUM(CASE WHEN answer=0 THEN 1 ELSE 0 END) as wrongans 
                            FROM result 
                            WHERE qid='$qid' 
                            GROUP BY attendi_code";
                            $result = mysqli_query($conn, $query1);
                            if (mysqli_num_rows($result) > 0) {
                                $i = 1;
                                while ($row = mysqli_fetch_array($result)) {
                                    $totalQue = $row["rightans"] + $row["wrongans"];
                            ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $row["name"] ?></td>
                                        <td><?php echo $row["rightans"]; ?></td>
                                        <td><?php echo $row["wrongans"]; ?></td>
                                        <td><?php echo ($row["rightans"] / 100) * $totalQue . '%'; ?></td>
                                    </tr>
                            <?php
                                    $i++;
                                }
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