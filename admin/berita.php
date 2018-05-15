<?php
	session_start();
	require("../config/config.php");
	if(isset($_SESSION['username']) && isset($_SESSION['type']) ){
	require("../includes/admin_header.php"); 
	require("../includes/admin_sidebar.php");
	
	if(isset($_GET['aksi'])){
	mysql_query("DELETE FROM berita where id_berita='$_GET[id]'");
}
?>
		<div class="content-block">
		<h2>KELOLA INFORMASI SYSIN TE UM</h2>
		<form class="form-inline" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" >
	      <input type="hidden" value="alat" name="type_form" />
      	</form>
		 
		<br><div style="width:100%;height:300px;overflow-y:scroll;overflow-x:scroll;">
		<table class="table table-bordered table-striped table-condensed">
			<tr>
				<th rowspan="2">id_berita</th>
				<th rowspan="2">Judul</th>
				<th rowspan="2">Isi Berita</th>
				<th colspan="2">Action</th>
			</tr>
			<tr></tr>
		<?php
		   $query=mysql_query("SELECT * from berita order by id_berita desc");
		?>
                    <?php
                  		while($hasil=mysql_fetch_array($query)){
					?>
				<tr>
					<td><?php echo $hasil['id_berita'];?></td>
					<td><?php echo $hasil['judul'];?></td>
					<td><?php echo $hasil['isi'];?></td>
					<td> <a href="berita.php?aksi=hapus&id=<?php echo $hasil['id_berita'];?>" onclick="return confirm('Anda yakin akan menghapus berita berjudul <?=$hasil['judul'];?>?')" title="Click to Delete" class="delete"><span class="icon-trash " title="Delete Post"></span></a></td>	
				</tr>
                	<?php
					}
					?>
               
        </table>
    </div>
		</div>
		</div>

	</body>
</html>
<?php
	 }else{
	 	header("location:../masuk.php");

	}
?>

