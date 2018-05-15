<?php		
			require_once '../inc/config.php';
			$query = "SELECT * from pegawai order by nama asc";
			$result = mysql_query($query) or die(mysql_error());
			$id_peg = 1;?>
<html>
	<head>
		
	</head>
	<body>
		<div class='span8  offset2'>
			<h2 style='text-align: center'> Daftar User Pegawai SYSIN TE UM</h2>
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
			</tr>
				</thead>
				<tbody>
					<?php
$query="SELECT * from pegawai order by nama asc";
$result=mysql_query($query) or die(mysql_error());
$id_peg=1;
//proses menampilkan data
while($rows=mysql_fetch_object($result)){
					?>
					<tr>
						<td><?		echo $rows -> nama;?></td>
						<td><?		echo $rows -> nip;?></td>
						<td><?		echo $rows -> sex;?></td>
						<td><?		echo $rows -> ttl;?></td>
						<td><?		echo $rows -> alamat;?></td>
						<td><?		echo $rows -> jabatan;?></td>
						<td><?		echo $rows -> email;?></td>
						<td><?		echo $rows -> tlp;?></td>
					</tr>
					<?
}?>
				</tbody>
			</table>
			<p align='center'>
		<a href="daftar_pegawai_cetak.php" cls='btn' onClick="window.print();return false"> <i class='icon-print'></i>Cetak </a>
			</p>
		</div>
	</body>
</html>
