<?php 
include 'koneksi.php';   
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title>Login FastFood.net</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="asset/login/vendor/bootstrap/css/bootstrap.min.css"><!--logunsuc-->

	<link rel="stylesheet" type="text/css" href="asset/login/css/util.css">
	<link rel="stylesheet" type="text/css" href="asset/login/css/main.css">
</head>

<body>
	<!--LOGIN PELANGGAN-->
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form class="login100-form validate-form" method="POST">
					<span class="login100-form-title p-b-26">
						FastFood.net : <br>User Login
					</span>
					<!--INPUT EMAIL PELANGGAN-->
					<div class="wrap-input100 validate-input" data-validate = "Valid email is: a@b.c">
						<input class="input100" type="text" name="email">
						<span class="focus-input100" data-placeholder="Insert Your Email"></span>
					</div>
					<!--INPUT PASS PELANGGAN-->
					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<span class="btn-show-pass">
							<i class="zmdi zmdi-eye"></i>
						</span>
						<input class="input100" type="password" name="password">
						<span class="focus-input100" data-placeholder="Insert Your Password"></span>
					</div>
					<!--TMBL LOGIN-->
					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn" name="submit">
								Login
							</button>
						</div>
					</div>
					<!--DAFTAR AKUN-->
					<div class="text-center p-t-115">
						<span class="txt1">
							Belum punya akun?
						</span>
						<a class="txt2" href="register.php">
							Sign Up
						</a><br>
						<!--MASUK SBG ADMIN-->
						<span class="txt1">
							Login sebagai Admin?
						</span>
						<a class="txt2" href="admin/login.php">
							Klik disini
						</a>
					</div>
				</form>

				<?php 
				if (isset($_POST['submit'])) {
					$email = mysqli_escape_string($conn,$_POST['email']);
					$password = mysqli_escape_string($conn,$_POST['password']);

					$password = md5($password);
					$query=$conn->query("SELECT * FROM pelanggan WHERE email_pelanggan='$email' AND password_pelanggan='$password'");
					$result=$query->num_rows;
					if ($result==1) {
						session_start();
						$_SESSION['login']=$query->fetch_assoc();
						echo "<br>";
						echo "<div class='alert alert-info'><center>Login Succeeded</center></div>";
						echo "<meta http-equiv='refresh' content='1;url=index.php'>";
					}
					else{
						echo "<br>";
						echo "<div class='alert alert-danger'><center>Login Failed</center></div>";
						echo "<meta http-equiv='refresh' content='1;url=login.php'>";
					}
				}
				?>
			</div>
		</div>
	</div>

<div class="footer">
	<center><p>&copy; Tugas Rancang Pemrograman Web 2023.</p></center>
</div>

</body>
</html>