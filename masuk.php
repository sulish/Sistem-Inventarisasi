<?php
session_start();
require ('config/config.php');
?>

<html>
	<head>
		<title> Masuk | SYSIN TE-UM </title>
		<link rel="shortcut icon" href="images/icon.png" type="image/x-icon" />
		<link rel="stylesheet" type="text/css" href="includes/bootstrap/css/bootstrap.min.css" />
		<link rel="stylesheet" type="text/css" href="css/stylesheet.css" />
		<link rel="stylesheet" type="text/css" href="fonts/fontawesome.css" />
		<script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
		<script type="text/javascript" src="js/stellar.js"></script>
		<script type="text/javascript" src="js/carouFredSel.min.js"></script>
		<script type="text/javascript" src="js/jquery-custom.js"></script>
		<script type="text/javascript" src="includes/bootstrap/js/bootstrap.min.js"></script>
</script>
	</head>
	<body>
	<div class="swipe-menu ">
			<img src="images/logo.png"/>
			<ul>
				<li><a href="index.php"> Beranda </a></li>
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
			<div id="navbar" style="margin-top:17px">
				<ul>
					<li><a href="index.php"> Beranda </a></li>
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
			
	<div class="splash-images2 parallax"></div>
		
	<div class="sparator">
	<div class="container">
	<div class="spar"></div>
	<h3><i class="fa  fa-lightbulb-o"></i> MASUK</h3>
	</div>
	</div>
		<div class="clients">
			<div class="container">
			<h1><i class="fa fa-user"></i>  MASUK <span style="color:#16D6FF;">SEKARANG</span>.<br/> </h1>
			<br/>
			</div>
		</div>
	<div class="container">
	<div class="row">  
  	<div class="col-lg-12">
      	<form class="form-horizontal" method="post" action="proses-login.php" style="width:35%; margin:auto">
			  <div class="control-group">	
			    <label class="control-label" for="inputusername">Username</label>
			    <div class="controls">
			    <input type="text" id="inputusername" maxlength="18" required="true" placeholder="Username" name="username" style="height:30px; width:250px">
			    </div>
			  </div>
			  <div class="control-group">
			    <label class="control-label" for="inputPassword">Password</label>
			    <div class="controls">
			    <input type="password" id="inputpassword" required="true" placeholder="Password" name="password" style="height:30px; width:250px">
			    </div>
			  </div>
			  <div class="control-group">
			    <div class="controls">
		            <a href="#" data-toggle="modal" data-target="#myModal"> Lupa Password?</a><br>
			      <button type="submit" name="submit_login" value="masuk" class="btn btn-theme03" style="margin-top:30px; height:30px; width:50%">Masuk</button>
			      <br><br>
			      		Anda Belum Mendaftar?<br/>
		                <a href="#" data-toggle="modal" data-target="#myModal1"> Buat Akun</a>    
			    </div>
			  </div>
		</form>
   	</div>
 	</div>
    </div>
				
<!-- Footer -->
	<div class="footer1">
		<div class="texture">
			<div class="container">
				<br><img src="images/logo.png"/><br/>
				<p>© 2015 <a href="index.php" style="color:yellow">SYSIN TE-UM</a> | <a href="pengembang.php" style="color:yellow">Sulis Setiowati</a> </p>
			</div>	
		</div>	
	</div>
	</div>	

	<!-- Modal -->
		          <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
		              <div class="modal-dialog">
		                  <div class="modal-content">
		                      <div class="modal-header">
		                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		                          <h4 class="modal-title">Forgot Password ?</h4>
		                      </div>
		                      <div class="modal-body">
		                          <p>Silahkan Hubungi Administrator Untuk Mendapatkan Password atau Akun.</p>
		                      </div>
		                      <div class="modal-footer">
		                          <button data-dismiss="modal" class="btn btn-default" type="button">OK</button>
		                      </div>
		                  </div>
		              </div>
		          </div>
		  <!-- modal -->

		  <!-- Modal -->
		          <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal1" class="modal fade">
		              <div class="modal-dialog">
		                  <div class="modal-content">
		                      <div class="modal-header">
		                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		                          <h4 class="modal-title">Belum mempunyai akun?</h4>
		                      </div>
		                      <div class="modal-body">
		                          <p>Silahkan Hubungi Administrator Untuk Mendapatkan Password atau Akun.</p>
		                      </div>
		                      <div class="modal-footer">
		                          <button data-dismiss="modal" class="btn btn-default" type="button">OK</button>
		                      </div>
		                  </div>
		              </div>
		          </div>
		  <!-- modal -->

	</body>
</html>

