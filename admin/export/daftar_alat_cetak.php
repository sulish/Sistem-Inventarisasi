<?php		
			require_once '../inc/config.php';
			$query = "SELECT alat.id_barang,
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
INNER JOIN kantor ON kantor.id_dep = alat.id_dep order by alat.nama asc ";
			$result = mysql_query($query) or die(mysql_error());
			$kd_barang = 1;?>
<html>
	<head>
		
	</head>
	<body>
		<div class='span8  offset2'>
			<h2 style='text-align: center'> Daftar Alat dan Barang SYSIN TE UM</h2>
			<hr>
			<table  class="table table-bordered table-striped table-condensed cf">
				<thead>
			<tr>
				<th>Kode</th>
	      		<th>Nama</th>
	       		<th>Merk</th>
	    		<th>Tahun</th>
				<th>Jumlah</th>
				<th>Satuan</th>'
				<th>Kondisi</th>
				<th>Harga</th>
				<th>Sumber Dana</th>
				<th>No Aset</th>
				<th>Lokasi</th>
			</tr>
				</thead>
				<tbody>
					<?php
$query="SELECT alat.id_barang,
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
INNER JOIN kantor ON kantor.id_dep = alat.id_dep order by alat.nama asc";
$result=mysql_query($query) or die(mysql_error());
$kd_barang=1;
//proses menampilkan data
while($rows=mysql_fetch_object($result)){
					?>
					<tr>
						</td><td><?		echo $rows -> kd_barang;?></td>
						<td><?		echo $rows -> nama_alat;?></td>
						<td><?		echo $rows -> merk;?></td>
						<td><?		echo $rows -> tahun;?></td>
						<td><?		echo $rows -> jumlah;?></td>
						<td><?		echo $rows -> satuan;?></td>
						<td ><p class='pull-right'><?	echo format_rupiah($rows -> harga);?></p></td>
						<td><?		echo $rows -> kondisi;?></td>
						<td><?		echo $rows -> smbr_dana;?></td>
						<td><?		echo $rows -> no_aset;?></td>
						<td><?		echo $rows -> nama_kantor;?></td>
		
					</tr>
					<?
}?>
				</tbody>
			</table>
			<p align='center'>
		<a href="daftar_alat_cetak.php" cls='btn' onClick="window.print();return false"> <i class='icon-print'></i>Cetak </a>
			</p>
		</div>
	</body>
</html>
