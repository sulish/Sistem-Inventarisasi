<?php
    session_start();
	require("config/config.php");
?>

<!DOCTYPE HTML>
<html>
    <head>
        <title>Bantuan | SYSIN TE-UM </title>
        <link rel="shortcut icon" href="images/icon.png" type="image/x-icon" />
        <link rel="stylesheet" type="text/css" href="css/stylesheet.css" />
        <link rel="stylesheet" type="text/css" href="css/help.css" />
        <link rel="stylesheet" type="text/css" href="fonts/fontawesome.css" />
        <script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
        <script type="text/javascript" src="js/stellar.js"></script>
        <script type="text/javascript" src="js/carouFredSel.min.js"></script>
        <script type="text/javascript" src="js/jquery-custom.js"></script>
    </head>
    <body>
    <div class="swipe-menu ">
            <img src="images/logo.png"/>
            <ul>
                <li><a href="index.php"> Beranda</a></li>
                <li ><a href="pinjam.php">Pencarian</a></li>
               
                <?php
                    if(isset($_SESSION['username']) && isset($_SESSION['type']) ){ 
                    ?>
                            <li ><a href="logout.php">Keluar</a></li>
                            <li><a href="admin/index.php"><?php echo substr($_SESSION['nama'],0,10)?></a></li>
                    <?php
                        }else{
                    ?>
                            <li ><a href="masuk.php">Masuk</a></li>
                    <?php
                        }
                ?>
                <li><a href="contact.php">Kontak</a></li>
            </ul>
    </div>
    <div class="vbody">
            <div id="header">
            <div class="container">
            <div class="logo"></div>
            <div id="navbar">
                <ul>
                    <li><a href="index.php"> Beranda</a></li>
                    <li ><a href="pinjam.php">Pencarian</a></li>
                    
                    <?php
                            if(isset($_SESSION['username']) && isset($_SESSION['type']) ){ 
                        ?>
                                <li ><a href="logout.php">Keluar</a></li>
                                <li><a href="admin/index.php"><?php echo substr($_SESSION['nama'],0,10)?></a></li>
                        <?php
                            }else{
                        ?>
                                <li ><a href="masuk.php">Masuk</a></li>
                        <?php
                            }
                    ?>
                    <li><a href="contact.php">Kontak</a></li>
                </ul>
            <div class="mobile-nav"><i class="fa fa-bars"></i></div>
            </div>
            </div>
            </div>
            
        <div class="splash-images1 parallax"></div>
        
        <div class="sparator">
            
                <div class="container">
                <div class="spar"></div>
                <h3><i class="fa  fa-lightbulb-o"></i> PUSAT BANTUAN</h3>
                </div>
        </div>
        <div class="container">
            <h1><i class="fa fa-laptop"></i> PUSAT BANTUAN <span style="color:#16D6FF;">SYSIN TE-UM</span>.<br/> </h1>
            <br/>
            <p>Selamat datang di Pusat Bantuan SysLab TE-UM yang berisi panduan menggunakan sistem dan tutorial peminjaman alat dan bahan di Jurusan Teknik Elektro Universitas Negeri Malang</p>
            <div id="content">
	    <div id="content_cen">
		<div id="content_sup">
        	<div id="user_col">
				<h3><span> Pusat</span> Bantuan</h3>
                <h3><span> SYSIN </span> TE UM</h3>
                <div id="pusat"  style="text-align:left">
                	    <p ><a href="#sub_11">Tentang SYSIN TE UM</a></p>
                        <p ><a href="#sub_12">Hak Akses Sistem</a></p>
                    
                  
                </div>
			</div>
            <div id="mid_col">

                    <h5 id="sub_11">Tentang SYSIN TE UM</h5>
                    <p>Selamat datang di pusat bantuan SYSIN TE UM | Sistem Informasi Inventarisasi Jurusan Teknik Elektro FT UM <br /><br />
                    Sistem Informasi Inventarisasi Jurusan Teknik Elektro adalah sebuah aplikasi perangkat lunak berbasis web yang berfungsi untuk managemen inventaris alat dan bahan
                    habis pakai pada JUrusan Teknik Elektro Universitas Negeri Malang. Sistem Informasi ini juga mempunyai layanan peminjaman alat dan penggunaan bahan habis pakai sehingga arsip managemn inventaris lebih terstruktur.
                    Sistem ini dapat diakses menggunakan jaringan intranet Jurusan Teknik Elektro menggunakan browser yang mendukung PHP,HTML5 dan mysql.<br />
                    Menu-menu bantuan di samping adalah menu-menu bantuan sebagai petunjuk umum untuk para pengunjung SYSIN TE UM</p>
                    
                    <h5 id="sub_12">Hak Akses Sistem</h5>
                    <p>Hak Akses Sistem | Sistem Informasi Inventarisasi Jurusan Teknik Elektro FT UM<br /><br />
                    Pengguna SYSIN TE UM adalah semua elemen Jurusan Teknik Elektro meliputi, administrator, dosen , pegawai, laboran dan mahasiswa.
                    Setiap pengguna mempunyai akun default dari administrator berupa username dan password berisi Nomor Induk Mahasiswa (NIM) masing-masing pengguna,
                    atau Nomor Induk Pegawai (NIP) untuk dosen dan nomor ID untuk yang belum mempunyai NIP.
                    Pengguna mendapatkan akun default dari administrator, bagi yang belum mempunyai akun, dapat menghubungi admin untuk didaftarkan sesuai hak akses<br />
                    Hak akses SYSIN TE UM adalah<br><br>
                    User-Mahasiswa, Dosen dan Pegawai<br>
                    <ul style="text-align:left">
                        <li>Login dengan akun yang telah diberikan oleh administrator</li>
                        <li>Melakukan kegiatan peminjaman alat atau barang</li>
                        <li>Melihat informasi data inventaris dan transaksi peminjaman</li>
                        <li>Melakukan pencarian alat atau barang</li>
                        <li>Melola akun user</li>
                    </ul><br><br>
                    User-Laboran<br>
                    <ul style="text-align:left">
                        <li>Login dengan akun yang telah diberikan oleh administrator</li>
                        <li>Melakukan kegiatan peminjaman alat atau barang</li>
                        <li>Melihat informasi data inventaris dan transaksi peminjaman</li>
                        <li>Melakukan pencarian alat atau barang</li>
                        <li>Melola akun user</li>
                        <li>Mengelola data inventaris</li>
                    </ul><br><br>
                    Administrator<br>
                    <ul  style="text-align:left">
                        <li>Login dengan akun yang telah diberikan oleh administrator</li>
                        <li>Melakukan pencarian alat atau barang</li>
                        <li>Melola akun user</li>
                        <li>Kelola ruang</li>
                        <li>Mengelola data inventaris</li>
                        <li>Kelola data user (admin membuatkan akun user dengan password default yaitu NIM atau NIP</li>
                    </ul><br><br>

                </div>				
		  </div>			
		</div>
	</div>
</div>

<div class="footer">
        <div class="texture">
            <div class="container">
                <img src="images/logo.png"/><br/>
                <p>© 2015 <a href="index.php" style="color:yellow">SYSIN TE-UM</a> | <a href="pengembang.php" style="color:yellow">Sulis Setiowati</a> </p>
            </div>  
        </div>  
    </div>
</body>
</html>
