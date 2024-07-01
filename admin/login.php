<?php 
include '../koneksi.php';   
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title>FastFood.net</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../asset/login/vendor/bootstrap/css/bootstrap.min.css"> <!--loginsuc-->
	<link rel="stylesheet" type="text/css" href="../asset/login/css/util.css"><!--admin tabel-->
	<link rel="stylesheet" type="text/css" href="../asset/login/css/main.css">
</head>

<body>
	<!--LOGIN ADMIN-->
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form class="login100-form validate-form" method="POST">
					<span class="login100-form-title p-b-26">
						FastFood.net : <br>Login Admin
					</span>
					<!--INPUT USERNAME-->
					<div class="wrap-input100 validate-input" data-validate = "Insert Username">
						<input class="input100" type="text" name="username">
						<span class="focus-input100" data-placeholder="Insert Your Username"></span>
					</div>
					<!--INPUT PASS-->
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
					<!--MASUK SEBAGAI USER-->
					<div class="text-center p-t-115">
						<span class="txt1">
							Login as User?
						</span>
						<a class="txt2" href="../login.php">
							Click here
						</a>
					</div>
				</form>

				<?php 
				if (isset($_POST['submit'])) {
					$username = mysqli_escape_string($conn,$_POST['username']);
					$password = mysqli_escape_string($conn,$_POST['password']);

					$password = md5($password);
					$query=$conn->query("SELECT * FROM admin WHERE username='$_POST[username]' AND password='$password'");
					$result=$query->num_rows;
					if ($result==1) {
						session_start();
						$_SESSION['admin']=$query->fetch_assoc();
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