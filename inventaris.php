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
			
		<div class="splash-images1 parallax">
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
					<!-- <div id="banner"> -->
            	<div align="center">            		
            		<img src="images/panduan.jpg" width="1000" height="700" /> <br><br><br>           
                </div>
          	<!-- </div>  --> 
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