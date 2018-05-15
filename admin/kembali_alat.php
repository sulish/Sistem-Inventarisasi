<?php
	session_start();
	require("../config/config.php");
	if(isset($_SESSION['username']) && isset($_SESSION['type']) ){
	require("../includes/admin_header.php"); 
	require("../includes/admin_sidebar.php");
	
	if(isset($_GET['act']) and $_GET['act']=='konfirmasi'){
		$id=$_GET['id'];
		$id_pinjam=$_GET['id_pinjam'];

		
		mysql_query("UPDATE detail_pa SET status='2' where no='$id'");
		mysql_query("UPDATE transaksi_pa SET outdate=NOW() where id_pinjam='$id_pinjam'");
		?>
		<div class="alert alert-success"><b>Sukses!</b> Data Alat telah dikembalikan.</div>
		<?php
	}
?>

		<div class="content-block">
		
		<h2>TRANSAKSI MASUK DATA INVENTARIS</h2>
		<form class="form-inline" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" >
	      <input type="hidden" value="alat" name="type_form" />
	      <div class="control-group" style="height: 50px;"> 
	      <label class="control-label" >Pencarian</label>
	      <div class="control-group" style="height: 50px;">
  			<input type="text" name="cari" value="Masukkan kata kunci" size="35" onclick="this.value=''"  style="height:30px; width:250px">
	  		<button type="submit" class="btn" name="search" >Cari</button>
        </div>
      	</form>

<div style="width:100%;height:300px;overflow-y:scroll;overflow-x:scroll;">
<table class="table table-bordered table-striped table-condensed" >

<?php
	// ALAT
  		$query=mysql_query("SELECT
		transaksi_pa.id_pinjam,
		transaksi_pa.indate,
		transaksi_pa.outdate,
		laboran.nama AS nama_laboran,
		alat.nama AS nama_alat,
		detail_pa.jumlah,
		detail_pa.no,
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
?>
	  	<thead>
	    	<tr >
	      		<th>Id Pinjam</th>
	      		<th>Tanggal Masuk</th>
	       		<th>Tanggal Kembali</th>
	    		<th>Peminjam</th>
				<th>Laboran</th>
				<th>Nama Alat</th>
				<th>Jumlah</th>
				<th>Status</th>
				<th>Action</th>
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
			  	<td><?php echo $hasil['nama_alat'];?></td>
			  	<td><?php echo $hasil['jumlah'];?></td>
			  	<td>belum kembali</td>
				<td>
			       	<?php
			       		if( $hasil['status'] == '1'){
			       			?>
			       			<a href="kembali_alat.php?act=konfirmasi&id=<?php echo $hasil['no'];?>&id_pinjam=<?php echo $hasil['id_pinjam'];?>" onclick = "return confirm ('Anda yakin ingin mengkonfirmasi <?=$hasil['nama_alat'];?>?')" id="konfirm-button">konfirmasi</a>
			       			<?php
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
 
        </table>
        </div>
        </div>
<?php
	 }else{
	 	header("location:../masuk.php");

	}
?>

    