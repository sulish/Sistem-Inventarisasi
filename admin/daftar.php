<div class="content-block">
<?php
	require("../config/config.php");
	switch($type){
    // case alat
		case 'ab'; 
?>

		<h2>Data Inventarisasi Alat dan Barang Jurusan Teknik Elektro</h2><br><br>
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
  <a href='export/daftar_alat_xls.php'
  target='_blank'
  class="btn" ><i class='icon-download-alt'></i> Excel</a>
  <a href='export/daftar_alat_cetak.php'
  target='_blank'
  class="btn" ><i class='icon-print'></i>cetak</a>
  </p>

<?php

if(isset($_POST['cari'])){
       $hasil=mysql_query("SELECT alat.id_barang,
alat.kd_barang,
alat.nama as nama_alat,
alat.merk,
alat.spec,
alat.tahun,
alat.jumlah,
alat.satuan,
alat.kondisi,
alat.harga,
alat.smbr_dana,
alat.no_aset,
alat.id_dep,
kantor.nama as nama_kantor
FROM
alat
INNER JOIN kantor ON kantor.id_dep = alat.id_dep where alat.kd_barang like '%$_POST[cari]%' or alat.nama like '%$_POST[cari]%' or alat.merk like '%$_POST[cari]%' or alat.spec like '%$_POST[cari]%' or alat.tahun like '%$_POST[cari]%' 
        or alat.jumlah like '%$_POST[cari]%' or alat.satuan like '%$_POST[cari]%' or alat.kondisi like '%$_POST[cari]%' or alat.harga like '%$_POST[cari]%' 
        or alat.smbr_dana like '%$_POST[cari]%' or alat.no_aset like '%$_POST[cari]%' or kantor.nama like '%$_POST[cari]%' order by alat.nama asc");
}else{

$hasil=mysql_query("SELECT alat.id_barang,
alat.kd_barang,
alat.nama as nama_alat,
alat.merk,
alat.spec,
alat.tahun,
alat.jumlah,
alat.satuan,
alat.kondisi,
alat.harga,
alat.smbr_dana,
alat.no_aset,
alat.id_dep,
kantor.nama as nama_kantor
FROM
alat
INNER JOIN kantor ON kantor.id_dep = alat.id_dep");
}
?>

      <div style="width:100%;height:500px;overflow-y:hidden;overflow-x:scroll;">
     <!--  <p style="width:100%;"> -->
      <table class="table table-bordered table-striped table-condensed" >
 
        <thead>
          <tr >
            <th>Kode Barang</th>
            <th>Nama</th>
            <th>Merk</th>
            <th>Spec</th>
            <th>Tahun</th>
            <th>Jumlah</th>
            <th>Satuan</th>
            <th>Kondisi</th>
            <th>Harga</th>
            <th>Sumber Dana</th>
            <th>No. Aset</th>
            <th>Lokasi</th>
            <th colspan="2">Action</th>
          </tr>
        </thead>
        <tbody>
  <?php
    while($x=mysql_fetch_array($hasil)){
  ?>
    <tr>
      <td><?php echo $x['kd_barang'];?></td>
      <td><?php echo $x['nama_alat'];?></td>
      <td><?php echo $x['merk'];?></td>
      <td><?php echo $x['spec'];?></td>
      <td><?php echo $x['tahun'];?></td>
      <td><?php echo $x['jumlah'];?></td>
      <td><?php echo $x['satuan'];?></td>
      <td><?php echo $x['kondisi'];?></td>
      <td><?php echo $x['harga'];?></td>
      <td><?php echo $x['smbr_dana'];?></td>
      <td><?php echo $x['no_aset'];?></td>
      <td><?php echo $x['nama_kantor'];?></td>
      <td> <a href="?act=edit&type=barang&id=<?php echo $x['kd_barang']; ?>"  title="Click to Edit"> <span class="icon-pencil " title="Edit Post"></span></a> </td>
      <td> <a href="?act=delete&type=barang&id=<?php echo $x['kd_barang']; ?>" onclick = "return confirm ('Anda yakin ingin menghapus data <?=$x['nama_alat'];?>?')" title="Click to Delete" class="delete"><span class="icon-trash " title="Delete Post"></span></a></td>
		</tr>

     <?php
          }
          ?>
  </tbody>
  </table>
  <!-- </p> -->
  </div>
  </div>


    <?php
		break;
		case 'bhp';
		?>


		<h2>Data Inventaris Bahan Habis Pakai Jurusan Teknik Elektro</h2><br><br>
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
  <a href='export/daftar_bahan_xls.php'
  target='_blank'
  class="btn" ><i class='icon-download-alt'></i> Excel</a>
  <a href='export/daftar_bahan_cetak.php'
  target='_blank'
  class="btn" ><i class='icon-print'></i>cetak</a>
  </p>

<?php
if(isset($_POST['cari'])){
       $bahan=mysql_query("SELECT
  bahan.id_bahan,
  bahan.kd_bahan,
  bahan.nama as nama_bahan,
  bahan.tahun,
  bahan.jumlah,
  bahan.satuan,
  kantor.nama as lokasi
  FROM
  bahan
  INNER JOIN kantor ON bahan.id_dep = kantor.id_dep where bahan.kd_bahan like '%$_POST[cari]%' or bahan.nama like '%$_POST[cari]%' or bahan.tahun like '%$_POST[cari]%' or bahan.jumlah like '%$_POST[cari]%' 
        or bahan.satuan like '%$_POST[cari]%' or kantor.nama like '%$_POST[cari]%' order by bahan.nama asc");
}else{

  $bahan=mysql_query("SELECT
  bahan.id_bahan,
  bahan.kd_bahan,
  bahan.nama as nama_bahan,
  bahan.tahun,
  bahan.jumlah,
  bahan.satuan,
  kantor.nama as lokasi
  FROM
  bahan
  INNER JOIN kantor ON bahan.id_dep = kantor.id_dep");
}
?>
      <div style="width:100%;height:500px;overflow-y:hidden;overflow-x:scroll;">
      <table class="table table-bordered table-striped table-condensed" >
 
        <thead>
          <tr >
            <th>Kode Bahan</th>
            <th>Nama</th>
              <th>Tahun</th>
              <th>Jumlah</th>
              <th>Satuan</th>
               <th>Lokasi</th>
               <th colspan="2">Action</th>
        
          </tr>
        </thead>
        <tbody>

   <?php
    while($a=mysql_fetch_array($bahan)){
  ?>
    <tr>
      <td><?php echo $a['kd_bahan'];?></td>
      <td><?php echo $a['nama_bahan'];?></td>
      <td><?php echo $a['tahun'];?></td>
       <td><?php echo $a['jumlah'];?></td>
      <td><?php echo $a['satuan'];?></td>
       <td><?php echo $a['lokasi'];?></td>
       <td> <a href="?act=edit&type=bahan&id=<?php echo $a['kd_bahan']; ?>"  title="Click to Edit"> <span class="icon-pencil " title="Edit Post"></span></a> </td>
        <td> <a href="?act=delete&type=bahan&id=<?php echo $a['kd_bahan']; ?>" onclick = "return confirm ('Anda yakin ingin menghapus data <?=$a['nama_bahan'];?>?')" title="Click to Delete" class="delete"><span class="icon-trash " title="Delete Post"></span></a></td>
  
	 </tr>

     <?php
          }
          ?>
  </tbody>
  </table>
  </div>
		<?php
		break;
		default:
	}
	?>
	</div>