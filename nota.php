<?php 
session_start();
include 'protect.php';
include 'koneksi.php';
$id=$_GET['id'];
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
    <link href="asset/css/font-awesome.css" rel="stylesheet">
    <!--PROFILE-->
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
<!--MENU UTAMA-->
    <div id="all">
        <div id="content">
            <div class="container">
                <a href="prosescetak.php?id=<?php echo $id;?>" class="btn btn-success pull-right" style="color: #fff; text-decoration: none; margin-right: 5px; margin-top: 10px;">Cetak Nota</a>
                    <a href="all-menu.php" class="btn btn-warning pull-right" style="color: #fff; text-decoration: none; margin-right: 15px; margin-top: 10px;">Belanja lagi</a>
                <div class="col-md-13" style="margin-top: 5px;" id="nota">
                    <div class="box" id="contact">
                        <h1>Nota Pembelian #<?php echo $_GET['id']; ?></h1>
                        <p class="lead">Berikut nota pembelian anda :</p>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Menu</th>
                                        <th>Info Cabang</th>
                                        <th>Harga</th>
                                        <th>Jumlah</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $no=1;
                                        $total=0;
                                    ?>
                                    <?php $query=$conn->query("SELECT * FROM pembelian_produk JOIN produk 
                                        ON pembelian_produk.id_produk=produk.id_produk JOIN warung ON produk.id_warung=warung.id_warung
                                        WHERE pembelian_produk.id_pembelian='$_GET[id]'"); ?>
                                    <?php while ( $data=$query->fetch_assoc()) {
                                        $subharga=$data['harga_produk']*$data['jumlah'];
                                        ?>            
                                        <tr>
                                            <td><?php echo $no++; ?></td>
                                            <td><?php echo $data['nama_produk']; ?></td>
                                            <td><?php echo $data['nama_warung']; ?> (<?php echo $data['telepon_warung']; ?>)</td>
                                            <td>Rp.<?php echo number_format($data['harga_produk']); ?></td>
                                            <td><?php echo $data['jumlah'] ?></td>
                                            <td>Rp.<?php echo number_format($data['harga_produk']*$data['jumlah']); ?></td>
                                        </tr>
                                        <?php
                                    } ?>
                                </tbody>
                                <tfoot>
                                    <?php 
                                        $query2=$conn->query("SELECT * FROM pembelian WHERE id_pembelian=$_GET[id]");
                                        $data2=$query2->fetch_assoc();
                                    ?>
                                    <tr>
                                        <th colspan="5" class="text-right">Total Pembelian</th>
                                        <th>Rp.<?php echo number_format($data2['jumlah_pembelian']); ?></th>
                                    </tr>
                                    <tr>
                                        <th colspan="5" class="text-right">Ongkos Kirim</th>
                                        <th>Rp.<?php echo number_format($data2['ongkir']); ?></th>
                                    </tr>
                                    <tr>
                                        <th colspan="5" class="text-right"><b>Total</b></th>
                                        <th><b>Rp.<?php echo number_format($data2['total_pembelian']); ?></b></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <h3><i class="fa fa-file"></i> Data Pembelian</h3>
                                <p><b>No.Pembelian : <?php echo $data2['id_pembelian']; ?></b>
                                    <br>Tanggal : <?php echo $data2['tanggal_pembelian']; ?>
                                    <br>Total : Rp.<?php echo number_format($data2['total_pembelian']); ?>
                                </p>
                            </div>
                            <div class="col-sm-4">
                                <h3><i class="fa fa-user"></i> Pelanggan</h3>
                                <p><strong><?php echo $_SESSION['login']['nama_pelanggan']; ?></strong><br>
                                    <?php echo $_SESSION['login']['telepon_pelanggan']; ?><br>
                                    <?php echo $_SESSION['login']['email_pelanggan']; ?>
                                </p>
                            </div>
                            <!--TAGIHAN-->
                            <div class="col-sm-4">
                                <h3><i class="fa fa-road"></i> Pengiriman</h3>
                                <p><b> <?php echo $_SESSION['login']['alamat_pelanggan']; ?></b>
                                    <br>Ongkos Kirim : Rp.<?php echo $data2['ongkir']; ?>
                                </p>
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
