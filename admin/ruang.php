<?php
	session_start();
	require("../config/config.php");
	if(isset($_SESSION['username']) && isset($_SESSION['type']) ){
	require("../includes/admin_header.php"); 
	require("../includes/admin_sidebar.php");
	
	
?>
<?php
	if(isset($_GET['aksi']) and $_GET['aksi']=='edit'){
		$id=$_POST['id'];
		$nama=$_POST['nama'];
		$ruang=$_POST['ruang'];
		$kategori=$_POST['kategori'];

		if($nama=="" || $ruang=="" || $kategori=="")
		{
		echo "<h5 align='right' style='border:dashed thin #FF3333; color:white; width:320px; height:40px; float:right; padding-right:9px;'>Data yang Anda masukkan kurang lengkap.</h5>";
		}
		else{
		mysql_query("UPDATE kantor SET nama='$nama', ruang='$ruang', kategori='$kategori' where id_dep='$id'");
		?>
		<div class="alert alert-success"><b>Sukses!</b> Data Ruang Berhasil Ditambahkan.</div>
		<?php
		}
	}
	if(isset($_GET['aksi']) and $_GET['aksi']=='hapus'){
	mysql_query("DELETE FROM kantor where id_dep='$_GET[id]'");
	}

	$query=mysql_query("SELECT * from kantor order by id_dep asc");
?>

	  
		<div class="content-block">
		
		<h2>DAFTAR RUANGAN JURUSAN TEKNIK ELEKTRO</h2>
		<div class="content">
		 <p class='pull-right'>
		  <a href='export/daftar_ruang_xls.php'
		  target='_blank'
		  class="btn" ><i class='icon-download-alt'></i> Excel</a>
		  <a href='export/daftar_ruang_cetak.php'
		  target='_blank'
		  class="btn" ><i class='icon-print'></i>cetak</a>
		  </p>
		  
		  <form class="form-inline" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" >
	      <input type="hidden" value="alat" name="type_form" />
      	</form>
		<table class="table table-bordered table-striped table-condensed">
			<tr>
				<th rowspan="2">id_dep</th>
				<th rowspan="2">Nama</th>
				<th rowspan="2">Ruang</th>
				<th rowspan="2">Kategori</th>
				<th colspan="2">Action</th>
			</tr>
			<tr></tr>
			<?php
                  		while($hasil=mysql_fetch_array($query)){
					?>
			<tr>

				<td><?php echo $hasil['id_dep'];?></td>
				<td align="left"><?php echo $hasil['nama'];?></td>
				<td><?php echo $hasil['ruang'];?></td>
				<td><?php echo $hasil['kategori'];?></td>
				<td> <a href="edit_ruang.php?aksi=edit&id=<?php echo $hasil['id_dep'];?>" id="link_login" title="Click to Edit"> <span class="icon-pencil " title="Edit Post"></span></a> </td>
				<td> <a href="ruang.php?aksi=hapus&id=<?php echo $hasil['id_dep'];?>" onclick = "return confirm ('Anda yakin ingin menghapus Ruang<?=$hasil['nama'];?>?')" title="Click to Delete" class="delete"><span class="icon-trash " title="Delete Post"></span></a></td>
						
			</tr>

			<?php
					}
					?>
		</table>
		</div>
		<?php
	 }else{
	 	header("location:../masuk.php");

	}
?>

