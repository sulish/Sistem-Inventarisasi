<?php
	session_start();
	require("../config/config.php");
	if(isset($_SESSION['username']) && isset($_SESSION['type']) ){

	require("../includes/admin_header.php"); 
	require("../includes/admin_sidebar.php");
	

?>

		<div class="content-block">
		
		<h2>TRANSAKSI MASUK DATA INVENTARIS BAHAN HABIS PAKAI</h2>
		<form class="form-inline" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" >
	      <input type="hidden" value="alat" name="type_form" />
	      <div class="control-group" style="height: 50px;"> 
	      <label class="control-label" >Pencarian</label>
	      <div class="control-group" style="height: 50px;">
  			<input type="text" name="cari"  size="35" placeholder="Ketikkan kata kunci"  style="height:30px; width:250px">
	  		<button type="submit" class="btn" name="search" >Cari</button>
        </div>
      	</form>
      	
    <p class='pull-right'>
	<a href='export/transaksi_masuk_bahan_xls.php'
	target='_blank'
	class="btn" ><i class='icon-download-alt'></i> Excel</a>
	<a href='export/transaksi_masuk_bahan_cetak.php'
	target='_blank'
	class="btn" ><i class='icon-print'></i>cetak</a>
	</p>

<div style="width:100%;height:300px;overflow-y:scroll;overflow-x:scroll;">
<table class="table table-bordered table-striped table-condensed" >

<?php
		if(isset($_POST['cari'])){
        $query=mysql_query(" SELECT
		bahan.kd_bahan,
		bahan.nama as nama_bahan,
		transaksi_mb.merk,
		transaksi_mb.tahun,
		transaksi_mb.jumlah,
		transaksi_mb.satuan,
		transaksi_mb.tgl_masuk,
		transaksi_mb.harga,
		transaksi_mb.smbr_dana,
		kantor.nama as nama_kantor
		FROM
		bahan
		INNER JOIN transaksi_mb ON bahan.kd_bahan = transaksi_mb.kd_bahan
		INNER JOIN kantor ON bahan.id_dep = kantor.id_dep where bahan.kd_bahan like '%$_POST[cari]%' or bahan.nama like '%$_POST[cari]%' 
		or transaksi_mb.merk like '%$_POST[cari]%' or transaksi_mb.tahun like '%$_POST[cari]%' or transaksi_mb.jumlah like '%$_POST[cari]%' or transaksi_mb.satuan like '%$_POST[cari]%'
		or transaksi_mb.tgl_masuk like '%$_POST[cari]%' or transaksi_mb.harga like '%$_POST[cari]%' or kantor.nama like '%$_POST[cari]%' order by bahan.nama asc");
}else{
  $query=mysql_query("SELECT
	bahan.kd_bahan,
	bahan.nama as nama_bahan,
	transaksi_mb.merk,
	transaksi_mb.tahun,
	transaksi_mb.jumlah,
	transaksi_mb.satuan,
	transaksi_mb.tgl_masuk,
	transaksi_mb.harga,
	transaksi_mb.smbr_dana,
	kantor.nama as nama_kantor
	FROM
	bahan
	INNER JOIN transaksi_mb ON bahan.kd_bahan = transaksi_mb.kd_bahan
	INNER JOIN kantor ON bahan.id_dep = kantor.id_dep order by tgl_masuk asc");
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
			<th>Tanggal Masuk</th>
			<th>Harga</th>
			<th>Sumber Dana</th>
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
		  	<td><?php echo $hasil['merk'];?></td>
		  	<td><?php echo $hasil['tahun'];?></td>
		   	<td><?php echo $hasil['jumlah'];?></td>
		  	<td><?php echo $hasil['satuan'];?></td>
		  	<td><?php echo $hasil['tgl_masuk'];?></td>
		  	<td><?php echo $hasil['harga'];?></td>
		  	<td><?php echo $hasil['smbr_dana'];?></td>
		  	<td><?php echo $hasil['nama_kantor'];?></td>
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

    