
<?php
	
	if(isset($_POST['tambah_data'])){
		
		extract($_POST);

		if($type_form =="alat"){
			if(($kd_barang !="") && ($nama !="") && ($merk !="") && ($spec !="") && ($tahun !="") && ($jumlah !="") && ($satuan !="") && ($tgl_masuk !="") && ($kondisi !="") && ($harga !="") && ($smbr_dana !="") && ($no_aset !="") && ($id_dep !="")){
				$query=mysql_num_rows(mysql_query("SELECT * FROM alat where kd_barang='$kd_barang'"));
				if($query !=0){
					$query=mysql_query("UPDATE alat SET kondisi='$kondisi' where kd_barang='$kd_barang'");
				}else{
					$query = mysql_query("INSERT into alat VALUES('','$kd_barang','$nama','$merk','$spec','$tahun','$jumlah','$satuan','$kondisi','$harga','$smbr_dana','$no_aset','$id_dep') ") or die (mysql_error());
				}

				$query = mysql_query("INSERT into transaksi_ma VALUES('','$kd_barang','$kondisi', '$tgl_masuk') ") or die (mysql_error());
				
				if($query){
				?>
					<div class="alert alert-success"><b>Sukses!</b> Data Alat Berhasil Ditambahkan.</div>
					<script type="text/javascript">
						//window.alert("data berhasil dimasukkan");
						
					</script>
				<?php
				}
			}  else{
			?>
				<div class="alert alert-warning"><b>Data Harus Diisi, Cek Kembali</b></div>
				<script type="text/javascript">
						//window.alert("Data Harus Diisi Semua, Cek Kembali");
				</script>
			<?php
			} 
		
		}else if($type_form =="bahan"){
			if(($kd_bahan !="") && ($nama !="") && ($merk !="") && ($tahun !="") && ($jumlah !="") && ($satuan !="") && ($tgl_masuk !="") && ($harga !="") && ($smbr_dana !="") && ($id_dep !="")){

				$query = mysql_num_rows(mysql_query("SELECT * from bahan where kd_bahan= '$kd_bahan'"));
				
				if($query != 0){
					$query=mysql_query("UPDATE bahan SET jumlah=jumlah+'$jumlah' where kd_bahan='$kd_bahan'");
				}else{
					$query = mysql_query("INSERT into bahan VALUES('','$kd_bahan','$nama','$tahun','$jumlah','$satuan','$id_dep') ") or die (mysql_error());
				}
				
				$query = mysql_query("INSERT into transaksi_mb VALUES('','$kd_bahan','$merk','$tahun','$jumlah','$satuan','$tgl_masuk','$harga','$smbr_dana','$id_dep') ") or die (mysql_error());
				if($query){
				?>
				<div class="alert alert-success"><b>Sukses!</b> Data Bahan Berhasil Ditambahkan.</div>
					
				<?php
				}
			}  else{
			?>
				<div class="alert alert-warning"><b>Data Harus Diisi, Cek Kembali</b></div>
				
			<?php
			} 
		}
	
	
	} 
	
?>


<?php
	require("../config/config.php");
	switch($type){
		case 'alat';
		?>
			<h3> Tambah Data Alat / Barang</h3><br>

	<!-- awal import -->
			<?php
require "excel_reader2.php";
 
//jika tombol import ditekan
if(isset($_POST['submit'])){
 
    $target = basename($_FILES['filetabel_alat']['name']) ;
    move_uploaded_file($_FILES['filetabel_alat']['tmp_name'], $target);
    
    $data = new Spreadsheet_Excel_Reader($_FILES['filetabel_alat']['name'],false);
    
//    menghitung jumlah baris file xls
    $baris = $data->rowcount($sheet_index=0);
    
//    jika kosongkan data dicentang jalankan kode berikut
    if($_POST['drop']==1){
//             kosongkan tabel tabel_kompetensi
             $truncate ="TRUNCATE TABLE alat";
             $c ="TRUNCATE TABLE transaksi_ma";
             mysql_query($truncate);
              mysql_query($c);
    };
    
//    import data excel mulai baris ke-2 (karena tabel xls ada header pada baris 1)
    for ($i=2; $i<=$baris; $i++)
    {
//       membaca data (kolom ke-1 sd terakhir)
     $kd_barang = $data->val($i,1);
 //membaca data nama depan (kolom ke-2)
     $nama = $data->val($i,2);
     //membaca data nama belakang (kolom ke-3)
     $merk = $data->val($i,3);
     $spec = $data->val($i,4);
     $tahun = $data->val($i,5);
     $jumlah = $data->val($i,6);
     $satuan = $data->val($i,7);
     $kondisi = $data->val($i,8);
     $harga = $data->val($i,9);
     $smbr_dana = $data->val($i,10);
     $no_aset = $data->val($i,11);
     $id_dep = $data->val($i,12);
     $tgl_masuk = $data->val($i,13);
 
//      setelah data dibaca, masukkan ke tabel tabel_kompetensi sql
      $a = "INSERT into alat VALUES('','$kd_barang','$nama','$merk','$spec','$tahun','$jumlah','$satuan','$kondisi','$harga','$smbr_dana','$no_aset','$id_dep') ";
      $query = "INSERT into transaksi_ma VALUES('','$kd_barang','$kondisi', '$tgl_masuk') ";
      $hasil = mysql_query($a);
      $hasil = mysql_query($query);
    }
    
    if(!$hasil){
//          jika import gagal
          die(mysql_error());
      }else{
//          jika impor berhasil
          echo "Data berhasil dimasukkan.";
    }
    
//    hapus file xls yang udah dibaca
    unlink($_FILES['filetabel_alat']['name']);
}
 
?>
	<h4>Import Data Alat. Pastikan field sesuai</h4>
	<form name="form_import" id="form_import" onSubmit="return validateForm()" action="tambah_data.php?act=tambah&type=alat" method="post" enctype="multipart/form-data">
    <input type="file" id="filetabel_alat" name="filetabel_alat" />
    <input type="submit" name="submit" value="Import" /><br/>
    <label><input type="checkbox" name="drop" value="1" /> <u>Kosongkan tabel sql terlebih dahulu.</u> </label>
</form>
 
<script type="text/javascript">
//    validasi form (hanya file .xls yang diijinkan)
    function validateForm()
    {
        function hasExtension(inputID, exts) {
            var fileName = document.getElementById(inputID).value;
            return (new RegExp('(' + exts.join('|').replace(/\./g, '\\.') + ')$')).test(fileName);
        }
 
        if(!hasExtension('filetabel_alat', ['.xls'])){
            alert("Anda belum memilih file. Hanya file XLS (Excel 2003) yang diijinkan.");
            return false;
        }
    }
</script>
		<!-- akhir import -->

			<br><br>
			<form class="form-horizontal" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" style="width:35%"  >
			<input type="hidden" value="alat" name="type_form" />
			<div class="control-group">	
			<label class="control-label" for="inputkodebarang">Kode Alat/Barang</label>
			<div class="controls">
			  <input type="text" name="kd_barang" id="kd_barang_register" required="true" value="<?php if(isset($_POST['kd_barang'])){ echo $_POST['kd_barang']; } ?>" placeholder="Kode Barang" style="height:30px; width:400px !important">
			</div>
		  </div>
		   <div class="control-group">
			<label class="control-label" for="inputNama">Nama</label>
			<div class="controls">
			  <input type="text" id="inputNama" name="nama" required="true" value="<?php if(isset($_POST['nama'])){ echo $_POST['nama']; } ?>" placeholder="Nama" style="height:30px; width:400px !important">
			</div>
		  </div>
			<div class="control-group">
			<label class="control-label" for="inputmerk">Merk</label>
			<div class="controls">
			  <input type="text" id="inputMerk" name="merk" required="true" value="<?php if(isset($_POST['merk'])){ echo $_POST['merk']; } ?>" placeholder="Merk" style="height:30px; width:400px !important">
			</div>
		  </div>

		   <div class="control-group">
			<label class="control-label" for="inputspec">Spesifikasi</label>
			<div class="controls">
			  <textarea name="spec" placeholder="spesifikasi" required="true" value="<?php if(isset($_POST['spec'])){ echo $_POST['spec']; } ?>" rows="10" style="width:400px !important"></textarea> 
			</div>
		  </div>

		  <div class="control-group">
			<label class="control-label" for="inputkondisi">Tahun</label>
			<div class="controls">
				<select class="form-control" name="tahun" id="input tahun" required="true" value="<?php if(isset($_POST['tahun'])){ echo $_POST['tahun']; } ?>" style="width:400px !important">
				<option selected="selected">Tahun</option>
				<?php
				for($i=date('Y'); $i>=date('Y')-32; $i-=1){
				echo"<option value='$i'> $i </option>";
				}
				?>
				</select>
			</div>
		  </div>
		   <div class="control-group">
			<label class="control-label" for="inputJumlah">Jumlah</label>
			<div class="controls">
			  <input type="number" min="1" max="1"  id="inputJumlah" name="jumlah" required="true" value="<?php if(isset($_POST['jumlah'])){ echo $_POST['jumlah']; } ?>" placeholder="Jumlah" style="height:30px; width:400px !important">
			  <p><span> Jumlah inventaris alat = 1 </span></p>
			</div>
		  </div>
		  <div class="control-group">
			<label class="control-label" for="inputsatuan">Satuan</label>
			<div class="controls">
					<select class="form-control" name="satuan" id="search-option" required="true" value="<?php if(isset($_POST['satuan'])){ echo $_POST['satuan']; } ?>" style="width:400px !important">
					<option value="buah">Buah</option>
					<option value="set">Set</option>
					<option value="rim">Rim</option>
					<option value="meter">Meter</option>
					</select>
			</div>
		  </div>
		  <div class="control-group">
			<label class="control-label" for="inputm">Tanggal Masuk</label>
			<div class="controls">
			  <input type="date" name="tgl_masuk" id="inputm" required="true" value="<?php if(isset($_POST['tgl_masuk'])){ echo $_POST['tgl_masuk']; }else{echo date('Y-m-d');} ?>" placeholder="Tanggal Masuk" style="height:30px; width:400px !important">
			</div>
		  </div>
		  <div class="control-group">
			<label class="control-label" for="inputkondisi">Kondisi</label>
			<div class="controls">
					<select class="form-control" name="kondisi" id="search-option" required="true" value="<?php if(isset($_POST['kondisi'])){ echo $_POST['kondisi']; } ?>" style="width:400px !important">
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
			  <input type="number" type="number" min="1" id="inputharga" name="harga" required="true" value="<?php if(isset($_POST['harga'])){ echo $_POST['harga']; } ?>" placeholder="Harga" style="height:30px; width:400px !important">
			</div>
		  </div>
		   <div class="control-group">
			<label class="control-label" for="inputsd">Sumber Dana</label>
			<div class="controls">
			  <input type="text" id="inputsd" name="smbr_dana" required="true" value="<?php if(isset($_POST['smbr_dana'])){ echo $_POST['smbr_dana']; } ?>" placeholder="Sumber Dana" class="form-control" rows="3" style="width:400px !important"> 
			</div>
		  </div>
		   
		   <div class="control-group">
			<label class="control-label" for="inputaset">No Aset</label>
			<div class="controls">
			  <input type="text" name="no_aset" id="inputaset" required="true" value="<?php if(isset($_POST['no_aset'])){ echo $_POST['no_aset']; } ?>" placeholder="No Aset" style="height:30px; width:400px !important">
			</div>
		  </div>
		 
		  <div class="control-group" id="ruangan">
			<label class="control-label" for="inputruang">Ruangan</label>
			<div class="controls">
					<select class="form-control" name="id_dep" id="inputRuang" required="true" value="<?php if(isset($_POST['id_dep'])){ echo $_POST['id_dep']; } ?>" style="width:400px !important">
					<?php
					$query=mysql_query("SELECT * FROM kantor");
					while ($h=mysql_fetch_array($query)) {
						echo "<option value=$h[id_dep]>$h[nama]</option>";
					}
					?>
					</select>
			</div>
			</div>
		  <div class="controls">
		<!--  <div class="form-actions"> -->
		  <button type="submit" class="btn btn-primary" name="tambah_data" value="simpan">Simpan</button>
		   <button type="button" class="btn btn-default" id="reset_btn">Reset</button>
		<!-- </div> -->
		</div>
		</form>
		
		


		<?php
		break;
		case 'bahan';
		?>
			<h3> Tambah Data Bahan Habis Pakai</h3><br>

			<!-- awal import -->
			<?php
require "excel_reader2.php";
 
//jika tombol import ditekan
if(isset($_POST['submit'])){
 
    $target = basename($_FILES['filetabel_bahan']['name']) ;
    move_uploaded_file($_FILES['filetabel_bahan']['tmp_name'], $target);
    
    $data = new Spreadsheet_Excel_Reader($_FILES['filetabel_bahan']['name'],false);
    
//    menghitung jumlah baris file xls
    $baris = $data->rowcount($sheet_index=0);
    
//    jika kosongkan data dicentang jalankan kode berikut
    if($_POST['drop']==1){
//             kosongkan tabel tabel_kompetensi
             $truncate ="TRUNCATE TABLE bahan";
             $b ="TRUNCATE TABLE transaksi_mb";
             mysql_query($truncate);
              mysql_query($b);
    };
    
//    import data excel mulai baris ke-2 (karena tabel xls ada header pada baris 1)
    for ($i=2; $i<=$baris; $i++)
    {
//       membaca data (kolom ke-1 sd terakhir)
     $kd_bahan = $data->val($i,1);
	 //membaca data nama depan (kolom ke-2)
	 $nama = $data->val($i,2);
	 //membaca data nama belakang (kolom ke-3)
	 $tahun = $data->val($i,3);
	 $jumlah = $data->val($i,4);
	 $satuan = $data->val($i,5);
	 $id_dep = $data->val($i,6);
	 $merk = $data->val($i,7);
	 $tgl_masuk = $data->val($i,8);
	 $harga = $data->val($i,9);
	 $smbr_dana = $data->val($i,10);
 
//      setelah data dibaca, masukkan ke tabel tabel_kompetensi sql
      $query = "INSERT into bahan VALUES('','$kd_bahan','$nama','$tahun','$jumlah','$satuan','$id_dep') ";
	  $a = "INSERT into transaksi_mb VALUES('','$kd_bahan','$merk','$tahun','$jumlah','$satuan','$tgl_masuk','$harga','smbr_dana','$id_dep')";
      $hasil = mysql_query($a);
      $hasil = mysql_query($query);
    }
    
    if(!$hasil){
//          jika import gagal
          die(mysql_error());
      }else{
//          jika impor berhasil
          echo "Data berhasil dimasukkan.";
    }
    
//    hapus file xls yang udah dibaca
    unlink($_FILES['filetabel_bahan']['name']);
}
 
?>
	<h4>Import Data Alat. Pastikan field sesuai</h4>
	<form name="form_import" id="form_import" onSubmit="return validateForm()" action="tambah_data.php?act=tambah&type=bahan" method="post" enctype="multipart/form-data">
    <input type="file" id="filetabel_bahan" name="filetabel_bahan" />
    <input type="submit" name="submit" value="Import" /><br/>
    <label><input type="checkbox" name="drop" value="1" /> <u>Kosongkan tabel sql terlebih dahulu.</u> </label>
</form>
 
<script type="text/javascript">
//    validasi form (hanya file .xls yang diijinkan)
    function validateForm()
    {
        function hasExtension(inputID, exts) {
            var fileName = document.getElementById(inputID).value;
            return (new RegExp('(' + exts.join('|').replace(/\./g, '\\.') + ')$')).test(fileName);
        }
 
        if(!hasExtension('filetabel_bahan', ['.xls'])){
            alert("Anda belum memilih file. Hanya file XLS (Excel 2003) yang diijinkan.");
            return false;
        }
    }
</script>
		<!-- akhir import -->

			<br><br>
			<form class="form-horizontal" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" style="width:35%">
			
			<input type="hidden" value="bahan" name="type_form" />
			<div class="control-group">	
			<label class="control-label" for="inputkdbahan">Kode Bahan</label>
			<div class="controls">
			  <input type="text" name="kd_bahan" id="kd_bahan_register" required="true" value="<?php if(isset($_POST['kd_bahan'])){ echo $_POST['kd_bahan']; } ?>" placeholder="Kode Bahan" style="height:30px; width:400px !important">
			</div>
		  </div>
		   <div class="control-group">
			<label class="control-label" for="inputNama">Nama</label>
			<div class="controls">
			  <input type="text" id="inputNama" name="nama" required="true" value="<?php if(isset($_POST['nama'])){ echo $_POST['nama']; } ?>" placeholder="Nama" style="height:30px; width:400px !important">
			</div>
		  </div>
		  <div class="control-group">
			<label class="control-label" for="inputmerk">Merk</label>
			<div class="controls">
			  <input type="text" id="inputMerk" name="merk" required="true" value="<?php if(isset($_POST['merk'])){ echo $_POST['merk']; } ?>" placeholder="Merk" style="height:30px; width:400px !important">
			</div>
		  </div>
		   <div class="control-group">
			<label class="control-label" for="inputkondisi">Tahun</label>
			<div class="controls">
				<select class="form-control" name="tahun" id="input tahun" required="true" value="<?php if(isset($_POST['tahun'])){ echo $_POST['tahun']; } ?>" style="width:400px !important">
				<option selected="selected">Tahun</option>
				<?php
				for($i=date('Y'); $i>=date('Y')-32; $i-=1){
				echo"<option value='$i'> $i </option>";
				}
				?>
				</select>
			</div>
		  </div>
		   <div class="control-group">
			<label class="control-label" for="inputJumlah">Jumlah</label>
			<div class="controls">
			  <input type="number" type="number" min="1" id="inputJumlah" name="jumlah" required="true" value="<?php if(isset($_POST['jumlah'])){ echo $_POST['jumlah']; } ?>" placeholder="Jumlah" style="height:30px; width:400px !important">
			</div>
		  </div>
		  <div class="control-group">
			<label class="control-label" for="inputsatuan">Satuan</label>
			<div class="controls">
					<select class="form-control" name="satuan" id="search-option" required="true" value="<?php if(isset($_POST['satuan'])){ echo $_POST['satuan']; } ?>" style="width:400px !important">
					<option value="buah">Buah</option>
					<option value="set">Set</option>
					<option value="rim">Rim</option>
					<option value="meter">Meter</option>
					</select>
			</div>
		  </div>
		  <div class="control-group">
			<label class="control-label" for="inputm">Tanggal Masuk</label>
			<div class="controls">
			  <input type="date" name="tgl_masuk" id="inputm" required="true" value="<?php if(isset($_POST['tgl_masuk'])){ echo $_POST['tgl_masuk']; }else{echo date('Y-m-d');} ?>" placeholder="Tanggal Masuk" style="height:30px; width:400px !important">
			</div>
		  </div>
			 <div class="control-group">
			<label class="control-label" for="inputharga">Harga</label>
			<div class="controls">
			  <input type="number" type="number" min="1" id="inputharga" name="harga" required="true" value="<?php if(isset($_POST['harga'])){ echo $_POST['harga']; } ?>" placeholder="Harga" style="height:30px; width:400px !important">
			</div>
		  </div>
		   <div class="control-group">
			<label class="control-label" for="inputsd">Sumber Dana</label>
			<div class="controls">
			  <input type="text" id="inputsd" name="smbr_dana" required="true" value="<?php if(isset($_POST['smbr_dana'])){ echo $_POST['smbr_dana']; } ?>" placeholder="Sumber Dana" class="form-control" rows="3" style="width:400px !important">
			</div>
		  </div>
		  <div class="control-group" id="ruangan">
			<label class="control-label" for="inputruang">Ruangan</label>
			<div class="controls">
					<select class="form-control" name="id_dep" id="inputRuang" required="true" value="<?php if(isset($_POST['id_dep'])){ echo $_POST['id_dep']; } ?>" style="width:400px !important">
					<?php
					$query=mysql_query("SELECT * FROM kantor");
					while ($h=mysql_fetch_array($query)) {
						echo "<option value=$h[id_dep]>$h[nama]</option>";
					}
					?>
					</select>
			</div>
			</div>
		  <div class="controls">
		<!--  <div class="form-actions"> -->
		  <button type="submit" class="btn btn-primary" name="tambah_data" value="simpan">Simpan</button>
		  <button type="button" class="btn btn-default" id="reset_btn">Reset</button>
		<!-- </div> -->
		</div>
		</form>

		<?php
		break;
		default:
		
	}
?>

<!-- Javascrip reset form val=null -->
<script type="text/javascript">
$("#reset_btn").on("click",function(){
	$("#kd_barang_register").val("");
	$("#inputNama").val("");
	$("#inputMerk").val("");
	$("#inputSpec").val("");
	$("#inputtahun").val("");
	$("#inputJumlah").val("");
	$("#inputharga").val("");
	$("#inputsd").val("");
	$("#inputaset").val("");
	$("#inputRuang").val("");
	$("#kd_bahan_register").val("");
	$("#inputlt").val("");
	$("#inputm").val("");
});
</script>
