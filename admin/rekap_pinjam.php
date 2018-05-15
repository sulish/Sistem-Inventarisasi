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
		transaksi_pb.id_pinjam,
		transaksi_pb.indate,
		transaksi_pb.outdate,
		laboran.nama AS nama_laboran,
		bahan.nama AS nama_bahan,
		detail_pb.jumlah,
		detail_pb.`status`,
		`user`.username,
		bahan.kd_bahan
		FROM
		detail_pb
		INNER JOIN transaksi_pb ON transaksi_pb.id_pinjam = detail_pb.id_pinjam
		INNER JOIN laboran ON transaksi_pb.id_lab = laboran.id_user
		INNER JOIN bahan ON detail_pb.id_alat = bahan.kd_bahan
		INNER JOIN `user` ON transaksi_pb.id_user = `user`.id_user
		where detail_pb.status='1' and (transaksi_pb.indate like '%$_POST[cari]%' or transaksi_pb.outdate like '%$_POST[cari]%' or laboran.nama like '%$_POST[cari]%'
		or bahan.nama like '%$_POST[cari]%') and transaksi_pb.id_lab='$_SESSION[id]' order by transaksi_pb.indate asc");
		
}else{
  		$query=mysql_query("SELECT
		transaksi_pb.id_pinjam,
		transaksi_pb.indate,
		transaksi_pb.outdate,
		laboran.nama AS nama_laboran,
		bahan.nama AS nama_bahan,
		detail_pb.jumlah,
		detail_pb.`status`,
		`user`.username,
		bahan.kd_bahan
		FROM
		detail_pb
		INNER JOIN transaksi_pb ON transaksi_pb.id_pinjam = detail_pb.id_pinjam
		INNER JOIN laboran ON transaksi_pb.id_lab = laboran.id_user
		INNER JOIN bahan ON detail_pb.id_alat = bahan.kd_bahan
		INNER JOIN `user` ON transaksi_pb.id_user = `user`.id_user
		where detail_pb.status='1' and transaksi_pb.id_lab='$_SESSION[id]'
		order by transaksi_pb.indate asc")or die (mysql_error());
  }
?>
	  	<thead>
	    	<tr >
	      		<th>Id Pinjam</th>
	      		<th>Tanggal Masuk</th>
	       		<th>Tanggal Kembali</th>
	    		<th>Peminjam</th>
				<th>Laboran</th>
				<th> Kode Bahan</th>
				<th>Nama Bahan</th>
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
			  	<td><?php echo $hasil['kd_bahan'];?></td>
			  	<td><?php echo $hasil['nama_bahan'];?></td>
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


    