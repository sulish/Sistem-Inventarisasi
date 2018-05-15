<?php 
	// error_reporting(0);
	session_start();
	require("../config/config.php");
	if(isset($_SESSION['username']) && isset($_SESSION['type']) ){
	require("../includes/admin_header.php"); 
	require("../includes/admin_sidebar.php");
?>
	<script>
	// jquery konfirmasi per item dan semua
		jQuery(function(){
			jQuery('#konfirm-button').on('click',function(){
			
				if(confirm("Apakah anda yakin konfirmasi item ini?")==true){
						return true;
					
				}else{
					return false;
				
				}
			});
			
			jQuery('#konfirm-all').on('click',function(){
			
				if(confirm("Apakah anda yakin konfirmasi semua item ini?")==true){
						return true;
					
				}else{
					return false;
				
				}
			});
		});
	</script>

<div class="content-block">
<h3>DETAIL KONFIRMASI</h3>
		<!-- Notifikasi jumlah konfirmasi -->
		<?php
			if($count > 0){
				echo "	<h5>Saat ini anda memiliki total <span style='font-weight:bold;color:red;'> ".$count." </span> permintaan peminjaman yang belum terkonfirmasi <br/><span style='font-weight:bold;color:red;'> ".$jml_konfirmasi_pa." </span> permintaan alat <br/> <span style='font-weight:bold;color:red;'> ".$jml_konfirmasi_pb." </span> permintaan bahan</h5>";
				
			}else{
				echo "	<h5>Saat ini anda tidak memiliki permintaan peminjaman yang belum terkonfirmasi </h5>";
				
			}

			if($count > 0){
		?>
		<br/>

	<?php if(!isset($_REQUEST['show'])){ ?>

	 <form class="form-inline" method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
     <input type="hidden" value="alat" name="type_form" />
     <div class="control-group" style="height: 50px;"> 
     <label class="control-label" >Kategori Peminjaman</label>
     <div class="controls">
      	<select name="kategori" name="kategori">
	      	<option <?php if(isset($_POST['kategori']) && $_POST['kategori'] == 'Alat'){ echo "selected='selected'"; } ?>>Alat</option>
	      	<option <?php if(isset($_POST['kategori']) && $_POST['kategori'] == 'Bahan'){ echo "selected='selected'"; } ?>>Bahan</option>
        </select>
      	<button type="submit" class="btn">Lihat Detail</button>
     </div>
     </div>
     </form>

	<?php }else{ ?>
	<form action="cetak_struk.php" method="post" >
			<input type="hidden" value="<?php echo $_REQUEST['idtrans']; ?>" name="id_trans" />
			<input type="hidden" value="<?php echo $_REQUEST['usr']; ?>" name="nama_user" />
			<input type="hidden" value="<?php echo $_SESSION['nama']; ?>" name="nama_laboran" />
			<input type="hidden" value="<?php echo $_REQUEST['katg']; ?>" name="kategori" />
			<a href="detail_konfirmasi.php" class="btn btn-secondary" ><i class='icon-chevron-left'></i> Kembali</a> &nbsp;
			<button type="submit" class="btn btn-primary" name="cetak" value="cetak"><i class='icon-print'></i> Cetak</button>&nbsp;
			<a href="?idtrans=<?php echo $_REQUEST['idtrans']; ?>&katg=<?php echo  $_REQUEST['katg'];; ?>&konfirm=all&show=detail" class="btn btn-secondary" id="konfirm-all" ><i class='icon-check'></i> Konfirmasi Semua</a>
		</form>
		 <br/><br/>
	<?php } ?>


<div style="max-height:300px;overflow:scroll;">
<p style="width:100%;">
<table class="table table-striped"  >

	<?php
		// indentifikasi peminjaman alat atau bahan menggunakan prefix
		$prefix="pa";
		$katg="alat";
		$kd_prefix="kd_barang";
		if (isset($_REQUEST['katg']) && $_REQUEST['katg'] == "bahan") {
				$prefix = "pb";
				$katg ="bahan";
				$kd_prefix="kd_bahan";
			}

		if (isset($_REQUEST['katg']) && isset($_REQUEST['idtrans'])) {
			
		
		$idtransaksi = $_REQUEST['idtrans'];
		
		$relasi_transaksi = mysql_query (
		"SELECT `detail_".$prefix."`.`no`,`transaksi_".$prefix."`.`id_pinjam`,`".$katg."`.`nama`,`detail_".$prefix."`.`jumlah`,`transaksi_".$prefix."`.`indate`,`transaksi_".$prefix."`.`outdate`,`user`.`status` AS `tipe_user`,`detail_".$prefix."`.`status`,`transaksi_".$prefix."`.`id_user`,`user`.`username`
		FROM transaksi_".$prefix." 
		INNER JOIN `detail_".$prefix."` ON `transaksi_".$prefix."`.`id_pinjam` = `detail_".$prefix."`.`id_pinjam`
		INNER JOIN ".$katg." ON `detail_".$prefix."`.`id_alat` = `".$katg."`.`".$kd_prefix."`
		INNER JOIN `user` ON `transaksi_".$prefix."`.`id_user` = `user`.`id_user`
		WHERE `transaksi_".$prefix."`.`id_pinjam`='".$idtransaksi."'"	);
	?>
		<thead>
	    	<tr >
	      		<th>ID Transaksi</th>
	      		<th>Nama Barang</th>
	       		<th>Jumlah</th>
	    		<th>Tanggal Masuk</th>
				<th>Tanggal Kembali</th>
				<th>Peminjam</th>
				<th>Status</th>
			
	    	</tr>
	  	</thead>
	  	<tbody class="result">
		<?php
		
			$user_pinjam ="";
			while($row_transaksi = mysql_fetch_array($relasi_transaksi)){
		?>
			<tr>
			  	<td><?php echo $row_transaksi['id_pinjam'];?></td>
			  	<td><?php echo $row_transaksi['nama'];?></td>
			  	<td><?php echo $row_transaksi['jumlah'];?></td>
			  	<td><?php echo $row_transaksi['indate'];?></td>
			  	<td><?php echo $row_transaksi['outdate'];?></td>
			  	<td><?php if(isset($_REQUEST['usr'])) {echo $_REQUEST['usr']; }?></td>
			  
			   	<th>
			       	<?php
			       		if( $row_transaksi['status'] == '0'){
			       			?>
			       			<a href="?idtrans=<?php echo $row_transaksi['id_pinjam']; ?>&katg=<?php echo $katg; ?>&konfirm=<?php echo $row_transaksi['no'];?>&show=detail" id="konfirm-button">konfirmasi</a>
			       			<?php
			       		}else{
			       			echo "sudah terkonfirmasi";
			       		}
			       	?>
			   	</th>
			</tr>
			<?php } ?>
		</tbody>
		
		
	<?php
		}else{
			$query_trans="";
			if (isset($_POST['kategori']) and $_POST['kategori'] == "Bahan") {
					$query_trans = "SELECT * FROM transaksi_pb,user WHERE transaksi_pb.id_user = user.id_user AND transaksi_pb.id_lab=".$_SESSION['id']."";
			}else{
					$query_trans = "SELECT * FROM transaksi_pa,user WHERE transaksi_pa.id_user = user.id_user  AND transaksi_pa.id_lab=".$_SESSION['id']."";
			}
	?>
		<thead>
	    	<tr >
	      		<th>ID Transaksi</th>
	    		<th>Tanggal Masuk</th>
				<th>Tanggal Kembali</th>
				<th>Peminjam</th>
				<th>Action</th>
			
	    	</tr>
	  	</thead>
	  	
	  	<tbody class="result">
	<?php
			$query_trans=mysql_query($query_trans);
			while($row_trans=mysql_fetch_array($query_trans)){
				
	?>
			<tr>
			  	<td><?php echo $row_trans['id_pinjam'];?></td>
			  	<td><?php echo $row_trans['indate'];?></td>
			  	<td><?php echo $row_trans['outdate'];?></td>
			  	<td><?php echo $row_trans['username'];?></td>
			  	<td>
				<a href="?idtrans=<?php echo $row_trans['id_pinjam']; ?>&katg=<?php if(isset($_POST['kategori']) && ($_POST['kategori']=="Bahan")){echo "bahan"; }else{ echo "alat"; }?>&usr=<?php echo $row_trans['username'];?>&show=detail">Lihat Detail </a>
				</td>
			</tr>
	<?php
			}
			echo "</tbody>";	
		} 
	?>
	
<?php  
	
	if(isset($_REQUEST['konfirm']) && isset($_REQUEST['idtrans'])){
		$konfirm = $_REQUEST['konfirm'];
		$id_trans = $_REQUEST['idtrans'];
		function alert_confirm($q_konfirm,$id_trans,$konfirm){
		
			if($q_konfirm==1){
				?>
				
				<script>
					function Redirect(){
							window.location = '?idtrans=<?php echo $id_trans; ?>&katg=<?php echo $konfirm; ?>&show=detail';
					}
						window.alert("Peminjaman Terkonfirmasi");
						setTimeout('Redirect()', 100);
						
				</script>
				<?php
				
			}else{
				?>
				<script>
						function Redirect(){
								window.location = '?idtrans=<?php echo $id_trans; ?>&katg=<?php echo $konfirm; ?>&show=detail';
						}
						window.alert("Peminjaman Tidak Terkonfirmasi, Coba lagi");
						setTimeout('Redirect()', 100);
				</script>
				<?php
			}
		}
		if($konfirm=="all"){
		
			 $q_konfirm = mysql_query("UPDATE detail_".$prefix." SET status=1  WHERE id_pinjam='".$id_trans."'");
			 alert_confirm($q_konfirm,$id_trans,$konfirm);
		}else{
			$q_konfirm = mysql_query("UPDATE detail_".$prefix." SET status=1  WHERE no=".$konfirm."");
			alert_confirm($q_konfirm,$id_trans,$konfirm);
		}
		
	}
}
?>
<?php
	 }else{
	 	header("location:../masuk.php");

	}
?>

