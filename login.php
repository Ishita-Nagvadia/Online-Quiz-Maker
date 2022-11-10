<?php
    session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Login</title>
	<!-- Bootstrap link -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
	<!-- Bootstrap icon -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
	<!-- Bootstrap js -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
	<!-- jquery -->
	<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
	<link rel="stylesheet" type="text/css" href="css/udetail.css">
	<script src="js/login.js"></script>
	<?php
        if(isset($_POST["login"])){
            $uemail = trim($_POST["email"]);
            $upass = trim($_POST["password"]);
			$pass = md5($upass); 
            $conn = mysqli_connect("localhost","root","","quiz3");

			$query = "SELECT uid,name,email,password FROM user WHERE email='$uemail'";
            $result = mysqli_query($conn,$query);
            $rowCount = mysqli_num_rows($result);
			
			if($rowCount>0){
				$fetcharray = mysqli_fetch_assoc($result);
				$dbpass = $fetcharray['password'];
				$dbemail = $fetcharray['email'];
				if($uemail == $dbemail && $pass == $dbpass){
					$_SESSION['uid'] = $fetcharray['uid'];
					$_SESSION['creator'] = $fetcharray['name'];
					echo ("<script>location.href = 'dashboard.php';</script>");
				}
				else {
					echo '<script type="text/javascript">';
					echo ' alert("User dose not exist. Try Again")';
					echo '</script>';
				}
			}
			
        }        
    ?>
</head>
<body>
	<div class="cnt">
		<div class="container-fluid">
			<div class="d-flex row main card">
    			<div class="col-md-6 p-0 m-0">
					<img src="images/green.svg" class="img-fluid img-top">
    			</div>
    			<div id="registration_form" class="content p-5 col-6 card-body hgt">
					<form id="registration_form" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post" class="row needs-validation g-4 p-2" novalidate>
						<h2 style="text-align: center;">Welcome Back</h2>
						<div class="imgdiv has-validation">
							<i class="bi bi-envelope-fill"></i>
							<input class="inp form-control" type="email" name="email" id="form_email" placeholder="Email" aria-describedby="inputGroupPrepend">
							<div class="errorDiv">
								<span class="error_form errorTxt" id="email_error_message"></span>
							</div>
						</div>
						<div class="imgdiv has-validation">
							<i class="bi bi-lock-fill"></i>
							<input class="inp form-control" type="password" name="password" id="form_password" placeholder="Password" aria-describedby="inputGroupPrepend">
							<div class="errorDiv">
								<span class="error_form errorTxt" id="password_error_message"></span>
							</div>
						</div>
						<div>
							<button type="submit" name="login" class="btn btn-primary btn-sm btn-block" style="width: 100%;">LogIn</button>
						</div>
						<p style="text-align: center"><a class="txtlink1" href="index.php">New Member</a></p>
					</form>
				</div>
			</div>
		</div>
	</div>
</body>
</html>