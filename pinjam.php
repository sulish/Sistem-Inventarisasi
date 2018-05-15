<?php
	session_start();
	require("config/config.php");
	$kategori = 'alat';

	if( isset($_POST['kategori']) && $_POST['kategori'] == 'Bahan' ){
		$kategori = 'bahan';
	}
?>

<?php
	$query=mysql_query("SELECT * from alat order by id_alat asc");
?>


<html>
	<head>
		<title>Peminjaman | SYSIN TE-UM </title>
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
				<li ><a href="index.php"> Beranda </a></li>
				<li class="current" ><a href="pinjam.php">Pencarian</a></li>
				
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
		<div id="navbar">
			<ul>
				<li ><a href="index.php"> Beranda </a></li>
				<li class="current" ><a href="pinjam.php">Pencarian</a></li>
				
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
		<h3><i class="fa  fa-lightbulb-o"></i> Peminjaman </h3>
		</div>
	</div>

	<div class="about-us">
		<div class="container">
		<h1 style="color:#16D6FF;">Pencarian Informasi Alat dan Bahan yang Tersedia</h1><br/>
		<p>Pengunjung dapat melakukan pencarian terkait alat dan bahan yang tersedia<br/> Jika alat dan bahan yang anda perlukan tersedia, Silakan melakukan login dengan akun anda untuk melakukan peminjaman</p>
		 	<div class="subscribe">
		 		<!-- Seleksi alat atau Bahan -->
		 		<form class="form-inline" method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
                	<select class="form-control" name="kategori" id="search-option" value="" style=" height: 28px; width:150px !important">
					<option <?php if(isset($_POST['kategori']) && $_POST['kategori'] == 'Alat'){ echo "selected='selected'"; } ?>>Alat</option>
  					<option <?php if(isset($_POST['kategori']) && $_POST['kategori'] == 'Bahan'){ echo "selected='selected'"; } ?>>Bahan</option>
					</select>
                    <input type="text" name="cari"  size="35" placeholder="Ketikkan kata kunci">
                     <button type="submit" class="btn" name="search" style="height: 28px; width:80px !important ">Cari</button>
                </form>
            </div>

    <div style="border:1px solid white;width:100%;height:300px;overflow-y:scroll;overflow-x:scroll;">
	<p style="width:100%;">
	<table class="table table-striped" >

<?php
	// ALAT
	if( $kategori == 'alat' ) {
		if(isset($_POST['cari'])){
       $query=mysql_query("SELECT alat.id_barang,
		alat.kd_barang,
		alat.nama as nama_alat,
		alat.merk,
		alat.tahun,
		alat.jumlah,
		alat.satuan,
		alat.kondisi,
		alat.harga,
		alat.smbr_dana,
		alat.no_aset,
		alat.id_dep,
		kantor.nama as nama_kantor
		FROM
		alat
		INNER JOIN kantor ON kantor.id_dep = alat.id_dep where alat.kd_barang like '%$_POST[cari]%' or alat.nama like '%$_POST[cari]%' or alat.merk like '%$_POST[cari]%' or alat.tahun like '%$_POST[cari]%' 
        or alat.jumlah like '%$_POST[cari]%' or alat.satuan like '%$_POST[cari]%' or alat.kondisi like '%$_POST[cari]%' or alat.harga like '%$_POST[cari]%' 
        or alat.smbr_dana like '%$_POST[cari]%' or alat.no_aset like '%$_POST[cari]%' or kantor.nama like '%$_POST[cari]%' order by alat.nama asc");
}else{
  		$query=mysql_query("SELECT alat.id_barang,
		alat.kd_barang,
		alat.nama as nama_alat,
		alat.merk,
		alat.tahun,
		alat.jumlah,
		alat.satuan,
		alat.kondisi,
		alat.harga,
		alat.smbr_dana,
		alat.no_aset,
		alat.id_dep,
		kantor.nama as nama_kantor
		FROM
		alat
		INNER JOIN kantor ON kantor.id_dep = alat.id_dep");
  	}
?>
	  	<thead>
	    	<tr >
	      		<th>Kode</th>
	      		<th>Nama</th>
	       		<th>Merk</th>
	    		<th>Tahun</th>
				<th>Jumlah</th>
				<th>Satuan</th>
				<th>Kondisi</th>
				<th>Lokasi</th>
				<th>Keterangan</th>
	    	</tr>
	  	</thead>
	  	<tbody class="result">

		<?php
			while($hasil=mysql_fetch_array($query)){
		?>
			<tr>
			  	<td class="kode"><?php echo $hasil['kd_barang'];?></td>
			  	<td class="nama"><?php echo $hasil['nama_alat'];?></td>
			   	<td><?php echo $hasil['merk'];?></td>
			    <td><?php echo $hasil['tahun'];?></td>
		        <td><?php echo $hasil['jumlah'];?></td>
		        <td><?php echo $hasil['satuan'];?></td>
		        <td><?php echo $hasil['kondisi'];?></td>
		        <td><?php echo $hasil['nama_kantor'];?></td>
		        <th>
			       	<?php
			       		if( $hasil['kondisi'] == 'baik' || $hasil['kondisi'] == 'rusak ringan'){
			       			?>
			       			<a class="pinjamButton">Tersedia</a>
			       			<?php
			       		}else{
			       			echo "tidak tersedia";
			       		}
			       	?>
			   	</th>
			</tr>
	<?php
	    }
?>
	  	</tbody>
	  	
<?php
	// BAHAN
	}elseif( $kategori == 'bahan' ){
		if(isset($_POST['cari'])){
       $query=mysql_query("SELECT
  bahan.id_bahan,
  bahan.kd_bahan,
  bahan.nama as nama_bahan,
  bahan.tahun,
  bahan.jumlah,
  bahan.satuan,
  kantor.nama as lokasi
  FROM
  bahan
  INNER JOIN kantor ON bahan.id_dep = kantor.id_dep  where bahan.kd_bahan like '%$_POST[cari]%' or bahan.nama like '%$_POST[cari]%' or bahan.tahun like '%$_POST[cari]%' or bahan.jumlah like '%$_POST[cari]%' 
        or bahan.satuan like '%$_POST[cari]%' or kantor.nama like '%$_POST[cari]%' order by bahan.nama asc");
}else{

  $query=mysql_query("SELECT
  bahan.id_bahan,
  bahan.kd_bahan,
  bahan.nama as nama_bahan,
  bahan.tahun,
  bahan.jumlah,
  bahan.satuan,
  kantor.nama as lokasi
  FROM
  bahan
  INNER JOIN kantor ON bahan.id_dep = kantor.id_dep");
}
?>

	<thead>
    	<tr >
      		<th>Kode</th>
      		<th>Nama</th>
    		<th>Tahun</th>
			<th>Jumlah</th>
			<th>Satuan</th>
			<th>Lokasi</th>
			<th>Keterangan</th>
    	</tr>
  	</thead>
  	<tbody class="result">
	<?php
		while($hasil=mysql_fetch_array($query)){
	?>
		<tr>
		  	<td class="kode"><?php echo $hasil['kd_bahan'];?></td>
		  	<td class="nama"><?php echo $hasil['nama_bahan'];?></td>
		  	<td><?php echo $hasil['tahun'];?></td>
		   	<td><?php echo $hasil['jumlah'];?></td>
		  	<td><?php echo $hasil['satuan'];?></td>
		  	<td><?php echo $hasil['lokasi'];?></td>
		  	<th>
		       	<?php
		       		if( $hasil['jumlah'] > 0){
		       			?>
		       			<a class="pinjamButton">Tersedia</a>
		       			<?php
		       		}else{
		       			echo "tidak tersedia";
		       		}
		       	?>
		   	</th>
		</tr>
<?php
		}
?>
  	</tbody>
<?php
	}
?>
 
        </table>
        </p>
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