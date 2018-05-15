<?php
	session_start();
	require("../config/config.php");
	if(isset($_SESSION['username']) && isset($_SESSION['type']) ){
	require("../includes/admin_header.php"); 
	require("../includes/admin_sidebar.php");
	

?>

		<div class="content-block">
		
		<h2>TRANSAKSI MASUK DATA INVENTARIS ALAT</h2>
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
    <p class='pull-right'>
	<a href='export/transaksi_masuk_alat_xls.php'
	target='_blank'
	class="btn" ><i class='icon-download-alt'></i> Excel</a>
	<a href='export/transaksi_masuk_alat_cetak.php'
	target='_blank'
	class="btn" ><i class='icon-print'></i>cetak</a>
	</p>

<div style="width:100%;height:300px;overflow-y:scroll;overflow-x:scroll;">
<table class="table table-bordered table-striped table-condensed" >

<?php
	// ALAT
		if(isset($_POST['cari'])){
        $query=mysql_query(" SELECT
		alat.kd_barang,
		alat.nama,
		alat.merk,
		alat.spec,
		alat.tahun,
		alat.jumlah,
		alat.satuan,
		alat.harga,
		alat.smbr_dana,
		alat.no_aset,
		kantor.nama as lokasi,
		transaksi_ma.kondisi,
		transaksi_ma.tgl_masuk
		FROM
		alat
		INNER JOIN transaksi_ma ON alat.kd_barang = transaksi_ma.kd_barang
		INNER JOIN kantor ON alat.id_dep = kantor.id_dep where alat.kd_barang like '%$_POST[cari]%' or alat.nama like '%$_POST[cari]%' or alat.merk like '%$_POST[cari]%' or alat.spec like '%$_POST[cari]%' or alat.tahun like '%$_POST[cari]%' 
        or alat.jumlah like '%$_POST[cari]%' or alat.satuan like '%$_POST[cari]%' or alat.kondisi like '%$_POST[cari]%' or alat.harga like '%$_POST[cari]%' 
        or alat.smbr_dana like '%$_POST[cari]%' or alat.no_aset like '%$_POST[cari]%' or kantor.nama like '%$_POST[cari]%' or transaksi_ma.kondisi like '%$_POST[cari]%' or transaksi_ma.tgl_masuk like '%$_POST[cari]%' order by alat.nama asc");
}else{
  		$query=mysql_query("SELECT
alat.kd_barang,
alat.nama,
alat.merk,
alat.spec,
alat.tahun,
alat.jumlah,
alat.satuan,
alat.harga,
alat.smbr_dana,
alat.no_aset,
kantor.nama as lokasi,
transaksi_ma.kondisi,
transaksi_ma.tgl_masuk
FROM
alat
INNER JOIN transaksi_ma ON alat.kd_barang = transaksi_ma.kd_barang
INNER JOIN kantor ON alat.id_dep = kantor.id_dep order by tgl_masuk asc");
  }
?>
	  	<thead>
	    	<tr >
	      		<th>Kode</th>
	      		<th>Nama</th>
	       		<th>Merk</th>
	       		<th>Spec</th>
	    		<th>Tahun</th>
				<th>Jumlah</th>
				<th>Satuan</th>
				<th>Harga</th>
				<th>Sumber Dana</th>
				<th>No Aset</th>
				<th>Lokasi</th>
				<th>Kondisi</th>
				<th>Tanggal Masuk</th>
	    	</tr>
	  	</thead>
	  	<tbody class="result">
		<?php
			while($hasil=mysql_fetch_array($query)){
		?>
			<tr>
			  	<td class="kode"><?php echo $hasil['kd_barang'];?></td>
			  	<td class="nama"><?php echo $hasil['nama'];?></td>
			   	<td><?php echo $hasil['merk'];?></td>
			   	<td><?php echo $hasil['spec'];?></td>
			  	<td><?php echo $hasil['tahun'];?></td>
			   	<td><?php echo $hasil['jumlah'];?></td>
			  	<td><?php echo $hasil['satuan'];?></td>
			  	<td><?php echo $hasil['harga'];?></td>
			  	<td><?php echo $hasil['smbr_dana'];?></td>
			  	<td><?php echo $hasil['no_aset'];?></td>
			  	<td><?php echo $hasil['lokasi'];?></td>
			  	<td><?php echo $hasil['kondisi'];?></td>
			    <td><?php echo $hasil['tgl_masuk'];?></td>
			</tr>
	<?php
	    }
	?>
	  	</tbody>
 
        </table>
        </div> 
        </div>

    <?php
	 }else{
	 	header("location:../masuk.php");

	}
?>
