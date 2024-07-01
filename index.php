<?php
    session_start();    
    include 'koneksi.php';
    include 'protect.php';
    error_reporting(0);
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
    <link href="asset/css/owl.carousel.css" rel="stylesheet">
    <!--TEMA STYLE-->
    <link href="asset/css/style.default.css" rel="stylesheet" id="theme-stylesheet">   
</head>

<body>

    <!--BAR ATAS / PROFILE / LOGOUT-->
 <div id="top">
    <div class="container">
        <div class="col-md-6" data-animate="fadeInDown">
            <ul class="menu">
                <li><a href="profile.php">Welcome, <?php echo $_SESSION['login']['nama_pelanggan']; ?></a></li>
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
                    <li class="active"><a href="index.php">Home</a>
                    </li>
                    <li> <a href="all-menu.php">Menu</a>
                    </li>
                    <li> <a href="contact.php">Hubungi kami</a>
                    </li>
                </ul>
            </div>
<!--TMBL KERANJANG-->
            <div class="navbar-buttons">
                <?php                     
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
    <!--TMPL FOTO PRODUK-->
    <div id="content">
        <div class="container">
            <div class="col-md-12">
                <div id="main-slider">
                    <?php 
                    $q_slider=$conn->query("SELECT * FROM produk ORDER BY RAND() LIMIT 5");
                    while ($slider=$q_slider->fetch_assoc()) {
                        ?>
                        <div class="item">
                            <center><img src="foto_produk/<?php echo $slider['foto_produk']; ?>" style="height:472px;width:354px;" class="img-responsive"></center>
                        </div>
                        <?php
                    }
                    ?>  
                </div>
            </div>
        </div>

<!--TMPL MENU FAV-->
<div id="hot">

    <div class="box">
        <div class="container">
            <div class="col-md-12">
                <h2>Menu Favorit</h2>
            </div>
        </div>
    </div>
<!--AMBL MENU FAV-->
    <div class="container">
        <div class="product-slider">
            <?php  
            $query=$conn->query("SELECT*FROM produk ORDER BY likes DESC");
            while ($data=$query->fetch_assoc()) {
                ?>
                <div class="item">
                    <div class="product">
                        <div class="flip-container">
                            <div class="flipper">
                                <div class="front">
                                    <a href="detail_produk.php?id=<?php echo $data['id_produk']; ?>">
                                        <img src="foto_produk/<?php echo $data['foto_produk'];?>" alt="" class="img-responsive">
                                    </a>
                                </div>
                                <div class="back">
                                    <a href="detail_produk.php?id=<?php echo $data['id_produk']; ?>">
                                        <img src="foto_produk/<?php echo $data['foto_produk'];?>" alt="" class="img-responsive">
                                    </a>
                                </div>
                            </div>
                        </div>
                        <a href="detail_produk.php?id=<?php echo $data['id_produk']; ?>" class="invisible">
                            <img src="foto_produk/<?php echo $data['foto_produk'];?>" alt="" class="img-responsive">
                        </a>
                        <div class="text">
                            <h3><a href="detail_produk.php?id=<?php echo $data['id_produk']; ?>"><?php echo $data['nama_produk']; ?></a></h3>
                            <p class="price">Rp.<?php echo number_format($data['harga_produk']); ?></p>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </div>

</div>
</div>
</div>

 <script src="asset/js/jquery-1.11.0.min.js"></script>
 <script src="asset/js/jquery.cookie.js"></script>
 <script src="asset/js/waypoints.min.js"></script>
 <script src="asset/js/owl.carousel.min.js"></script>
 <script src="asset/js/front.js"></script>

<div class="footer">
	<center><p>&copy; Tugas Rancang Pemrograman Web 2023.</p></center>
</div>

</body>
</html>