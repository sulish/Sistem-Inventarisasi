<?php		
			require_once '../inc/config.php';
			$query = "SELECT * from mhs order by nama asc ";
			$result = mysql_query($query) or die(mysql_error());
			$id_mem = 1;?>
<html>
		
	<head>
		<style>
table.excel {
border-style:ridge;
border-width:1;
border-collapse:collapse;
font-family:sans-serif;
font-size:12px;
}
table.excel thead th, table.excel tbody th {
background:#CCCCCC;
border-style:ridge;
border-width:1;
text-align: center;
vertical-align:bottom;
}
table.excel tbody th {
text-align:center;
width:20px;
}
table.excel tbody td {
vertical-align:bottom;
}
table.excel tbody td {
padding: 0 3px;
border: 1px solid #EEEEEE;
}
</style>

	</head>
	<body>
		<div class='span8  offset2'>
			<h2 style='text-align: center'> Daftar Mahasiswa SYSIN TE UM</h2>
			<hr>
			<table  class="table table-bordered table-striped table-condensed">
				<thead>
			<tr>
				  <th>No</th>
				  <th>Nama</th>
		          <th>NIM</th>
		          <th>Jenis Kelamin</th>
		          <th>Tanggal Lahir</th>
		          <th>Alamat</th>
		          <th>Jurusan</th>
		          <th>Email</th>
		          <th>Telepon</th>
			</tr>
				</thead>
				<tbody>
					<?php
$query="SELECT * from mhs order by nama asc";
$result=mysql_query($query) or die(mysql_error());
$id_mem=1;
//proses menampilkan data
while($rows=mysql_fetch_object($result)){
					?>
					<tr>
						<td><?		echo $rows -> id_mem;?></td>
						<td><?		echo $rows -> nama;?></td>
						<td><?		echo $rows -> nim;?></td>
						<td><?		echo $rows -> sex;?></td>
						<td><?		echo $rows -> ttl;?></td>
						<td><?		echo $rows -> alamat;?></td>
						<td><?		echo $rows -> prodi;?>/<?		echo $rows -> angkatan;?>/<?		echo $rows -> kelas;?></td>
						<td><?		echo $rows -> email;?></td>
						<td><?		echo $rows -> tlp;?></td>
					</tr>
					<?
}?>
				</tbody>
			</table>
			<p align='center'>
		<a href="daftar_mhs_cetak.php" cls='btn' onClick="window.print();return false"> <i class='icon-print'></i>Cetak </a>
			</p>
		</div>
	</body>
</html>
