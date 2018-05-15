<?php		
			require_once '../inc/config.php';
			$query = "SELECT * from kantor order by id_dep asc";
			$result = mysql_query($query) or die(mysql_error());
			$id_dep = 1;?>
<html>
	<head>
		
	</head>
	<body>
		<div class='span8  offset2'>
			<h2 style='text-align: center'> Daftar Ruangan SYSIN TE UM</h2>
			<hr>
			<table  class="table table-bordered table-striped table-condensed cf">
				<thead>
			<tr>
				<th>ID Dept</th>
	      		<th>Nama</th>
	    		<th>Ruang</th>
				<th>Kategori</th>
			</tr>
				</thead>
				<tbody>
					<?php
$query="SELECT * from kantor order by id_dep asc";
$result=mysql_query($query) or die(mysql_error());
$id_dep=1;
//proses menampilkan data
while($rows=mysql_fetch_object($result)){
					?>
					<tr>
						</td><td><?		echo $rows -> id_dep;?></td>
						<td><?		echo $rows -> nama;?></td>
						<td><?		echo $rows -> ruang;?></td>
						<td><?		echo $rows -> kategori;?></td>
					</tr>
					<?
}?>
				</tbody>
			</table>
			<p align='center'>
		<a href="daftar_ruang_cetak.php" cls='btn' onClick="window.print();return false"> <i class='icon-print'></i>Cetak </a>
			</p>
		</div>
	</body>
</html>
