<?php 
    session_start();
    include '../koneksi.php';
    include 'protect.php';
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>FastFood.net : Admin</title>
	
    <link href="assets/css/index.css" rel="stylesheet" />
    <link href="assets/css/custom.css" rel="stylesheet" />
</head>

<body>
    <!--BAR ATAS-->
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <a class="navbar-brand" >FastFood.net Admin</a> 
            </div>
            <div style="color: white;padding: 15px 50px 5px 50px;float: right;font-size: 16px;">
                <a href="index.php?halaman=logout" class="btn btn-danger square-btn-adjust">Logout</a> 
            </div>
        </nav>   

        <!--OPSI MENU BAR-->
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
				<li class="text-center"></li>
                    <li><a href="index.php"><i class="fa fa-home fa-3x"></i> Home</a></li>
                    <li><a href="index.php?halaman=produk"><i class="fa fa-gift fa-3x"></i> Produk</a></li>
                    <li><a href="index.php?halaman=pembelian"><i class="fa fa-reorder fa-3x"></i> Pembelian</a></li>
                    <li><a href="index.php?halaman=pelanggan"><i class="fa fa-users fa-3x"></i> Pelanggan</a></li> 
                </ul>
            </div>
        </nav>  

        <div id="page-wrapper" >
            <div id="page-inner">
                <?php 
                if (isset($_GET['halaman'])) {
                    if ($_GET['halaman']=="produk") {
                        include 'produk.php';
                    }
                    elseif ($_GET['halaman']=="pembelian") {
                        include 'pembelian.php';
                    }
                    elseif($_GET['halaman']=="pelanggan"){
                        include 'pelanggan.php';
                    }
                    elseif ($_GET['halaman']=="hapuspelanggan") {
                        include 'hapuspelanggan.php';
                    }
                    elseif ($_GET['halaman']=="detail") {
                        include 'detail.php';
                    }
                    elseif($_GET['halaman']=="tambahproduk"){
                        include 'tambahproduk.php';
                    }
                    elseif($_GET['halaman']=="hapusproduk"){
                        include 'hapusproduk.php';
                    }
                    elseif ($_GET['halaman']=="ubahproduk") {
                        include 'ubahproduk.php';
                    }
                    elseif ($_GET['halaman']=="warung") {
                        include 'warung.php';
                    }
                    elseif ($_GET['halaman']=="tambahwarung") {
                        include 'tambahwarung.php';
                    }
                    else if ($_GET['halaman']=="ubahwarung") {
                        include 'ubahwarung.php';
                    }
                    elseif($_GET['halaman']=="logout"){
                        include 'logout.php';
                    }
                }   
                else{
                    include 'home.php';
                }
                ?>
            </div>
  
            </div>
    
        </div>
</body>
<div class="footer">
	<center><p>&copy; Tugas Rancang Pemrograman Web 2023.</p></center>
</div>
</html>
