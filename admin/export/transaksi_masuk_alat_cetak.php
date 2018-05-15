<?php		
			require_once '../inc/config.php';
			$query = "SELECT
alat.kd_barang,
alat.nama,
alat.merk,
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
INNER JOIN kantor ON alat.id_dep = kantor.id_dep order by tgl_masuk asc ";
			$result = mysql_query($query) or die(mysql_error());
			$kd_barang = 1;?>
<html>
	<head>
		
	</head>
	<body>
		<div class='span8  offset2'>
			<h2 style='text-align: center'> Transaksi Masuk Alat dan Barang SYSIN TE UM</h2>
			<hr>
			<table  class="table table-bordered table-striped table-condensed cf">
				<thead>
			<tr>
				<th>Kode</th>
	      		<th>Nama</th>
	       		<th>Merk</th>
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
				<tbody>
					<?php
$query="SELECT
alat.kd_barang,
alat.nama,
alat.merk,
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
INNER JOIN kantor ON alat.id_dep = kantor.id_dep order by tgl_masuk asc";
$result=mysql_query($query) or die(mysql_error());
$kd_barang=1;
//proses menampilkan data
while($rows=mysql_fetch_object($result)){
					?>
					<tr>
						</td><td><?		echo $rows -> kd_barang;?></td>
						<td><?		echo $rows -> nama;?></td>
						<td><?		echo $rows -> merk;?></td>
						<td><?		echo $rows -> tahun;?></td>
						<td><?		echo $rows -> jumlah;?></td>
						<td><?		echo $rows -> satuan;?></td>
						<td><?		echo $rows -> harga;?></td>
						<td><?		echo $rows -> smbr_dana;?></td>
						<td><?		echo $rows -> no_aset;?></td>
						<td><?		echo $rows -> lokasi;?></td>
						<td><?		echo $rows -> kondisi;?></td>
						<td><?		echo $rows -> tgl_masuk;?></td>
					</tr>
					<?
}?>
				</tbody>
			</table>
			<p align='center'>
		<a href="transaksi_masuk_alat_cetak.php" cls='btn' onClick="window.print();return false"> <i class='icon-print'></i>Cetak </a>
			</p>
		</div>
	</body>
</html>
