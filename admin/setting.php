<?php
	session_start();
  require("../config/config.php");
  if(isset($_SESSION['id']) and isset($_SESSION['username'])){
	require("../includes/admin_header.php"); 
	require("../includes/admin_sidebar.php");
	
  // PROSSES gubah password dan gambar
if(isset($_POST['submit'])){
    
    $lama = md5($_POST['lama']);
    $baru = md5($_POST['baru']);
    $retype = md5($_POST['retype']);
    // $foto = $_POST['foto'];

    $tmp_file = $_FILES['fupload']['tmp_name'];
    $filetype = $_FILES['fupload']['type'];
    $filesize = $_FILES['fupload']['size'];
    $filename = $_FILES['fupload']['name'];
    
    $randString = md5(time());
    
    $splitname = explode(".", $filename);
    $fileExt = end($splitname);
    $newfilename = strtolower($splitname[0].'_'.$randString.'.'.$fileExt);
    
    $destination = '../images/foto/' . $newfilename;
    
    $gambar="";

    if(move_uploaded_file($tmp_file,$destination))
    {
      $gambar = $newfilename;
    }


    // query simpan foto berdasarkan hak akses user/session
    if($gambar!=""){
        $type = $_SESSION['type'];
		switch($type){
			case 'admin':
				$a=mysql_query ("UPDATE admin SET foto='$gambar' where id_user='$_SESSION[id]'");
			break;
			case 'laboran':
				$a=mysql_query ("UPDATE laboran SET foto='$gambar' where id_user='$_SESSION[id]'");
			break;
			case 'pegawai':
				$a=mysql_query ("UPDATE pegawai SET foto='$gambar' where id_user='$_SESSION[id]'");
			break;
			case 'mhs':
				$a=mysql_query ("UPDATE mhs SET foto='$gambar' where id_user='$_SESSION[id]'");
			break;
		}
	}

 
    if($baru != md5("")){
    	if ($baru==$retype)
    	{
        	$a=mysql_query ("UPDATE user SET password='$baru' where id_user='$_SESSION[id]'");
          ?>
          <div class="alert alert-success"><b>Password berhasil di ubah</b></div>
          <?php
        }else{
          ?>
          <div class="alert alert-warning"><b>Password Tidak Sesuai!</b></div>
        	<!-- echo "Password Not Match"; -->

          <?php
        }
    }
}
?>
<?php
    $query=mysql_query("SELECT * from user where id_user='$_SESSION[id]'");
    $hasil=mysql_fetch_array($query);

    $type = $_SESSION['type'];
    $foto=mysql_fetch_array(mysql_query("SELECT foto from $type where id_user='$_SESSION[id]'"));
?>

		<div class="content-block">
		
		<h2>PENGATURAN DATA AKUN</h2>
		<form class="form-horizontal" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data" style="width:35%" >
    <div class="control-group"> 
      <label for="username">Username<br>
      <input type="text" placeholder="Username" name="username" readonly="" class="txt-field" value="<?php if(isset($_SESSION['username'])){ echo $_SESSION['username']; } ?>" placeholder="Username" style="height:30px; width:250px !important">
      </label>
    </div>
   <div class="control-group">
    <label for="password">Password lama<br>
      <input type="password" placeholder="Change Password" name="lama" value="" class="txt-field" style="height:30px; width:250px !important"></label>
   </div>
  <div class="control-group">
    <label for="password">Password Baru<br>
      <input type="password" placeholder="Change Password" name="baru" value="" class="txt-field" style="height:30px; width:250px !important"></label>
  </div>
   <div class="control-group">
    <label for="password_repeat">Ulangi Password Baru<br>
    <input type="password" placeholder="Change Repeat Password" name="retype" value="" class="txt-field " style="height:30px; width:250px !important"><br></label>
  </div>
<div class="control-group">
    <label for="feature_post">Ubah Foto Profile <br>
    <input type="file" name="fupload"/><br /><img src="../images/foto/<?php if(isset($foto['foto']) and $foto['foto']!= ''){ echo $foto['foto'];}else{ echo "user.png";}?>" width="100" height="100" style="height:100px; width:100px !important"><br></label> 
</div>
 
  <div class="controls-group">
<!--  <div class="form-actions"> -->
  <label for="submit"><br><input type="submit" name="submit" value="Ubah" class="buttone"><br></label>
<!-- </div> -->
</div>
</form>
		</div>
		
		</div>

	</body>
</html>
<?php }else{
  header("location:../index.php");
  }
?>