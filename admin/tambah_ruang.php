<?php
	session_start();
	require("../config/config.php");
	if(isset($_SESSION['username']) && isset($_SESSION['type']) ){
	require("../includes/admin_header.php"); 
	require("../includes/admin_sidebar.php");
	
?>
		<div class="content-block">
		
		<h2>SELAMAT DATANG</h2>
		<h5>Anda Login Sebagai Super Admin</h5><br><br>
		<h3> Tambah Ruangan </h3>
		<?php
                if(isset($_POST['submit']))
				{
				$nama=$_POST['nama'];
				$ruang=$_POST['ruang'];
				$kategori=$_POST['kategori'];

				if($nama=="" || $ruang=="" || $kategori=="")
				{
				echo "<h5 align='right' style='border:dashed thin #FF3333; color:white; width:320px; height:40px; float:right; padding-right:9px;'>Data yang Anda masukkan kurang lengkap.</h5>";
				}
				else{
				mysql_query("insert into kantor values('','$nama','$ruang','$kategori')") or die (mysql_error());

				echo "<h4 align='right';><br>Data Ruangan Berhasil ditambahkan.</h4>";
				}
 
			}
?>
		<form class="form-horizontal" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" style="width:35%">
    <div class="control-group"> 
    <label class="control-label" for="inputnama">Nama</label>
    <div class="controls">
      <input type="text" id="inputnama" name='nama' required="true" value="<?php if(isset($_POST['nama'])){ echo $_POST['nama']; } ?>" placeholder="Nama" style="height:30px; width:400px !important">
    </div>
  </div>
<div class="control-group">
    <label class="control-label" for="inputruang">Lokasi</label>
    <div class="controls">
      <input type="text" id="inputruang" name='ruang' required="true" value="<?php if(isset($_POST['ruang'])){ echo $_POST['ruang']; } ?>" placeholder="Lokasi" style="height:30px; width:400px !important">
    </div>
  </div>
 <div class="control-group">
			<label class="control-label" for="inputkategori">Kategori</label>
			<div class="controls">
					<select class="form-control" name="kategori" id="inputkategori" value="<?php if(isset($_POST['kategori'])){ echo $_POST['kategori']; } ?>" style="width:250px !important">
					<option value="Laboratorium">Laboratorium</option>
					<option value="Ruang Kelas">Ruang Kelas</option>
					<option value="Kantor">Kantor</option>
					<option value="Lain">Lain-Lain</option>
					</select>
			</div>
		  </div>
  <div class="controls">
<!--  <div class="form-actions"> -->
  <button type="submit" class="btn btn-primary" name="submit" value="simpan">Simpan</button>
  <button type="button" class="btn btn-default" id="reset_btn">Reset</button>
<!-- </div> -->
</div>
</form>
		</div>
		
<script type="text/javascript">
$("#reset_btn").on("click",function(){
	$("#inputnama").val("");
	$("#inputruang").val("");
});
</script>
	</body>
</html>

<?php
	 }else{
	 	header("location:../masuk.php");

	}
?>
