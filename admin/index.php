<?php
	session_start();
	require("../config/config.php");
	if(isset($_SESSION['username']) && isset($_SESSION['type']) ){
	require("../includes/admin_header.php"); 
	require("../includes/admin_sidebar.php");
?>
	  
<div class="content-block">
	<h2>SELAMAT DATANG</h2>
	<h5> Hai <?php echo $_SESSION['nama']; ?> </h5>
	<h5> Anda Login Sebagai <?php echo $_SESSION['type']; ?></h5>

<?php
	$kategori = 'alat';

	if( isset($_POST['kategori']) && $_POST['kategori'] == 'Bahan' ){
		$kategori = 'bahan';
	}
?>
	  <form class="form-inline" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" >
      <input type="hidden" value="alat" name="type_form" />
      <div class="control-group" style="height: 50px;"> 
      <label class="control-label" >Pencarian</label>
      <div class="control-group" style="height: 50px;">
      <select name="kategori">
      	<option <?php if(isset($_POST['kategori']) && $_POST['kategori'] == 'Alat'){ echo "selected='selected'"; } ?>>Alat</option>
      	<option <?php if(isset($_POST['kategori']) && $_POST['kategori'] == 'Bahan'){ echo "selected='selected'"; } ?>>Bahan</option>
      </select>
      <input type="text" name="cari"  size="35" placeholder="Ketikkan kata kunci" style="height:30px; width:250px">
	  <button type="submit" class="btn" name="search" >Cari</button>
        </div>
        </div>
      </form>

<div style="width:100%;height:300px;overflow-y:scroll;overflow-x:scroll;">
<br><table class="table table-bordered table-striped table-condensed" >

<?php
	// ALAT

	if( $kategori == 'alat' ) {
		if(isset($_POST['cari'])){
       $query=mysql_query("SELECT alat.id_barang,
		alat.kd_barang,
		alat.nama as nama_alat,
		alat.merk,
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
		INNER JOIN kantor ON kantor.id_dep = alat.id_dep where alat.kd_barang like '%$_POST[cari]%' or alat.nama like '%$_POST[cari]%' or alat.merk like '%$_POST[cari]%' or alat.tahun like '%$_POST[cari]%' 
        or alat.jumlah like '%$_POST[cari]%' or alat.satuan like '%$_POST[cari]%' or alat.kondisi like '%$_POST[cari]%' or alat.harga like '%$_POST[cari]%' 
        or alat.smbr_dana like '%$_POST[cari]%' or alat.no_aset like '%$_POST[cari]%' or kantor.nama like '%$_POST[cari]%' order by alat.nama asc");
}else{
  		$query=mysql_query("SELECT alat.id_barang,
		alat.kd_barang,
		alat.nama as nama_alat,
		alat.merk,
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
	  	<thead>
	    	<tr >
	      		<th>Kode</th>
	      		<th>Nama</th>
	       		<th>Merk</th>
	    		<th>Tahun</th>
				<th>Jumlah</th>
				<th>Satuan</th>
				<th>Kondisi</th>
				<th>No Aset</th>
				<th>Lokasi</th>
	    	</tr>
	  	</thead>
	  	<tbody class="result">
		<?php
			while($hasil=mysql_fetch_array($query)){
		?>
			<tr>
			  	<td class="kode"><?php echo $hasil['kd_barang'];?></td>
			  	<td class="nama"><?php echo $hasil['nama_alat'];?></td>
			   	<td><?php echo $hasil['merk'];?></td>
			    <td><?php echo $hasil['tahun'];?></td>
			    <td><?php echo $hasil['jumlah'];?></td>
			    <td><?php echo $hasil['satuan'];?></td>
			    <td><?php echo $hasil['kondisi'];?></td>
			    <td><?php echo $hasil['no_aset'];?></td>
			    <td><?php echo $hasil['nama_kantor'];?></td>
			</tr>
	<?php
	    }
?>
	  	</tbody>
<?php
	// BAHAN
	}elseif( $kategori == 'bahan' ){
		if(isset($_POST['cari'])){
       $query=mysql_query("SELECT
  bahan.id_bahan,
  bahan.kd_bahan,
  bahan.nama as nama_bahan,
  bahan.tahun,
  bahan.jumlah,
  bahan.satuan,
  kantor.nama as lokasi
  FROM
  bahan
  INNER JOIN kantor ON bahan.id_dep = kantor.id_dep  where bahan.kd_bahan like '%$_POST[cari]%' or bahan.nama like '%$_POST[cari]%' or bahan.tahun like '%$_POST[cari]%' or bahan.jumlah like '%$_POST[cari]%' 
        or bahan.satuan like '%$_POST[cari]%' or kantor.nama like '%$_POST[cari]%' order by bahan.nama asc");
}else{

  $query=mysql_query("SELECT
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

	<thead>
    	<tr >
      		<th>Kode</th>
      		<th>Nama</th>
    		<th>Tahun</th>
			<th>Jumlah</th>
			<th>Satuan</th>
			<th>Lokasi</th>
    	</tr>
  	</thead>
  	<tbody class="result">
	<?php
		while($hasil=mysql_fetch_array($query)){
	?>
		<tr>
		  	<td class="kode"><?php echo $hasil['kd_bahan'];?></td>
		  	<td class="nama"><?php echo $hasil['nama_bahan'];?></td>
		  	<td><?php echo $hasil['tahun'];?></td>
		   	<td><?php echo $hasil['jumlah'];?></td>
		  	<td><?php echo $hasil['satuan'];?></td>
		  	<td><?php echo $hasil['lokasi'];?></td>
		</tr>
<?php
		}
?>
  	</tbody>
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
