<?php 
	include 'koneksi.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>Register FastFood.net</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="asset/login/vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="asset/login/css/util.css">
	<link rel="stylesheet" type="text/css" href="asset/login/css/main.css">
</head>

<body>
	<!--INFO DAFTAR AKUN-->
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form class="login100-form validate-form" method="POST">
					<span class="login100-form-title p-b-26">
					FastFood.net : <br>Create Account
					</span>
					<!--INPUT NAMA PELANGGAN-->
					<div class="wrap-input100 validate-input" data-validate="Enter Name">
						<input class="input100" type="text" name="nama">
						<span class="focus-input100" data-placeholder="Insert Your Name"></span>
					</div>
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
					<!--INPUT NO TELP PELANGGAN-->
					<div class="wrap-input100 validate-input" data-validate="Enter Phone Number">
						<input class="input100" type="tel" name="phone">
						<span class="focus-input100" data-placeholder="Insert Your Phone Number"></span>
					</div>
					<!--INPUT ALAMAT PELANGGAN-->
					<div class="wrap-input100 validate-input" data-validate="Enter Address">
						<input class="input100" type="text" name="alamat">
						<span class="focus-input100" data-placeholder="Insert Your Address"></span>
					</div>
					<!--TMBL DAFTAR-->
					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn" name="submit">
								Sign Up
							</button>
						</div>
					</div>
				</form>

				<div class="text-center p-t-115">
						<span class="txt1">
							Sudah punya akun?
						</span>
						<a class="txt2" href="login.php">
							Sign In
						</a>
				</div>

				<?php 
				if (isset($_POST['submit'])) {
					$nama = mysqli_escape_string($conn,$_POST['nama']);
					$email = mysqli_escape_string($conn,$_POST['email']);
					$password = mysqli_escape_string($conn,$_POST['password']);
					$phone = mysqli_escape_string($conn,$_POST['phone']);
					$alamat = mysqli_escape_string($conn,$_POST['alamat']);

					$password = md5($password);
					$validasi=$conn->query("SELECT * FROM pelanggan WHERE email_pelanggan='$email'");
					$q_validasi=$validasi->fetch_assoc();
					if ($nama == '' || $email == '' || $password == '' || $phone == '' || $alamat == '') {
						echo "<script>alert('Harap isi semua data');</script>";
					}
					else if ($q_validasi==TRUE) {
						echo "<script>alert('Email telah terdaftar');</script>";
					}
					else if ($q_validasi != TRUE){
						$query=$conn->query("INSERT INTO pelanggan(email_pelanggan,password_pelanggan,nama_pelanggan,telepon_pelanggan,alamat_pelanggan) VALUES('$email','$password','$nama','$phone','$alamat')");
						if ($query) {
							echo "<br>";
							echo "<div class='alert alert-info'>Sign Up Succeeded</div>";
							echo "<meta http-equiv='refresh' content='1;url=index.php'>";
							// echo "<script>alert('Registrasi Sukses');</script>";
							// header("refresh: 0.1, url=login.php");
						}
						else{
							// echo "<script>alert('Registrasi Gagal');</script>";
							// header("refresh: 0.1, url=login.php");
							echo "<br>";
							echo "<div class='alert alert-danger'>Sign Up Failed</div>";
							echo "<meta http-equiv='refresh' content='1;url=login.php'>";
						}
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