<?php
    session_start(); 
    include 'koneksi.php';
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
    <link href="asset/css/font-awesome.css" rel="stylesheet"><!--buttonsearch-->
    <link href="asset/css/bootstrap.min.css" rel="stylesheet"><!--allmenu-->
    <link href="asset/css/animate.min.css" rel="stylesheet"><!--droppofile-->
    <!--TEMA STYLE-->
    <link href="asset/css/style.default.css" rel="stylesheet" id="theme-stylesheet"><!--allmenu-->

    <script src="asset/js/jquery-1.11.0.min.js"></script><!--searching-->
    <script type="text/javascript">
        $(document).ready(function() {
        //$("#search_results").slideUp();
        $("#button_find").click(function(event) {
            event.preventDefault();
            //search_ajax_way();
            ajax_search();
        });
        $("#search_query").keyup(function(event) {
            event.preventDefault();
            //search_ajax_way();
            ajax_search();
        });
    });
        function ajax_search() {

            var judul = $("#search_query").val();
            $.ajax({
                url : "search.php",
                data : "judul=" + judul,
                success : function(data) {
                // data sukses diambil dari server, tampilkan di <select id=kota>
                $("#display_results").html(data);
            }
        });

        }
    </script>
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
                    <li class="active"> <a href="all-menu.php">Menu</a>
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
                <div id="display_results">
                </div>
            </div>
            <div class="container">
                <div class="col-md-15">
                    <div class="row products">
                        <?php
                        $halaman=4;
                        $page=isset($_GET["halaman"]) ? (int)$_GET["halaman"] : 1;
                        $mulai=($page>1) ? ($page*$halaman) - $halaman : 0;
                        $query=$conn->query("SELECT*FROM produk LIMIT $mulai, $halaman") OR die($conn->error);
                        $sql=$conn->query("SELECT*FROM produk");
                        $total=$sql -> num_rows;
                        $pages=ceil($total/$halaman);    
                        while ($data=$query->fetch_assoc()) {   
                            ?>
                            <div class="col-md-3 col-sm-4">
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
                                        <p class="price">Stok : <?php echo $data['stok']; ?></p>
                                        <p class="price">Rp.<?php echo number_format($data['harga_produk']); ?></p>
                                        <p class="buttons">
                                            <a href="detail_produk.php?id=<?php echo $data['id_produk']; ?>" class="btn btn-default">Detail Menu</a>
                                            <a href="buy.php?id=<?php echo $data['id_produk']; ?>" class="btn btn-primary"><i class="fa fa-shopping-cart"></i>Masukkan keranjang</a>
                                        </p>
                                    </div>
                                 
                                </div>
                    
                            </div>
                            <?php
                        }
                        ?>
                    </div>

                     <!-- Halaman -->
                    <div class="pages">
                        <ul class="pagination">
                            <?php for($i=1; $i<=$pages; $i++){
                                ?>
                                <li><a href="?halaman=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                                <?php
                            } ?>

                        </ul>
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