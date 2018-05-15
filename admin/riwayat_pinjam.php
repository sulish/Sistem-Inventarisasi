<?php
	session_start();
	require("../config/config.php");
	if(isset($_SESSION['username']) && isset($_SESSION['type']) ){
		
	$kategori = 'alat';

	if( isset($_POST['kategori']) && $_POST['kategori'] == 'Bahan' ){
		$kategori = 'bahan';
	}

	require("../includes/admin_header.php"); 
	require("../includes/admin_sidebar.php");
	
?>

		<div class="content-block">
		
		<h2>RIWAYAT PEMINJAMAN ALAT DAN BARANG</h2>
		<form class="form-inline" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" >
	      <input type="hidden" value="alat" name="type_form" />
	      <div class="control-group" style="height: 50px;"> 
	      <label class="control-label" >Pencarian</label>
	      <div class="control-group" style="height: 50px;">
        	<select name="kategori">
      		<option <?php if(isset($_POST['kategori']) && $_POST['kategori'] == 'Alat'){ echo "selected='selected'"; } ?>>Alat</option>
      		<option <?php if(isset($_POST['kategori']) && $_POST['kategori'] == 'Bahan'){ echo "selected='selected'"; } ?>>Bahan</option>
      		</select>
	  		<button type="submit" class="btn" name="search" >Cari</button>
        </div>
      	</form>

<div style="width:100%;height:300px;overflow-y:scroll;overflow-x:scroll;">
<table class="table table-bordered table-striped table-condensed" >

<?php
	// ALAT
	if( $kategori == 'alat' ) {
  		$query=mysql_query("SELECT
		transaksi_pa.id_pinjam,
		transaksi_pa.indate,
		transaksi_pa.outdate,
		laboran.nama AS nama_laboran,
		alat.nama AS nama_alat,
		detail_pa.jumlah,
		detail_pa.`status`,
		`user`.username,
		alat.kd_barang,
		`user`.id_user
		FROM
		detail_pa
		INNER JOIN transaksi_pa ON transaksi_pa.id_pinjam = detail_pa.id_pinjam
		INNER JOIN laboran ON transaksi_pa.id_lab = laboran.id_user
		INNER JOIN alat ON detail_pa.id_alat = alat.kd_barang
		INNER JOIN `user` ON transaksi_pa.id_user = `user`.id_user
		where `user`.id_user='$_SESSION[id]'
		order by transaksi_pa.indate asc");
?>
	  	<thead>
	    	<tr >
	      		<th>Id Pinjam</th>
	      		<th>Tanggal Masuk</th>
	       		<th>Tanggal Kembali</th>
	    		<th>Peminjam</th>
				<th>Laboran</th>
				<th>Kode Alat</th>
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
			  	<td>
			  	<?php
			       		if( $hasil['status'] == '0'){
			       			echo "belum dikonfirmasi";
			       		}else if ($hasil['status'] == '1'){
			       			echo "dipinjam";
			       		}else{
			       			echo "sudah dikembalikan";
			       		}
			       	?>
			    </td>
			</tr>
	<?php
	    }
	?>
	  	</tbody>
<?php
	// BAHAN
	}elseif( $kategori == 'bahan' ){
 	$query=mysql_query("SELECT
	transaksi_pb.id_pinjam,
	transaksi_pb.indate,
	transaksi_pb.outdate,
	laboran.nama AS nama_laboran,
	bahan.nama AS nama_bahan,
	detail_pb.jumlah,
	detail_pb.`status`,
	`user`.username,
	bahan.kd_bahan,
	`user`.id_user,
	bahan.nama,
	bahan.kd_bahan
	FROM
	detail_pb
	INNER JOIN transaksi_pb ON transaksi_pb.id_pinjam = detail_pb.id_pinjam
	INNER JOIN laboran ON transaksi_pb.id_lab = laboran.id_user
	INNER JOIN `user` ON transaksi_pb.id_user = `user`.id_user
	INNER JOIN bahan ON detail_pb.id_alat = bahan.kd_bahan
	where `user`.id_user='$_SESSION[id]'
	order by transaksi_pb.indate asc");
?>

	<thead>
    	<tr >
      		<th>Id Pinjam</th>
      		<th>Tanggal Masuk</th>
       		<th>Tanggal Kembali</th>
    		<th>Peminjam</th>
			<th>Laboran</th>
			<th>Kode Bahan</th>
			<th>Nama Bahan</th>
			<th>Jumlah</th>
			<th>Status</th>
    	</tr>
  	</thead>
  	<tbody class="result">
	<?php
		while($x=mysql_fetch_array($query)){
	?>
		<tr>
		  	<td class="kode"><?php echo $x['id_pinjam'];?></td>
			  	<td class="nama"><?php echo $x['indate'];?></td>
			   	<td><?php echo $x['outdate'];?></td>
			  	<td><?php echo $x['username'];?></td>
			   	<td><?php echo $x['nama_laboran'];?></td>
			  	<td><?php echo $x['kd_bahan'];?></td>
			  	<td><?php echo $x['nama_bahan'];?></td>
			  	<td><?php echo $x['jumlah'];?></td>
			  	<td>
			  	<?php
			       		if( $x['status'] == '0'){
			       			echo "belum dikonfirmasi";
			       		}else if ($x['status'] == '1'){
			       			echo "dipinjam";
			       		}else{
			       			echo "sudah dikembalikan";
			       		}
			       	?>
			    </td>
		</tr>
<?php
		}
?>
  	</tbody>
<?php
	}
?>
 
        </table>
        <!-- </p>
        </div> -->
        </div>
<?php
	 }else{
	 	header("location:../masuk.php");

	}
?>

    