<?php
	session_start();
	require("../config/config.php");
	if(isset($_SESSION['username']) && isset($_SESSION['type']) ){
	require("../includes/admin_header.php"); 
	require("../includes/admin_sidebar.php");
	
	
?>

<?php
	if(isset($_GET['aksi']) and $_GET['aksi']== 'reset'){

		$password=md5($_GET['password']);


		mysql_query("UPDATE user SET password='$password' where id_user='$_GET[id]'");
		?>
		<div class="alert alert-success"><b>Sukses!</b> Password di Reset Sesuai Username</div>
		<?php
	}
	
?>

	  
		<div class="content-block">
		
		<h2>RESET PASSWORD USER</h2>
		<form class="form-inline" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" >
	      <input type="hidden" value="alat" name="type_form" />
	      <div class="control-group" style="height: 50px;"> 
	      <label class="control-label" >Pencarian</label>
	      <div class="control-group" style="height: 50px;">
  			<input type="text" name="cari"  size="35" placeholder="Ketikkan kata kunci"  style="height:30px; width:250px">
	  		<button type="submit" class="btn" name="search" >Cari</button>
           </div>
    	</div>
      	</form>
		 
		<br><div style="width:100%;height:300px;overflow-y:scroll;overflow-x:scroll;">
		<table class="table table-bordered table-striped table-condensed">
	<?php
		if(isset($_POST['cari'])){
       $query=mysql_query("SELECT * from user where username like '%$_POST[cari]%' order by id_user asc");

   }else{
   	$query=mysql_query("SELECT * from user order by id_user asc");
   }
    ?>
			<tr>
				<th rowspan="2">id_user</th>
				<th rowspan="2">Username</th>
				<th rowspan="2">Password</th>
				<th colspan="2">Action</th>
			</tr>
			<tr></tr>
			<?php
                  		while($hasil=mysql_fetch_array($query)){
					?>
			<tr>

				<td><?php echo $hasil['id_user'];?></td>
				<td align="left"><?php echo $hasil['username'];?></td>
				<td><?php echo $hasil['password'];?></td>
				<td> <a href="reset_pass.php?aksi=reset&id=<?php echo $hasil['id_user'];?>&password=<?php echo $hasil['username'];?>" onclick = "return confirm ('Anda yakin ingin me-reset akun dengan username <?=$hasil['username'];?>?')" title="Click to Reset class="reset"" name="reset">Reset</a></td>
			</tr>

			<?php
					}
					?>
		</table>
	</div>
		</div>

	<?php
	 }else{
	 	header("location:../masuk.php");

	}
?>

