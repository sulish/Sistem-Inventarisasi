<?php
	session_start();
	require("../config/config.php");
	if(isset($_SESSION['username']) && isset($_SESSION['type']) ){
	require("../includes/admin_header.php"); 
	require("../includes/admin_sidebar.php");
?>
	  
		<div class="content-block">
		
		<h2>Tambah Informasi</h2>
		<?php
                if(isset($_POST['submit']))
				{
				$judul=$_POST['judul'];
				$isi=$_POST['isi'];

				if($judul=="" || $isi=="")
				{
					?>
				<div class="alert alert-warning"><b>Data Yang Anda Masukkan Kurang Lengkap</b></div>
				<?php
				}
				else{
				mysql_query("insert into berita values('','$judul','$isi')") or die (mysql_error());

				?>
				<div class="alert alert-success"><b>Sukses!</b> Data Berita Berhasil Ditambahkan.</div>
				<?php
				}
 
			}
?>
		<form class="form-horizontal" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" style="width:35%">
    <div class="control-group"> 
    <label class="control-label" for="inputjudul">Judul</label>
    <div class="controls">
      <input type="text" id="inputjudul" name='judul'  placeholder="judul" style="height:30px; width:500px !important">
    </div>
  </div>
  <div class="control-group">
			<label class="control-label" for="inputisi">Isi</label>
			<div class="controls">
			  <textarea name="isi" placeholder="isi" class="form-control" rows="10" style="width:500px !important"></textarea> 
			</div>
		  </div>

  <div class="controls">
<!--  <div class="form-actions"> -->
  <button type="submit" class="btn btn-primary" name="submit" value="Tambah">Tambah</button>
  <button type="button" class="btn">Batal</button>
<!-- </div> -->
</div>
</form>
		</div>
		
		</div>

	</body>
</html>

<?php
	 }else{
	 	header("location:../masuk.php");

	}
?>

