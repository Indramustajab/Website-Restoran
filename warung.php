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
    <!--TEMA STYLE-->
    <link href="asset/css/style.default.css" rel="stylesheet" id="theme-stylesheet">
</head>

<body>
    <!--BAR ATAS / PROFILE / LOGOUT-->
    <div id="top">
        <div class="container">
            <div class="col-md-6" data-animate="fadeInDown">
                <ul class="menu">
                    <li><a href="profile.php">Welcome, <?php echo $_SESSION['login']['nama_pelanggan']; ?></a>
                    </li>
                    <li><a href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!--NAVIGASI MENU-->
    <div class="navbar navbar-default yamm" role="navigation" id="navbar">
        <div class="container">
            <div class="navbar-collapse collapse" id="navigation">
                <ul class="nav navbar-nav navbar-left">
                    <li><a href="index.php">Home</a>
                    </li>
                    <li> <a href="all-menu.php">Menu</a>
                    </li>
                    <li> <a href="contact.php">Tentang kami</a>
                    </li>
                </ul>
            </div>
            <!--TOMBOL KERANJANG-->
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
                <div class="col-md-3">
                    <div class="panel panel-default sidebar-menu">
                        <!--MENAMPILKAN DAFTAR WARUNG-->
                        <div class="panel-heading">
                            <h3 class="panel-title">Cabang FastFood.net</h3>
                        </div>
                        <div class="panel-body">
                            <ul class="nav nav-pills nav-stacked category-menu">
                                <?php 
                                $query=$conn->query("SELECT * FROM warung");
                                while ($data=$query->fetch_assoc()) {
                                    ?>
                                <li>
                                    <a href="warung.php?id=<?php echo $data['id_warung']; ?>"><?php echo $data['nama_warung']; ?></a>
                                </li>
                                    <?php
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <!--TAMPIL WARUNG YG DIPILIH-->
                <div class="col-md-9">
                    <!--TAMPIL NAMA WARUNG-->
                    <div class="box">
                        <h2>Cabang FastFood.net Pilihan :</h2>
                        <?php 
                        $id_warung=$_GET['id'];
                        $query2=$conn->query("SELECT * FROM warung WHERE id_warung=$id_warung");
                        $data2=$query2->fetch_assoc();
                        ?>
                        <h1><?php echo $data2['nama_warung']; ?></h1>
                        <p><?php echo $data2['alamat_warung']; ?> <br>
                            <?php echo $data2['telepon_warung']; ?></p>
                    </div>
                    <!--MENU WARUNG YG DIPILIH-->
                    <div class="row products">
                        <?php
                        $id_warung=$_GET['id'];  
                        $query3=$conn->query("SELECT * FROM produk WHERE id_warung=$id_warung");
                        while ($data3=$query3->fetch_assoc()) {
                            ?>
                            <div class="col-md-4 col-sm-6">
                                <div class="product">
                                    <div class="flip-container">
                                        <div class="flipper">
                                            <div class="front">
                                                <a href="detail_produk.php?id=<?php echo $data3['id_produk']; ?>">
                                                    <img src="foto_produk/<?php echo $data3['foto_produk']; ?>" alt="" class="img-responsive">
                                                </a>
                                            </div>
                                            <div class="back">
                                                <a href="detail_produk.php?id=<?php echo $data3['id_produk']; ?>">
                                                    <img src="foto_produk/<?php echo $data3['foto_produk']; ?>" alt="" class="img-responsive">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="detail_produk.php?id=<?php echo $data3['id_produk']; ?>" class="invisible">
                                        <img src="foto_produk/<?php echo $data3['foto_produk']; ?>" alt="" class="img-responsive">
                                    </a>
                                    <div class="text">
                                        <h3><a href="detail_produk.php?id=<?php echo $data3['id_produk']; ?>"><?php echo $data3['nama_produk']; ?></a></h3>
                                        <p class="price">Stok : <?php echo $data3['stok']; ?></p>
                                        <p class="price">Rp.<?php echo number_format($data3['harga_produk']); ?></p>
                                        <p class="buttons">
                                            <a href="detail_produk.php?id=<?php echo $data3['id_produk']; ?>" class="btn btn-default">Detail</a>
                                            <a href="buy.php?id=<?php echo $data3['id_produk']; ?>" class="btn btn-primary"><i class="fa fa-shopping-cart"></i>Masukkan keranjang</a>
                                        </p>
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

<div>
	<center><p>&copy; Tugas Rancang Pemrograman Web 2023.</p></center>
</div>    
</body>
</html>