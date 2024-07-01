<?php 
session_start();
include 'protect.php';
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
    <link href="asset/css/font-awesome.css" rel="stylesheet"><!--buttonsearchhapus-->
    <link href="asset/css/bootstrap.min.css" rel="stylesheet"><!--contcss-->
    <link href="asset/css/animate.min.css" rel="stylesheet"><!--droppofile hapus--> 
    <link href="asset/css/style.default.css" rel="stylesheet" id="theme-stylesheet"><!--contcss--> 
</head>

<body>
    <!--BAR ATAS / PROFILE / LOGOUT-->
 <div id="top">
    <div class="container">
        <div class="col-md-6" data-animate="fadeInDown">
            <ul class="menu">
                <li><a href="profile.php">Welcome, <?php echo $_SESSION['login']['nama_pelanggan']; ?></a>
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
               
                    <a class="btn btn-default navbar-toggle" href="cart.php">
                        <i class="fa fa-shopping-cart"></i>  <span class="hidden-xs">Keranjang Belanja</span>
                    </a>
                </div>
            </div>

            <div class="navbar-collapse collapse" id="navigation">

                <ul class="nav navbar-nav navbar-left">
                    <li><a href="index.php">Home</a>
                    </li>
                    <li> <a href="all-menu.php">Menu</a>
                    </li>
                    <li  class="active"> <a href="contact.php">Hubungi kami</a>
                    </li>
                </ul>

            </div>

            <!--TMBL KERANJANG-->
            <div class="navbar-buttons">
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
    </div>

<!--MENU UTAMA-->
    <div id="all">
        <div id="content">
            <div class="container">

                <div class="col-md-13">
                    <div class="box" id="contact">
                        <h1>Hubungi Kami</h1>
                        <p class="lead">Untuk keluhan dan saran silahkan hubungi kami melalui kontak berikut :</p>
                        <hr>
                        <div class="row">
                            <div class="col-sm-4">
                                <h3><i class="fa fa-map-marker"></i> Alamat</h3>
                                <p>Salatiga
                                    <br>Jalan kemiri raya
                                </p>
                            </div>
                            <div class="col-sm-4">
                                <h3><i class="fa fa-phone"></i> Call center</h3>
                                <p class="text-muted">Untuk fast respon silahkan hubungi nomer berikut. </p>
                                <p><strong>0812223334</strong>
                                </p>
                            </div>
                            <div class="col-sm-4">
                                <h3><i class="fa fa-envelope"></i> Email</h3>
                                <p class="text-muted">Gunakan email untuk memberikan saran dan apabila ada keluhan.</p>
                                <ul>
                                    <li><strong><a href="mailto:">cs@gmail.com</a></strong>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>

<div class="footer">
		<center><p>&copy; Tugas Rancang Pemrograman Web 2023.</p></center>
</div>
    
</body>
</html>
