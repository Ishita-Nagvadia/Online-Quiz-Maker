<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
	<title>Signup</title>
	<!-- Bootstrap link -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
	<!-- Bootstrap icon -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
	<!-- Bootstrap js -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
	<!-- jquery -->
	<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
	<script type="text/javascript" src="js/signup.js"></script>
	<link rel="stylesheet" href="css/signup.css">
	<?php
	if (isset($_POST["register"]) && !empty($_POST)) {
		$username = trim($_POST["uname"]);
		$useremail = trim($_POST["email"]);
		$institute = $_POST["institute"];
		$pass = trim($_POST["password"]);
		$upass = md5($pass);

		$conn = mysqli_connect("localhost", "root", "", "quiz3");
		$query1 = "SELECT email FROM user WHERE email='$useremail'";
		$result = mysqli_query($conn, $query1);
		$rowCount = mysqli_num_rows($result);

		if ($rowCount > 0) {
			echo '<script type="text/javascript">';
			echo ' alert("User already exist. Try Again")';
			echo '</script>';
		} else {
			$insert = "INSERT INTO user (name,email,institute,password) VALUES('$username','$useremail','$institute','$upass')";
			$result_ins = mysqli_query($conn, $insert);
			if ($result_ins) {
				$query1 = "SELECT uid from user WHERE email='$useremail'";
				$result = mysqli_query($conn, $query1);
				$rowCount = mysqli_num_rows($result);
				if ($rowCount > 0) {
					$fetcharray = mysqli_fetch_assoc($result);
					$_SESSION['uid'] = $fetcharray['uid'];
					$_SESSION['creator'] = $fetcharray['name'];
					echo ("<script>location.href = 'dashboard.php';</script>");
				}
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
					<img src="images/purple.svg" class="img-fluid img-top">
				</div>
				<div id="registration_form" class="content p-5 col-6 card-body hgt">
					<form id="registration_form" class="row g-4 p-2" method="post">
						<h2 style="margin-left: 10px;">Signup</h2>
						<div class="imgdiv">
							<i class="bi bi-person-fill"></i>
							<input class="inp form-control" type="text" id="form_uname" name="uname" placeholder="Username">
							<div class="errorDiv">
								<span class="error_form errorTxt" id="uname_error_message"></span>
							</div>
						</div>
						<div class="imgdiv">
							<i class="bi bi-envelope-fill"></i>
							<input class="inp form-control" type="email" id="form_email" name="email" placeholder="Email">
							<div class="errorDiv">
								<span class="error_form errorTxt" id="email_error_message"></span>
							</div>
						</div>
						<div class="imgdiv">
							<i class="bi bi-briefcase-fill"></i>
							<input class="inp form-control" type="text" id="form_ins" name="institute" placeholder="Institute Name">
							<div class="errorDiv">
								<span class="error_form errorTxt" id="ins_error_message"></span>
							</div>
						</div>
						<div class="imgdiv">
							<i class="bi bi-lock-fill"></i>
							<input class="inp form-control" type="password" id="form_password" name="password" placeholder="Password">
							<div class="errorDiv">
								<span class="error_form errorTxt" id="password_error_message"></span>
							</div>
						</div>
						<div class="imgdiv">
							<i class="bi bi-lock"></i>
							<input class="inp form-control" type="password" id="form_cpassword" name="cpassword" placeholder="Confirm Password">
							<div class="errorDiv">
								<span class="error_form errorTxt" id="cpassword_error_message"></span>
							</div>
						</div>
						<div>
							<button type="submit" name="register" class="btn btn-primary btn-sm btn-block" style="width:100%">Register</button>
						</div>
						<p style="text-align: center"><a class="txtlink1" href="login.php">Already a Member</a></p>
					</form>
				</div>
			</div>
		</div>
	</div>
</body>

</html>