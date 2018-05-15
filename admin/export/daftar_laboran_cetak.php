<?php		
			require_once '../inc/config.php';
			$query = "SELECT
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
INNER JOIN kantor ON laboran.id_dep = kantor.id_dep order by laboran.nama asc";
			$result = mysql_query($query) or die(mysql_error());
			$id_lab = 1;?>
<html>
	<head>
		
	</head>
	<body>
		<div class='span8  offset2'>
			<h2 style='text-align: center'> Daftar User Laboran SYSIN TE UM</h2>
			<hr>
			<table  class="table table-bordered table-striped table-condensed cf">
				<thead>
			<tr>
				    <th>Nama</th>
		            <th>NIP</th>
		            <th>Jenis Kelamin</th>
		            <th>Tanggal Lahir</th>
		            <th>Alamat</th>
		            <th>Jabatan</th>
		            <th>Email</th>
		            <th>Telepon</th>
		            <th>Ruang</th>
			</tr>
				</thead>
				<tbody>
					<?php
$query="SELECT
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
INNER JOIN kantor ON laboran.id_dep = kantor.id_dep order by laboran.nama asc";
$result=mysql_query($query) or die(mysql_error());
$id_lab=1;
//proses menampilkan data
while($rows=mysql_fetch_object($result)){
					?>
					<tr>
						<td><?		echo $rows -> nama_laboran;?></td>
						<td><?		echo $rows -> nip;?></td>
						<td><?		echo $rows -> sex;?></td>
						<td><?		echo $rows -> ttl;?></td>
						<td><?		echo $rows -> alamat;?></td>
						<td><?		echo $rows -> jabatan;?></td>
						<td><?		echo $rows -> email;?></td>
						<td><?		echo $rows -> tlp;?></td>
						<td><?		echo $rows -> lokasi;?></td>
					</tr>
					<?
}?>
				</tbody>
			</table>
			<p align='center'>
		<a href="daftar_laboran_cetak.php" cls='btn' onClick="window.print();return false"> <i class='icon-print'></i>Cetak </a>
			</p>
		</div>
	</body>
</html>
