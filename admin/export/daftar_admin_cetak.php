<?php		
			require_once '../inc/config.php';
			$query = "SELECT * from admin order by nama asc";
			$result = mysql_query($query) or die(mysql_error());
			$id_admin = 1;?>
<html>
	<head>
		
	</head>
	<body>
		<div class='span8  offset2'>
			<h2 style='text-align: center'> Daftar User Administrator SYSIN TE UM</h2>
			<hr>
			<table  class="table table-bordered table-striped table-condensed cf">
				<thead>
			<tr>
				    <th>Nama</th>
			        <th>No. ID Admin</th>
			        <th>Email</th>
			</tr>
				</thead>
				<tbody>
					<?php
$query="SELECT * from admin order by nama asc";
$result=mysql_query($query) or die(mysql_error());
$id_admin=1;
//proses menampilkan data
while($rows=mysql_fetch_object($result)){
					?>
					<tr>
						<td><?		echo $rows -> nama;?></td>
						<td><?		echo $rows -> nid;?></td>
						<td><?		echo $rows -> email;?></td>
					</tr>
					<?
}?>
				</tbody>
			</table>
			<p align='center'>
		<a href="daftar_admin_cetak.php" cls='btn' onClick="window.print();return false"> <i class='icon-print'></i>Cetak </a>
			</p>
		</div>
	</body>
</html>
