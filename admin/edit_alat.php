
<?php
	error_reporting(0);
	require("../config/config.php");
	// identifikasi kode /id alat dan tipe alat/bahan
	$tipe=$_REQUEST['type']; //tipe alat atau bahan
	$kode = $_REQUEST['id']; //id alat
	if($tipe == "barang"){
		$hasil=mysql_query("SELECT * from alat where kd_barang='$kode' ");
		$x=mysql_fetch_array($hasil);
?>
		  
		<h3>Ubah Data Alat dan Bahan</h3><br><br>
		<form class="form-horizontal" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" style="width:50%"  >
			<input type="hidden" value="alat" name="type_form" />
			<div class="control-group">	
			<label class="control-label" for="inputkodebarang">Kode Alat/Barang</label>
			<div class="controls">
			  <input type="text" name="kd_barang" readonly="readonly" id="kd_barang_register" value="<?php echo $x['kd_barang'];?>" placeholder="Kode Barang" style="height:30px; width: 400px !important">
			</div>
		    </div>

		   <div class="control-group">
			<label class="control-label" for="inputNama">Nama</label>
			<div class="controls">
			  <input type="text" id="inputNama" name="nama" value="<?php echo $x['nama'];?>" placeholder="Nama" style="height:30px; width:400px !important">
			</div>
		  </div>

			<div class="control-group">
			<label class="control-label" for="inputmerk">Merk</label>
			<div class="controls">
			  <input type="text" id="inputMerk" name="merk" value="<?php echo $x['merk'];?>" placeholder="Merk" style="height:30px; width:400px !important">
			</div>
		  	</div>

		  	<div class="control-group">
			<label class="control-label" for="inputmerk">Spesifikasi</label>
			<div class="controls">
			  <input type="text" id="inputMerk" name="spec" value="<?php echo $x['spec'];?>" placeholder="Spesifikasi" style="height:30px; width:400px !important">
			</div>
		  	</div>

		  <div class="control-group">
			<label class="control-label" for="inputkondisi">Tahun</label>
			<div class="controls">
				<select class="form-control" id="inputtahun" name="tahun" value="<?php echo $x['tahun'];?>" style="width:400px !important">
					<!-- Membuat tahun mulai 20 tahun yang lalu -->
				<option>Tahun</option>
				<?php
				for($i=date('Y'); $i>=date('Y')-20; $i-=1){
				if($x['tahun']==$i){
					$cek='selected=selected';
				}else{
					$cek='';
				}
				echo"<option $cek value='$i'> $i </option>";
				}
				?>
				</select>
			</div>
		  </div>


		   <div class="control-group">
			<label class="control-label" for="inputJumlah">Jumlah</label>
			<div class="controls">
			  <input type="number" id="inputJumlah" readonly="readonly" name="jumlah" value="<?php echo $x['jumlah'];?>" placeholder="Jumlah" style="height:30px; width:400px !important">
			</div>
		  </div>

		  <div class="control-group">
			<label class="control-label" for="inputsatuan">Satuan</label>
			<div class="controls">
					<select class="form-control" name="satuan" id="search-option" value="<?php echo $x['satuan'];?>" style="width:400px !important">
					<option value="buah">Buah</option>
					<option value="set">Set</option>
					</select>
			</div>
		  </div>

		  <div class="control-group">
			<label class="control-label" for="inputm">Tanggal Masuk</label>
			<div class="controls">
			<?php
					$kd = $x['kd_barang'];
					$query_trans=mysql_query("SELECT * FROM transaksi_ma WHERE kd_barang='$kd'");
					$trans_ma=mysql_fetch_array($query_trans);
				?>
			  <input type="date" name="tgl_masuk" id="inputm" value="<?php echo $trans_ma['tgl_masuk'];?>" placeholder="Tanggal Masuk" style="height:30px; width:400px !important">
			</div>
		  </div>


		  <div class="control-group">
			<label class="control-label" for="inputkondisi">Kondisi</label>
			<div class="controls">
					<select class="form-control" name="kondisi" id="search-option" value="<?php echo $x['kondisi'];?>" style="width:400px !important">
					<option value="baik">Baik</option>
					<option value="rusak ringan">Rusak Ringan</option>
					<option value="rusak berat">Rusak Berat</option>
					<option value="dipulihkan">Dipulihkan</option>
					</select>
			</div>
		  </div>
		 
		   <div class="control-group">
			<label class="control-label" for="inputharga">Harga</label>
			<div class="controls">
			  <input type="number" id="inputharga" name="harga" value="<?php echo $x['harga'];?>" placeholder="Harga" style="height:30px; width:400px !important">
			</div>
		  </div>
		   <div class="control-group">
			<label class="control-label" for="inputsd">Sumber Dana</label>
			<div class="controls">
			  <input type="text" id="inputsd" name="smbr_dana" value="<?php echo $x['smbr_dana'];?>" placeholder="Sumber Dana" class="form-control" rows="3" style="width:400px !important"> 
			</div>
		  </div>
		   
		   <div class="control-group">
			<label class="control-label" for="inputaset">No Aset</label>
			<div class="controls">
			  <input type="text" name="no_aset" id="inputaset" value="<?php echo $x['no_aset'];?>" placeholder="No Aset" style="height:30px; width:400px !important">
			</div>
		  </div>
		 
		  <div class="control-group" id="ruangan">
			<label class="control-label" for="inputruang">Ruangan</label>
			<div class="controls">
					<select class="form-control" name="id_dep" id="inputRuang" value="<?php if(isset($_POST['id_dep'])){ echo $_POST['id_dep']; } ?>" style="width:400px !important">
					<?php
					$query=mysql_query("SELECT * FROM kantor");
					while ($h=mysql_fetch_array($query)) {
					if($x['id_dep']==$h['id_dep']){
						$cek='selected=selected';
					}else{
						$cek='';
					}
						echo "<option $cek value=$h[id_dep]>$h[nama]</option>";
					}
					?>
					</select>
			</div>
			</div>
		  <div class="controls">
		<!--  <div class="form-actions"> -->
		  <input type="hidden" name="kd_barang" value="<?php echo $x['kd_barang'];?>">
		  <button type="submit" class="btn btn-primary" name="edit_data" value="edit_alat">Simpan</button>
		  <!-- </div> -->
		</div>
		</form>
		 
<?php
		
	}else if($tipe=="bahan"){
		
		$hasil=mysql_query("SELECT * from bahan,transaksi_mb where bahan.kd_bahan='$kode' AND transaksi_mb.kd_bahan=bahan.kd_bahan  ");
		$x=mysql_fetch_array($hasil);
		  ?>

	
		<h2>Ubah Data Bahan Habis Pakai</h2><br><br>
		<form class="form-horizontal" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" style="width:50%"  >
			<input type="hidden" value="bahan" name="type_form" />
			<div class="control-group">	
			<label class="control-label" for="inputkodebarang">Kode Alat/Barang</label>
			<div class="controls">
			  <input type="text" name="kd_barang" readonly="readonly" id="kd_barang_register" value="<?php echo $x['kd_bahan'];?>" placeholder="Kode Barang" style="height:30px; width:400px !important">
			</div>
		  </div>
		   <div class="control-group">
			<label class="control-label" for="inputNama">Nama</label>
			<div class="controls">
			  <input type="text" id="inputNama" name="nama" value="<?php echo $x['nama'];?>" placeholder="Nama" style="height:30px; width:400px !important">
			</div>
		  </div>
			<div class="control-group">
			<label class="control-label" for="inputmerk">Merk</label>
			<div class="controls">
			  <input type="text" id="inputMerk" name="merk" value="<?php echo $x['merk'];?>" placeholder="Merk" style="height:30px; width:400px !important">
			</div>
		  </div>
		  <div class="control-group">
			<label class="control-label" for="inputkondisi">Tahun</label>
			<div class="controls">
				<select class="form-control" id="inputtahun" name="tahun" value="<?php echo $x['tahun'];?>" style="width:400px !important">
				<option>Tahun</option>
				<?php
				for($i=date('Y'); $i>=date('Y')-20; $i-=1){
				if($x['tahun']==$i){
					$cek='selected=selected';
				}else{
					$cek='';
				}
				echo"<option $cek value='$i'> $i </option>";
				}
				?>
				</select>
			</div>
		  </div>
		   <div class="control-group">
			<label class="control-label" for="inputJumlah">Jumlah</label>
			<div class="controls">
			  <input type="number" id="inputJumlah" readonly="readonly" name="jumlah" value="<?php echo $x['jumlah'];?>" placeholder="Jumlah" style="height:30px; width:400px !important">
			</div>
		  </div>
		  <div class="control-group">
			<label class="control-label" for="inputsatuan">Satuan</label>
			<div class="controls">
					<select class="form-control" name="satuan" id="search-option" value="<?php echo $x['satuan'];?>" style="width:400px !important">
					<option value="buah">Buah</option>
					<option value="set">Set</option>
					</select>
			</div>
		  </div>
		  <div class="control-group">
			<label class="control-label" for="inputm">Tanggal Masuk</label>
			<div class="controls">
			  <input type="date" name="tgl_masuk" id="inputm" value="<?php echo $x['tgl_masuk'];?>" placeholder="Tanggal Masuk" style="height:30px; width:400px !important">
			</div>
		  </div>
		  <div class="control-group">
			<label class="control-label" for="inputkondisi">Kondisi</label>
			<div class="controls">
					<select class="form-control" name="kondisi" id="search-option" value="<?php echo $x['kondisi'];?>" style="width:400px !important">
					<option value="baik">Baik</option>
					<option value="rusak ringan">Rusak Ringan</option>
					<option value="rusak berat">Rusak Berat</option>
					<option value="dipulihkan">Dipulihkan</option>
					</select>
			</div>
		  </div>
		 
		   <div class="control-group">
			<label class="control-label" for="inputharga">Harga</label>
			<div class="controls">
			  <input type="number" id="inputharga" name="harga" value="<?php echo $x['harga'];?>" placeholder="Harga" style="height:30px; width:400px !important">
			</div>
		  </div>
		   <div class="control-group">
			<label class="control-label" for="inputsd">Sumber Dana</label>
			<div class="controls">
			  <input type="text" id="inputsd" name="smbr_dana" value="<?php echo $x['smbr_dana'];?>" placeholder="Sumber Dana" class="form-control" rows="3" style=" height:30px; width:400px !important"> 
			</div>
		  </div>
		 
		 
		  <div class="control-group" id="ruangan">
			<label class="control-label" for="inputruang">Ruangan</label>
			<div class="controls">
					<select class="form-control" name="id_dep" id="inputRuang" value="<?php if(isset($_POST['id_dep'])){ echo $_POST['id_dep']; } ?>" style="width:400px !important">
					<?php
					$query=mysql_query("SELECT * FROM kantor");
					while ($h=mysql_fetch_array($query)) {
					if($x['id_dep']==$h['id_dep']){
						$cek='selected=selected';
					}else{
						$cek='';
					}
						echo "<option $cek value=$h[id_dep]>$h[nama]</option>";
					}
					?>
					</select>
			</div>
			</div>
		  <div class="controls">
		<!--  <div class="form-actions"> -->
		  <button type="submit" class="btn btn-primary" name="edit_data" value="edit_bahan">Simpan</button>
		  <!-- </div> -->
		</div>
		</form>
		 
	
	<?php
	}else{
		echo "Error 404 , Data tidak ditemukan !";
	}

	// proses edit
	if(isset($_POST['edit_data'])){
		extract($_POST);
		//mengecek apakah valuanya ada apa tidak
		if (($edit_data=="edit_alat") && ($kd_barang!="") && ($nama!="") && ($merk!="") && ($spec!="") && ($tahun!="")&& ($jumlah!="") && ($satuan!="") && ($kondisi!="") && ($harga!="") && ($smbr_dana!="") && ($no_aset!="") && ($tgl_masuk!="") && ($id_dep!="")){
			//$update_alat = mysql_query("UPDATE  `alat` SET  `tahun` =  '2014', `nama` =  '$nama', `merk` =  '$merk', `tahun` =  '$tahun', `jumlah` =  '$jumlah', `satuan` =  '$satuan', `kondisi` =  '$kondisi', `harga` =  '$harga', `smbr_dana` =  '$smbr_dana', `no_aset` =  '$no_aset', `smbr_dana` =  '$smbr_dana' WHERE  `kd_barang` ='$kd_barang'")  or die (mysql_error());
			$update_alat = mysql_query("UPDATE  `alat` SET `tahun` =  '2014',`nama` =  '$nama', `merk` =  '$merk', `spec` =  '$spec', `tahun` =  '$tahun', `jumlah` =  '$jumlah', `satuan` =  '$satuan', `kondisi` =  '$kondisi', `harga` =  '$harga', `smbr_dana` =  '$smbr_dana', `no_aset` =  '$no_aset', `id_dep` = '$id_dep' WHERE  `kd_barang` ='$kd_barang'")  or die (mysql_error());
			$update_ma = mysql_query("INSERT INTO `transaksi_ma` VALUES('', '$kd_barang', '$kondisi', '$tgl_masuk')") or die (mysql_error());
			if($update_alat == true && $update_ma == true ){
				?>
					<script>
					function Redirect(){
						window.location = "tambah_data.php?act=daftar&type=ab";
					}
					window.alert("Data Alat dan Bahan Berhasil Diubah ");
					setTimeout('Redirect()', 100);
					
					</script>
				<?php
				
			}
		}else if(($edit_data=="edit_bahan") && ($kd_barang!="") && ($nama!="") && ($merk!="") && ($tahun!="")&& ($jumlah!="") && ($satuan!="") && ($kondisi!="") && ($harga!="") && ($smbr_dana!="") && ($tgl_masuk!="") && ($id_dep!="")){
			$update_bahan = mysql_query("UPDATE `bahan` SET  `nama` =  '$nama',`tahun` =  '$tahun', `jumlah` =  '$jumlah', `satuan` =  '$satuan', `id_dep` =  '$id_dep' WHERE  `kd_bahan` ='$kd_barang'")  or die (mysql_error());
			$update_bahan = mysql_query("UPDATE `transaksi_mb` SET  `kd_bahan` =  '$kd_barang', `merk` =  '$merk', `tahun` =  '$tahun', `satuan` =  '$satuan', `tgl_masuk` =  '$tgl_masuk', `harga` =  '$harga', `smbr_dana` =  '$smbr_dana' WHERE  `kd_bahan` ='$kd_barang'")  or die (mysql_error());
			
			if($update_bahan == true && $update_bahan == true ){
				?>
					<script>
					function Redirect(){
						window.location = "tambah_data.php?act=daftar&type=bhp";
					}
					window.alert("Data Bahan Habis Pakai Berhasil Diubah ");
					setTimeout('Redirect()', 100);
					
					</script>
				<?php
				
			}
		}else{
			echo "Data Tidak Valid !";
		}
		
	}
?>
	  