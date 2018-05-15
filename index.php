<?php
	session_start();
	require("config/config.php");
?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>SYSIN TE-UM</title>
		<link rel="shortcut icon" href="images/icon.png" type="image/x-icon" />
		<link rel="stylesheet" type="text/css" href="css/stylesheet.css" />
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
				<li  class="current" ><a href="index.php"> Beranda </a></li>
				<li><a href="pinjam.php">Pencarian</a></li>
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
				<div class="logo">
				</div>
				<div class="logo1">
				</div>
					<div id="navbar">
						<ul>
							<li  class="current" ><a href="index.php"> Beranda </a></li>
							<li><a href="pinjam.php">Pencarian</a></li>
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
			
		<div class="splash-images parallax">
			<div class="container">
				<div class="slider">
	
					<ul class="list-slider">
						<li>
							<div class="text-header one">
							<img src="images/logo.png"/><br/><h1><i class="fa fa-lightbulb-o"></i><strong>    Selamat</strong> Datang di Sistem Informasi Inventarisasi Jurusan Teknik Elektro UM</h1>
							</div>
						</li>
					</ul>
				</div>
			</div>
		</div>
		
	<div class="sparator">
		<div class="container">
			<div class="spar"></div>
				<h3><i class="fa  fa-lightbulb-o"></i> Tentang SYSIN </h3>
			</div>
	</div>
		<div class="about-us">
			<div class="container">
				
				<div class="team-container">
				<div class="team-item animate-block animate from-bottom two">
					<div class="team-content">
						<div class="team-thumbnail" style="background-image:url(images/team1.png);"></div>
							<div class="team-overlay">
								<div class="blockoverlay">
									<div class="box">
							 			<div class="team-name"><h3><a href="inventaris.php">PANDUAN</a></h3></div>
							 			<div class="team-job"><a href="inventaris.php">Data</a></div>
							 			<div class="team-desc">
							 			<p>Panduan Peminjaman Alat dan Barang serta Penggunaan Bahan Habis Pakai</p>
										 </div>
									</div><!--box-->
								</div><!--block overlay-->
							</div><!-- team overlay-->
					</div><!--team content-->
				</div>
	<div class="team-item animate-block animate from-bottom one">
		<div class="team-content">
			<div class="team-thumbnail" style="background-image:url(images/team2.png);"></div>
				<div class="team-overlay">
					<div class="blockoverlay">
						<div class="box">
				 			<div class="team-name"><h3><a href="bantuan.php"><br/>Bantuan</a></h3></div>
				 			<div class="team-job"><a href="bantuan.php">Data</a></div>
				 			<div class="team-desc">
				 			<p>Pusat Bantuan SYSIN TE UM bagi pengguna sistem di Jurusan Teknik Elektro Universitas Negeri Malang </p>
				 			</div>
					 	</div><!--box-->
				 	</div><!--block overlay-->
				</div><!-- team overlay-->
		</div><!--team content-->
	</div>
	<div class="team-item animate-block animate from-bottom three">
		<div class="team-content">
			<div class="team-thumbnail" style="background-image:url(images/team3.png);"></div>
				<div class="team-overlay">
					<div class="blockoverlay">
						<div class="box">
				 			<div class="team-name"><h3><a href="berita.php">Informasi</a></h3></div>
				 			<div class="team-job"><a href="berita.php">Berita</a></div>
				 			<div class="team-desc">
				 			<p>Informasi terkait sistem informasi maupun inventaris di Jurusan Teknik Elektro Universitas Negeri Malang</p>
				 			</div>
						
						</div><!--box-->
					</div><!--block overlay-->
				</div><!-- team overlay-->
		</div><!--team content-->
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
	
	</div>		
	</body>
</html>