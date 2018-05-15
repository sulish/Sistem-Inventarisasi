<?php
	session_start();
	require("../includes/admin_header.php"); 
	require("../includes/admin_sidebar.php");
	require("../config/config.php");
	
?>
<?php
	$query=mysql_query("SELECT * from kantor where id_dep=$_GET[id]");
	$y=mysql_fetch_array($query);

?>
	  
		<div class="content-block">
		
		<h3> Edit Ruangan Jurusan Teknik Elektro FT UM </h3>
        <form action="ruang.php?aksi=edit" method="post" enctype="multipart/form-data">
        <div class="modal-body">
        <input name="id" type="hidden" size="50" value="<?=$_GET['id']?>" />
           <div class="control-group">
			<label class="control-label" for="inputNama">Nama</label>
			<div class="controls">
			<input type="text" name="nama" value="<?php echo $y['nama'];?>" placeholder="Nama" style="height:30px; width:250px !important">
			</div>
		  </div>
		   <div class="control-group">
			<label class="control-label" for="inputNama">Ruang</label>
			<div class="controls">
			<input type="text" name="ruang" value="<?php echo $y['ruang'];?>" placeholder="Nama" style="height:30px; width:250px !important">
			</div>
		  </div>
		  <div class="control-group">
			<label class="control-label" for="inputNama">Kategori</label>
			<div class="controls">
            <select class="form-control" name="kategori" id="search-option" value="<?php echo $y['kategori'];?>">
            <option value="Laboratorium">Laboratorium</option>
            <option value="Ruang Kelas">Ruang Kelas</option>
             <option value="Kantor">Kantor</option>
             <option value="Lain">Lain-Lain</option>
           
            </select>
            </div>
            </div>
            <br><p>
			  <button class="btn btn-success" type="submit">Simpan</button>
			</p>
            </div>
            </form>
            </div>
