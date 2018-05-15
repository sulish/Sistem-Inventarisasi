<?php
	session_start();
	require("config/config.php");
?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>Kontak | SYSIN TE-UM</title>
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

				<li  class="current"><a href="contact.php">Kontak</a></li>
			</ul>
	</div>
	<div class="vbody">
			<div id="header">
					<div class="container">
						<div class="logo">
						
						</div>
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
								<li  class="current"><a href="contact.php">Kontak</a></li>
							</ul>
							<div class="mobile-nav"><i class="fa fa-bars"></i></div>
						</div>
					</div>
					
			</div>
			
			<div class="splash-images2 parallax">
				<div class="container"></div>
			</div>
		
			<div class="sparator">
				<div class="container">
				<div class="spar"></div>
				<h3><i class="fa  fa-lightbulb-o"></i> KONTAK</h3>
				</div>
			</div>
			<div class="contact">
				<div class="container">
				<h1 ><i class="fa fa-coffee"></i>LAKUKAN KONTAK <span style="color:#16D6FF;">DENGAN KAMI</span>.<br/> </h1>
				<br/>
				<h3>Jika ada saran dan kritik atau permasalahan terkait sistem, pengunjung dapat menghubungi administrator</h3><br>

				<div class="contact-form">
				<div class="container">
					<p><strong>Sistem Informasi Inventarisasi Jurusan Teknik Elektro</strong><br><br>
                    Gedung G4 Jurusan Teknik Elektro<br />
                    Jl. Semarang No. 5<br />
                    Malang, Jawa Timur, Indonesia<br /><br />
                    Hubungi kami:<br />
                    Site: mnetmalang.co.id<br />
                    Email: bantuan@sysin.co.id<br />
                    Telp: 0341-<br />
                </div>
            	</div>
        </div>
					

<!-- Footer -->
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