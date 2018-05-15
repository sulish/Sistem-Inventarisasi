<?php		
			require_once '../inc/config.php';
			$query = "SELECT
  bahan.id_bahan,
  bahan.kd_bahan,
  bahan.nama as nama_bahan,
  bahan.tahun,
  bahan.jumlah,
  bahan.satuan,
  kantor.nama as lokasi
  FROM
  bahan
  INNER JOIN kantor ON bahan.id_dep = kantor.id_dep order by bahan.nama asc ";
			$result = mysql_query($query) or die(mysql_error());
			$id_bahan = 1;?>
<html>
	<head>
		
	</head>
	<body>
		<div class='span8  offset2'>
			<h2 style='text-align: center'> Daftar Bahan Habis Pakai SYSIN TE UM</h2>
			<hr>
			<table  class="table table-bordered table-striped table-condensed cf">
				<thead>
			<tr>
				<th>Kode</th>
	      		<th>Nama</th>
	    		<th>Tahun</th>
				<th>Jumlah</th>
				<th>Satuan</th>
				<th>Lokasi</th>
			</tr>
				</thead>
				<tbody>
					<?php
$query="SELECT
  bahan.id_bahan,
  bahan.kd_bahan,
  bahan.nama as nama_bahan,
  bahan.tahun,
  bahan.jumlah,
  bahan.satuan,
  kantor.nama as lokasi
  FROM
  bahan
  INNER JOIN kantor ON bahan.id_dep = kantor.id_dep order by bahan.nama asc";
$result=mysql_query($query) or die(mysql_error());
$id_bahan=1;
//proses menampilkan data
while($rows=mysql_fetch_object($result)){
					?>
					<tr>
						</td><td><?		echo $rows -> kd_bahan;?></td>
						<td><?		echo $rows -> nama_bahan;?></td>
						<td><?		echo $rows -> tahun;?></td>
						<td><?		echo $rows -> jumlah;?></td>
						<td><?		echo $rows -> satuan;?></td>
						<td><?		echo $rows -> lokasi;?></td>
		
					</tr>
					<?
}?>
				</tbody>
			</table>
			<p align='center'>
		<a href="daftar_bahan_cetak.php" cls='btn' onClick="window.print();return false"> <i class='icon-print'></i>Cetak </a>
			</p>
		</div>
	</body>
</html>
