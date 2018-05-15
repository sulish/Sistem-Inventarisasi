<?php
	session_start();
	require("../config/config.php");
	if(isset($_SESSION['username']) && isset($_SESSION['type']) ){
	require("../includes/admin_header.php"); 
	require("../includes/admin_sidebar.php");
	
	
?>

		<div class="content-block">
		
		<h2>DATA REKAP PEMINJAMAN ALAT</h2>
		<form class="form-inline" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" >
	      <input type="hidden" value="alat" name="type_form" />
	      <div class="control-group" style="height: 50px;"> 
	      <label class="control-label" >Pencarian</label>
	      <div class="control-group" style="height: 50px;">
  			<input type="text" name="cari" value="Masukkan kata kunci" size="35" onclick="this.value=''"  style="height:30px; width:250px">
	  		<button type="submit" class="btn" name="search" >Cari</button>
        </div>
      	</form>

      	<!-- <p class='pull-right'>
		<a href='export/rekap_kembali_xls.php'
		target='_blank'
		class="btn" ><i class='icon-download-alt'></i> Excel</a>
		<a href='export/rekap_kembali_cetak.php'
		target='_blank'
		class="btn" ><i class='icon-print'></i>cetak</a>
		</p> -->

<div style="width:100%;height:300px;overflow-y:scroll;overflow-x:scroll;">
<table class="table table-bordered table-striped table-condensed" >

<?php
	// ALAT
		if(isset($_POST['cari'])){
        $query=mysql_query(" SELECT
		transaksi_pa.id_pinjam,
		transaksi_pa.indate,
		transaksi_pa.outdate,
		laboran.nama AS nama_laboran,
		alat.nama AS nama_alat,
		detail_pa.jumlah,
		detail_pa.`status`,
		`user`.username,
		alat.kd_barang
		FROM
		detail_pa
		INNER JOIN transaksi_pa ON transaksi_pa.id_pinjam = detail_pa.id_pinjam
		INNER JOIN laboran ON transaksi_pa.id_lab = laboran.id_user
		INNER JOIN alat ON detail_pa.id_alat = alat.kd_barang
		INNER JOIN `user` ON transaksi_pa.id_user = `user`.id_user
		where detail_pa.status='1' and (transaksi_pa.indate like '%$_POST[cari]%' or transaksi_pa.outdate like '%$_POST[cari]%' or laboran.nama like '%$_POST[cari]%'
		or alat.nama like '%$_POST[cari]%') and transaksi_pa.id_lab='$_SESSION[id]' order by transaksi_pa.indate asc");

}else{
  		$query=mysql_query("SELECT
		transaksi_pa.id_pinjam,
		transaksi_pa.indate,
		transaksi_pa.outdate,
		laboran.nama AS nama_laboran,
		alat.nama AS nama_alat,
		detail_pa.jumlah,
		detail_pa.`status`,
		`user`.username,
		alat.kd_barang
		FROM
		detail_pa
		INNER JOIN transaksi_pa ON transaksi_pa.id_pinjam = detail_pa.id_pinjam
		INNER JOIN laboran ON transaksi_pa.id_lab = laboran.id_user
		INNER JOIN alat ON detail_pa.id_alat = alat.kd_barang
		INNER JOIN `user` ON transaksi_pa.id_user = `user`.id_user
		where detail_pa.status='1' and transaksi_pa.id_lab='$_SESSION[id]'
		order by transaksi_pa.indate asc");
  }
?>
	  	<thead>
	    	<tr >
	      		<th>Id Pinjam</th>
	      		<th>Tanggal Masuk</th>
	       		<th>Tanggal Kembali</th>
	    		<th>Peminjam</th>
				<th>Laboran</th>
				<th> Kode Alat</th>
				<th>Nama Alat</th>
				<th>Jumlah</th>
				<th>Status</th>
	    	</tr>
	  	</thead>
	  	<tbody class="result">
		<?php
			while($hasil=mysql_fetch_array($query)){
		?>
			<tr>
			  	<td class="kode"><?php echo $hasil['id_pinjam'];?></td>
			  	<td class="nama"><?php echo $hasil['indate'];?></td>
			   	<td><?php echo $hasil['outdate'];?></td>
			  	<td><?php echo $hasil['username'];?></td>
			   	<td><?php echo $hasil['nama_laboran'];?></td>
			  	<td><?php echo $hasil['kd_barang'];?></td>
			  	<td><?php echo $hasil['nama_alat'];?></td>
			  	<td><?php echo $hasil['jumlah'];?></td>
			  	<td>Dipinjam</td>
			</tr>
	<?php
	    }
	?>
	  	</tbody>
        </table>
        </div>
        </div>
        <?php
	 }else{
	 	header("location:../masuk.php");

	}
?>


    