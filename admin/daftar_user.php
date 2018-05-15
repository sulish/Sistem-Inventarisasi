
<div class="content-block">
<?php
	// error_reporting(0);
	require("../config/config.php");
	switch($type){
		case 'mhs';
?>

<?php
  if(isset($_POST['cari'])){
       $sql=mysql_query("SELECT * from mhs where nama like '%$_POST[cari]%' or nim like '%$_POST[cari]%' or sex like '%$_POST[cari]%' or ttl like '%$_POST[cari]%' 
        or alamat like '%$_POST[cari]%' or prodi like '%$_POST[cari]%' or angkatan like '%$_POST[cari]%' or kelas like '%$_POST[cari]%' 
        or email like '%$_POST[cari]%' or tlp like '%$_POST[cari]%' order by nama asc");
}else{
  $sql=mysql_query("SELECT * from mhs order by nama asc");
}
?>

		<h2>Daftar User Mahasiswa SYSIN TE-UM</h2><br><br>
    <form class="form-inline" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" style="width:35%">
    <input type="hidden" value="bahan" name="type_form" />
      <div class="control-group" style="height: 50px;"> 
        <label class="control-label" >Pencarian </label>
      <div class="controls">
        <input type="text" name="cari" value="Masukkan Kata Kunci" size="35" onclick="this.value=''"  style="height:30px; width:250px">
        <button type="submit" class="btn" name="search" >Cari</button>
      </div>
      </div>
    </form>

      <!-- Cetak dan Simpan -->
      <p class='pull-right'>
      <a href='export/daftar_mhs_xls.php'
      target='_blank'
      class="btn" ><i class='icon-download-alt'></i> Excel</a>
      <a href='export/daftar_mhs_cetak.php'
      target='_blank'
      class="btn" ><i class='icon-print'></i>cetak</a>
      </p>

  <div style="width:100%;height:500px;overflow-y:scroll;overflow-x:scroll;">
  <table class="table table-bordered table-striped table-condensed" >
        <thead>
          <tr >
          <th>Nama</th>
          <th>NIM</th>
          <th>Jenis Kelamin</th>
          <th>Jurusan</th>
          <th>Email</th>
          <th>Telepon</th>
          <th colspan="2">Action</th>
        </tr>
      </thead>
    <tbody>

  <?php
    while($mhs=mysql_fetch_array($sql)){
  ?>
    <tr>
      <td><?php echo $mhs['nama'];?></td>
      <td><?php echo $mhs['nim'];?></td>
      <td><?php echo $mhs['sex'];?></td>
      <td><?php echo $mhs['prodi'];?> / <?php echo $mhs['angkatan'];?> / <?php echo $mhs['kelas'];?></td>
      <td><?php echo $mhs['email'];?></td>
      <td><?php echo $mhs['tlp'];?></td>
      <td> <a href="?act=edit&type=mhs&id=<?php echo $mhs['id_mem']; ?>"  title="Click to Edit"> <span class="icon-pencil " title="Edit Post"></span></a> </td>
      <td> <a href="?act=delete&type=mhs&id=<?php echo $mhs['id_mem']; ?>" onclick = "return confirm ('Anda yakin ingin menghapus data user <?=$mhs['nama'];?>?')" title="Click to Delete" class="delete"><span class="icon-trash " title="Delete Post"></span></a></td>
   </tr>

     <?php
          }
          ?>
  </tbody>	
  </table>
  </div>
  

		<?php
		break;
		case 'peg';
		?>

<?php
  if(isset($_POST['cari'])){
       $y=mysql_query("SELECT * from pegawai where nama like '%$_POST[cari]%' or nip like '%$_POST[cari]%' or sex like '%$_POST[cari]%' or ttl like '%$_POST[cari]%' 
        or alamat like '%$_POST[cari]%' or jabatan like '%$_POST[cari]%' or email like '%$_POST[cari]%' or tlp like '%$_POST[cari]%' order by nama asc");
}else{
  $y=mysql_query("SELECT * from pegawai order by nama asc");
}
?>

		<h2>Daftar User Pegawai SYSIN TE-UM</h2><br><br>
    <form class="form-inline" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" style="width:35%">
    <input type="hidden" value="bahan" name="type_form" />
      <div class="control-group" style="height: 50px;"> 
        <label class="control-label" >Pencarian </label>
      <div class="controls">
        <input type="text" name="cari" value="Masukkan Kata Kunci" size="35" onclick="this.value=''"  style="height:30px; width:250px">
        <button type="submit" class="btn" name="search" >Cari</button>
      </div>
      </div>
    </form>

      <p class='pull-right'>
      <a href='export/daftar_pegawai_xls.php'
      target='_blank'
      class="btn" ><i class='icon-download-alt'></i> Excel</a>
      <a href='export/daftar_pegawai_cetak.php'
      target='_blank'
      class="btn" ><i class='icon-print'></i>cetak</a>
      </p>

  <div style="width:100%;height:500px;overflow-y:scroll;overflow-x:scroll;">
  <table class="table table-bordered table-striped table-condensed" >
        <thead>
          <tr >
            <th>Nama</th>
            <th>NIP</th>
            <th>Jenis Kelamin</th>
            <th>Jabatan</th>
            <th>Email</th>
            
            <th colspan="2">Action</th>
          </tr>
        </thead>

   <?php
    while($peg=mysql_fetch_array($y)){
  ?>
    <tr>
      <td><?php echo $peg['nama'];?></td>
      <td><?php echo $peg['nip'];?></td>
      <td><?php echo $peg['sex'];?></td>
      <td><?php echo $peg['jabatan'];?></td>
      <td><?php echo $peg['email'];?></td>
      <td> <a href="?act=edit&type=peg&id=<?php echo $peg['id_peg']; ?>"  title="Click to Edit"> <span class="icon-pencil " title="Edit Post"></span></a> </td>
      <td> <a href="?act=delete&type=peg&id=<?php echo $peg['id_peg']; ?>" onclick = "return confirm ('Anda yakin ingin menghapus data user <?=$peg['nama'];?>?')" title="Click to Delete" class="delete"><span class="icon-trash " title="Delete Post"></span></a></td>
   </tr>

     <?php
          }
          ?>
  </tbody>
  </table>
  </div>
 


		<?php
		break;
		case 'laboran';
		?>

<?php
if(isset($_POST['cari'])){
       $laboran=mysql_query("SELECT
laboran.id_lab,
laboran.nama as nama_laboran,
laboran.nip,
laboran.sex,
laboran.ttl,
laboran.alamat,
laboran.jabatan,
laboran.email,
laboran.tlp,
laboran.foto,
laboran.id_user,
laboran.id_dep,
kantor.nama as lokasi
FROM
laboran
INNER JOIN kantor ON laboran.id_dep = kantor.id_dep where laboran.nama like '%$_POST[cari]%' or laboran.nip like '%$_POST[cari]%' or laboran.sex like '%$_POST[cari]%' or laboran.ttl like '%$_POST[cari]%' 
        or laboran.alamat like '%$_POST[cari]%' or laboran.jabatan like '%$_POST[cari]%' or laboran.email like '%$_POST[cari]%' or laboran.tlp like '%$_POST[cari]%' order by laboran.nama asc") or die (mysql_error());
}else{
  $laboran=mysql_query("SELECT
laboran.id_lab,
laboran.nama as nama_laboran,
laboran.nip,
laboran.sex,
laboran.ttl,
laboran.alamat,
laboran.jabatan,
laboran.email,
laboran.tlp,
laboran.foto,
laboran.id_user,
laboran.id_dep,
kantor.nama as lokasi
FROM
laboran
INNER JOIN kantor ON laboran.id_dep = kantor.id_dep order by laboran.nama asc") or die (mysql_error());
}
?>

		<h2>Daftar User Laboran SYSIN TE-UM</h2><br><br>
	   <form class="form-inline" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" style="width:35%">
        <input type="hidden" value="bahan" name="type_form" />
      <div class="control-group" style="height: 50px;"> 
        <label class="control-label" >Pencarian </label>
      <div class="controls">
       <input type="text" name="cari" value="Masukkan Kata Kunci" size="35" onclick="this.value=''"  style="height:30px; width:250px">
        <button type="submit" class="btn" name="search" >Cari</button>
      </div>
      </div>
    </form>

      <p class='pull-right'>
      <a href='export/daftar_laboran_xls.php'
      target='_blank'
      class="btn" ><i class='icon-download-alt'></i> Excel</a>
      <a href='export/daftar_laboran_cetak.php'
      target='_blank'
      class="btn" ><i class='icon-print'></i>cetak</a>
      </p>

  <div style="width:100%;height:500px;overflow-y:scroll;overflow-x:scroll;">
  <table class="table table-bordered table-striped table-condensed" >
        <thead>
          <tr >
            <th>Nama</th>
            <th>NIP</th>
            <th>Jenis Kelamin</th>
            <th>Jabatan</th>
            <th>Email</th>
            <th>Ruang</th>
            <th colspan="2">Action</th>
          </tr>
        </thead>
        <tbody>

   <?php
    while($lab=mysql_fetch_array($laboran)){
  ?>
    <tr>
      <td><?php echo $lab['nama_laboran'];?></td>
      <td><?php echo $lab['nip'];?></td>
      <td><?php echo $lab['sex'];?></td>
      <td><?php echo $lab['jabatan'];?></td>
      <td><?php echo $lab['email'];?></td>
      <td><?php echo $lab['lokasi'];?></td>
      <td> <a href="?act=edit&type=laboran&id=<?php echo $lab['id_lab']; ?>"  title="Click to Edit"> <span class="icon-pencil " title="Edit Post"></span></a> </td>
      <td> <a href="?act=delete&type=laboran&id=<?php echo $lab['id_lab']; ?>" onclick = "return confirm ('Anda yakin ingin menghapus data user <?=$lab['nama_laboran'];?>?')" title="Click to Delete" class="delete"><span class="icon-trash " title="Delete Post"></span></a></td>
   </tr>

     <?php
          }
          ?>
  </tbody>
  </table>
  </div>



	<?php
    break;
    case 'admin';
    ?>

<?php
  $admin=mysql_query("SELECT * from admin order by nama asc");
?>


    <h2>Daftar User Administrator SYSIN TE-UM</h2><br><br>
   <!--  <p style="width:50%;"> -->
      <p class='pull-right'>
      <a href='export/daftar_admin_xls.php'
      target='_blank'
      class="btn" ><i class='icon-download-alt'></i> Excel</a>
      <a href='export/daftar_admin_cetak.php'
      target='_blank'
      class="btn" ><i class='icon-print'></i>cetak</a>
      </p>
    <table class="table table-bordered table-striped table-condensed" >
 
    <thead>
      <tr >
        <th>Nama</th>
        <th>No. ID Admin</th>
        <th>Email</th>
        <th colspan="2">Action</th>
      </tr>
  </thead>
  <tbody>

   <?php
    while($c=mysql_fetch_array($admin)){
   ?>
    <tr>
      <td><?php echo $c['nama'];?></td>
      <td><?php echo $c['nid'];?></td>
      <td><?php echo $c['email'];?></td>
      <td> <a href="?act=edit&type=admin&id=<?php echo $c['id_admin']; ?>"  title="Click to Edit"> <span class="icon-pencil " title="Edit Post"></span></a> </td>
      <td> <a href="?act=delete&type=admin&id=<?php echo $c['id_admin']; ?>" onclick = "return confirm ('Anda yakin ingin menghapus data user <?=$c['nama'];?>?')" title="Click to Delete" class="delete"><span class="icon-trash " title="Delete Post"></span></a></td>
   </tr>

     <?php
          }
          ?>
  </tbody>
  </table>
		<?php
		break;
		default:
	}
	?>
	</div>
