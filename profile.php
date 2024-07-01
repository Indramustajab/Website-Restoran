<?php
session_start();
include 'protect.php';
include 'koneksi.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="robots" content="all,follow">
    <meta name="googlebot" content="index,follow,snippet,archive">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="">
    <title>FastFood.net</title>
    <meta name="keywords" content="">
    <!--STYLE-->
    <link href="asset/css/bootstrap.min.css" rel="stylesheet">
    <link href="asset/css/animate.min.css" rel="stylesheet">
    <!--TEMA STYLE-->
    <link href="asset/css/style.default.css" rel="stylesheet" id="theme-stylesheet">
</head>
<body>
        <!--BAR ATAS / PROFILE / LOGOUT-->
            <div id="top">
                <div class="container">
                    <div class="col-md-6" data-animate="fadeInDown">
                        <ul class="menu">
                            <li><a>Welcome, <?php echo $_SESSION['login']['nama_pelanggan']; ?></a>
                            </li>
                            <li><a href="logout.php">Logout</a></li>
                        </ul>
                    </div>
                </div>
            </div>
    <!--NAVIGASI MENU-->
        <div class="navbar navbar-default yamm" role="navigation" id="navbar">
            <div class="container">
                <div class="navbar-header">
                    <div class="navbar-buttons"> 
                    </div>
                </div>
                <div class="navbar-collapse collapse" id="navigation">
                    <ul class="nav navbar-nav navbar-left">
                        <li><a href="index.php">Home</a>
                        </li>
                        <li> <a href="all-menu.php">Menu</a>
                        </li>
                        <li> <a href="warung.php">Cabang</a>
                        </li>
                        <li> <a href="contact.php">Hubungi kami</a>
                        </li>
                    </ul>
                </div>
<!--TMBL KERANJANG-->
                <?php
                error_reporting(0);                     
                    if (!$_SESSION['keranjang']) {
                    ?>
                        <div class="navbar-collapse collapse right" id="basket-overview">
                            <a href="cart.php" class="btn btn-primary navbar-btn"><i class="fa fa-shopping-cart"></i><span class="hidden-sm">Keranjang Belanja</span></a>
                        </div>
                    <?php        
                    }
                    else{
                    $item = count($_SESSION['keranjang']);
                    ?>
                        <div class="navbar-collapse collapse right" id="basket-overview">
                            <a href="cart.php" class="btn btn-primary navbar-btn"><i class="fa fa-shopping-cart"></i><span class="hidden-sm">Keranjang Belanja (<?php echo $item;?>)</span></a>
                        </div>
                    <?php
                    }
                ?>
            </div>
        </div>
<!--MENU UTAMA-->
            <div id="content">
                <div class="container">
                    <div class="col-md-3">
                        <div class="panel panel-default sidebar-menu">
                            <?php
                            $id_pelanggan=$_SESSION['login']['id_pelanggan'];
                            $query = $conn->query("SELECT * FROM pelanggan WHERE id_pelanggan ='$id_pelanggan'");
                            $data = $query -> fetch_assoc();
                            ?>
                            <div class="panel-heading" style="padding: 15px;">
                                <center><h3 class="panel-title"><i class="fa fa-user"></i> Profile User</h3></center>
                            </div>
                            <div class="panel-body" align="center" style="min-height: 345px; max-height: 345px;">
                                <img src="foto_profil/<?php echo $data[''];?>" onerror="this.src='foto_profil/default.png';" align="center" class="img-circle" width="100%" style="min-height: 235px; max-height: 235px;">
                                <p style="font-size: 20px";><br><i><b><?php echo $data['nama_pelanggan']; ?></b></i></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="panel panel-default">
                            <div class="panel-heading" style="padding: 21px;">
                                <center><h3 class="panel-title">Data User</h3></center>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table tab-content">
                                        <thead>
                                            <tr>
                                                <td style="padding: 20px"><b>Nama</b></td>
                                                <td style="padding: 20px"><?php echo $data['nama_pelanggan']; ?></td>
                                            </tr>
                                            <tr>
                                                <td style="padding: 20px"><b>Email</b></td>
                                                <td style="padding: 20px"><?php echo $data['email_pelanggan']; ?></td>
                                            </tr>
                                            <tr>
                                                <td style="padding: 20px"><b>No. Telp</b></td>
                                                <td style="padding: 20px"><?php echo $data['telepon_pelanggan']; ?></td>
                                            </tr>
                                            <tr>
                                                <td style="padding: 18px"><b>Alamat</b></td>
                                                <td style="padding: 18px"><?php echo $data['alamat_pelanggan']; ?></td>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                                <br>
                                <!--TMBL EDIT-->
                                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#exampleModalLong">Edit Profile</button>

                                <!--EDIT PROFILE-->
                                <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Edit Your Profile</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="POST" enctype="multipart/form-data">
                                                    <div class="form-group">
                                                        <label>Nama</label>
                                                        <input type="text" class="form-control" name="nama" value="<?php echo $data['nama_pelanggan']; ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Email</label>
                                                        <input type="email" class="form-control" name="email" value="<?php echo $data['email_pelanggan']; ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>No. Telp</label>
                                                        <input type="tel" class="form-control" name="telepon" value="<?php echo $data['telepon_pelanggan']; ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Alamat</label>
                                                        <input type="text" class="form-control" name="alamat" value="<?php echo $data['alamat_pelanggan']; ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <!-- <label>Foto Profil &nbsp</label> -->
                                                        <img src="foto_profil/<?php echo $data['foto_profil'];?>" onerror="this.src='foto_profil/default.png';" width="100">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Ubah Foto Profil</label>
                                                        <input type="file" name="foto" class="form-control">
                                                    </div>
                                                    <button class="btn btn-warning" name="ubah">Ubah</button>
                                                    <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
                                                </form>   
                                                <?php 
                                                if (isset($_POST['ubah'])) {
                                                    $namafoto=$_FILES['foto']['name'];
                                                    $imgtype = explode('.', $namafoto);
                                                    $ext_foto = strtolower(end($imgtype));
                                                    $file_size = $_FILES['foto']['size']; 
                                                    $lokasifoto = $_FILES['foto']['tmp_name'];
                                                    if (!empty($lokasifoto)) {
                                                        if ($ext_foto == "jpg" || $ext_foto == "jpeg" || $ext_foto == "png") {
                                                            if($_FILES['foto']['size'] < 5000000){
                                                                $name_fix = $id_pelanggan.".".$ext_foto;
                                                                unlink("foto_profil/$name_fix");
                                                                move_uploaded_file($lokasifoto, "foto_profil/$namafoto");
                                                                $nama_folder= "foto_profil/";
                                                                $lampiran= $nama_folder . basename($namafoto);
                                                                rename($lampiran, $nama_folder.$id_pelanggan.".".$ext_foto);

                                                                $result1 = $conn->query("UPDATE pelanggan SET email_pelanggan='$_POST[email]',nama_pelanggan='$_POST[nama]',telepon_pelanggan='$_POST[telepon]',alamat_pelanggan='$_POST[alamat]',foto_profil='$name_fix' WHERE id_pelanggan='$id_pelanggan'");
                                                                if ($result1 == true) {
                                                                    echo "<script>alert('Ubah Profil Berhasil');</script>";
                                                                    echo "<script>location='profile.php';</script>";   
                                                                }else{
                                                                    echo "<script>alert('Ubah Profil Gagal');</script>";
                                                                    echo "<script>location='profile.php';</script>";
                                                                } 
                                                            }else{
                                                                echo "<script>alert('Ukuran foto terlalu besar');</script>";
                                                            }     
                                                        }else{
                                                            echo "<script>alert('Masukkan tipe file foto');</script>";
                                                        }
                                                    }else{
                                                        $result2 = $conn->query("UPDATE pelanggan SET email_pelanggan='$_POST[email]',nama_pelanggan='$_POST[nama]',telepon_pelanggan='$_POST[telepon]',alamat_pelanggan='$_POST[alamat]' WHERE id_pelanggan='$id_pelanggan'");
                                                        if ($result2 == true) {
                                                            echo "<script>alert('Ubah Profil Berhasil');</script>";
                                                            echo "<script>location='profile.php';</script>";                                
                                                        }
                                                    }
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
<!--TMBL UBAH PASS-->
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#changepassword">Change Password</button>
                                <!--MENU UBAH PASS-->
                                <div class="modal fade" id="changepassword" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Change Password</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="POST" enctype="multipart/form-data">
                                                    <div class="form-group">
                                                        <label>Insert New Password</label>
                                                        <input type="password" class="form-control" name="password">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Insert New Password Again</label>
                                                        <input type="password" class="form-control" name="password1">
                                                    </div>
                                                    <button class="btn btn-danger" name="change">Change</button>
                                                </form>
                    <?php 
                    if (isset($_POST['change'])) {
                        $password = mysqli_escape_string($conn,$_POST['password']);
                        $password1 = mysqli_escape_string($conn,$_POST['password1']);
                        if ($password == $password1) {
                            $password = md5($password);
                            $result_change = $conn->query("UPDATE pelanggan SET password_pelanggan = '$password' WHERE id_pelanggan = '$id_pelanggan'");
                            if ($result_change) {
                                echo "<script>alert('Berhasil mengganti password');</script>";
                                echo "<script>location='profile.php';</script>";
                            }
                            else{
                                echo "<script>alert('Gagal mengganti password');</script>";
                                echo "<script>location='profile.php';</script>";
                            }
                        }else{
                            echo "<script>alert('Password tidak sama');</script>";
                            echo "<script>location='profile.php';</script>";
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>>
</div>
</div>

    <script src="asset/js/jquery-1.11.0.min.js"></script>
    <script src="asset/js/bootstrap.min.js"></script>

<div class="footer">
	<center><p>&copy; Tugas Rancang Pemrograman Web 2023.</p></center>
</div>

</body>
</html>