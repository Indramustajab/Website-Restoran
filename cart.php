<?php 
session_start();
error_reporting(0);
include 'koneksi.php';
include 'protect.php';
if (!$_SESSION['keranjang']) {
    echo "<script>alert('Keranjang Kosong! Silahkan belanja dulu')</script>";
    echo "<script>location='all-menu.php'</script>";
}
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
    <link href="asset/css/font-awesome.css" rel="stylesheet"><!--buttonsearchhps-->
    <link href="asset/css/bootstrap.min.css" rel="stylesheet"><!--keranjangcss-->
    <link href="asset/css/animate.min.css" rel="stylesheet"><!--droppofile hapus--> 
    <link href="asset/css/style.default.css" rel="stylesheet" id="theme-stylesheet"><!--keranjangcss--> 
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
    </div>

    <!--MENU UTAMA-->
    <div id="all">
        <div id="content">
            <div class="container">
                <div class="col-md-13" id="basket">
                    <div class="box">
                        <form method="post">
                            <h1>Keranjang belanja</h1>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Menu</th>
                                            <th>Nama</th>
                                            <th>Jumlah</th>
                                            <th>Harga Satuan</th>
                                            <th>Total</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $total=0; ?>
                                        <?php foreach ($_SESSION["keranjang"] as $id_produk => $jumlah): ?>
                                            <?php 
                                            $query = $conn->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
                                            $data=$query->fetch_assoc();
                                            $subharga=$data['harga_produk']*$jumlah;
                                            ?>
                                            <tr>
                                                <td><img src="foto_produk/<?php echo $data['foto_produk']; ?>" alt=""></td>
                                                <td><?php echo $data['nama_produk']; ?></td>
                                                <td><?php echo $jumlah;?></td>
                                                <td>Rp.<?php echo number_format($data['harga_produk']);?></td>
                                                <td>Rp.<?php echo number_format($subharga); ?></td>
                                                <td><a href="hapuskeranjang.php?id=<?php echo $id_produk ?>"><i class="fa fa-trash-o"></i>Hapus</a>
                                                </td>
                                            </tr>
                                            <?php $total+=$subharga; ?>
                                        <?php endforeach ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="4">Total Harga : </th>
                                            <th colspan="2">Rp.<?php echo number_format($total); ?></th>
                                        </tr>
                                    </tfoot>
                                </table>

                            </div>
                            <!--TMBL OPSI-->
                            <div class="box-footer">
                                <div class="pull-left">
                                    <a href="all-menu.php" class="btn btn-default"><i class="fa fa-chevron-left"></i> Belanja lagi</a>
                                </div>
                                <div class="pull-right">
                                    <button type="submit" class="btn btn-primary" name="checkout">Checkout<i class="fa fa-chevron-right"></i>
                                    </button>
                                    <?php 
                                        if (isset($_POST['checkout'])) {
                                            $stok = $data['stok'];
                                            $stokupdate = $stok - $jumlah;
                                            if ($stokupdate < 0) {
                                                echo "<script>alert('Stok tidak memenuhi, periksa kembali jumlah belanjaan anda');</script>";

                                            }
                                            else{
                                                echo "<script>location='result.php';</script>";
                                            }
                                        }
                                    ?>
                                </div>
                            </div>
                        </form>
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