<!--STRUK PEMBELIAN-->
<?php
    session_start();  
    include 'protect.php';
    include 'koneksi.php';
    if (!$_SESSION['keranjang']) {
        header("location: cart.php");
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
    <link href="asset/css/bootstrap.min.css" rel="stylesheet">
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
    </div>
<!--MENU UTAMA-->
    <div id="all">
        <div id="content">
            <div class="container">
                <div class="col-md-3">
                </div>
<!--TMPL DETAIL BELI-->
                <div class="col-md-13" id="customer-order">
                    <div class="box">
                        <h1>Detail Pembelian : </h1>

                        <p class="lead">Berikut rincian pembelian anda  </p>

                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Menu</th>
                                        <th>Nama Produk</th>
                                        <th>Jumlah</th>
                                        <th>Harga Satuan</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $total = 0; 
                                    ?>
                                   <?php foreach ($_SESSION["keranjang"] as $id_produk => $jumlah): ?>
                                    <?php 
                                        $query = $conn->query("SELECT * FROM produk 
                                            WHERE id_produk='$id_produk'");
                                        $data=$query->fetch_assoc();
                                        $subharga=$data['harga_produk']*$jumlah;
                                        $total = $total+$subharga;
                                        $total_jumlah=count($_SESSION['keranjang']);
                                        $ongkir=1000*$total_jumlah;
                                        $bayar=$total+$ongkir;                                        
                                    ?>
                                    <tr>
                                        <td>
                                            <a href="detail_produk.php?id=<?php echo $data['id_produk']; ?>">
                                                <img src="foto_produk/<?php echo $data['foto_produk'];?>" alt="">
                                            </a>
                                        </td>
                                        <td><a href="foto_produk/<?php echo $data['foto_produk'];?>"><?php echo $data['nama_produk']; ?></a></td>
                                        
                                        <td><?php echo $jumlah;?></td>
                                        <td>Rp.<?php echo number_format($data['harga_produk']); ?></td>
                                        <td>Rp.<?php echo number_format($subharga); ?></td>
                                    </tr>
                                    <?php endforeach ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="5" class="text-right">Total Pembelian</th>
                                        <th>Rp.<?php echo number_format($total); ?></th>
                                    </tr>
                                    <tr>
                                        <th colspan="5" class="text-right">Ongkos Kirim</th>
                                        <th>Rp.<?php echo $ongkir; ?></th>
                                    </tr>
                                    <tr>
                                        <th colspan="5" class="text-right"><b>Total</b></th>
                                        <th><b>Rp.<?php echo number_format($bayar); ?></b></th>
                                    </tr>
                                </tfoot>
                            </table>

                        </div>
<!--TMBL BELI-->
                        <div class="row">
                        </div>
                        <form method="POST">
                            <div class="box-footer">
                                <div class="pull-right">
                                    <button type="submit" class="btn btn-primary" name="submit">Beli<i class="fa fa-chevron-right"></i></button>
                                </div>
                            </div>
                        </form>
                        <?php 
                            if (isset($_POST['submit'])) {
                                $id_pelanggan = $_SESSION['login']['id_pelanggan'];
                                $tanggal_pembelian = date('Y-m-d');
                                //Simpan data pembelian ke tabel pembelian
                                $conn->query("INSERT INTO pembelian VALUES ('','$tanggal_pembelian','$total','$ongkir','$bayar','$id_pelanggan')");

                                //get id_pembelian barusan
                                $id_pembelian_barusan = $conn->insert_id;
                                $stok=$data['stok'];

                                foreach ($_SESSION['keranjang'] as $id_produk => $jumlah) {
                                    $stok_update = $stok-$jumlah;
                                    $conn->query("INSERT INTO pembelian_produk VALUES ('','$jumlah','$id_pembelian_barusan','$id_produk')");
                                    $conn->query("UPDATE produk SET stok='$stok_update' WHERE id_produk=$id_produk");
                                }

                                unset($_SESSION['keranjang']);

                                echo "<script>alert('Pembelian Sukses')</script>";
                                echo "<script>location='nota.php?id=$id_pembelian_barusan'</script>";

                            }
                        ?>
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
