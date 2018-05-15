<?php		
			require_once '../inc/config.php';
			$query = "SELECT
bahan.id_bahan,
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
INNER JOIN kantor ON bahan.id_dep = kantor.id_dep order by tgl_masuk asc ";
			$result = mysql_query($query) or die(mysql_error());
			$id_bahan = 1;?>
<html>
	<head>
		
	</head>
	<body>
		<div class='span8  offset2'>
			<h2 style='text-align: center'> Transaksi Masuk Bahan Habis Pakai SYSIN TE UM</h2>
			<hr>
			<table  class="table table-bordered table-striped table-condensed cf">
				<thead>
			<tr>
				<th>Tanggal Masuk</th>
				<th>Kode</th>
	      		<th>Nama</th>
	       		<th>Merk</th>
	    		<th>Tahun</th>
				<th>Jumlah</th>
				<th>Satuan</th>
				<th>Harga</th>
				<th>Sumber Dana</th>
				<th>Lokasi</th>
			</tr>
				</thead>
				<tbody>
					<?php
$query="SELECT
bahan.id_bahan,
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
INNER JOIN kantor ON bahan.id_dep = kantor.id_dep order by tgl_masuk asc";
$result=mysql_query($query) or die(mysql_error());
$id_bahan=1;
//proses menampilkan data
while($rows=mysql_fetch_object($result)){
					?>
					<tr>
						<td><?		echo $rows -> tgl_masuk;?></td>
						<td><?		echo $rows -> kd_bahan;?></td>
						<td><?		echo $rows -> nama_bahan;?></td>
						<td><?		echo $rows -> merk;?></td>
						<td><?		echo $rows -> tahun;?></td>
						<td><?		echo $rows -> jumlah;?></td>
						<td><?		echo $rows -> satuan;?></td>
						<td ><p class='pull-right'><?	echo format_rupiah($rows -> harga);?></p></td>
						<td><?		echo $rows -> smbr_dana;?></td>
						<td><?		echo $rows -> nama_kantor;?></td>
					</tr>
					<?
}?>
				</tbody>
			</table>
			<p align='center'>
		<a href="transaksi_masuk_bahan_cetak.php" cls='btn' onClick="window.print();return false"> <i class='icon-print'></i>Cetak </a>
			</p>
		</div>
	</body>
</html>
