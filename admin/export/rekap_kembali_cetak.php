<?php		
			require_once '../inc/config.php';
			$query = "SELECT
			transaksi_pa.id_pinjam,
			transaksi_pa.indate,
			transaksi_pa.outdate,
			laboran.nama AS nama_laboran,
			alat.nama AS nama_alat,
			detail_pa.jumlah,
			detail_pa.`status`,
			`user`.username,
			alat.kd_barang
			FROM
			detail_pa
			INNER JOIN transaksi_pa ON transaksi_pa.id_pinjam = detail_pa.id_pinjam
			INNER JOIN laboran ON transaksi_pa.id_lab = laboran.id_user
			INNER JOIN alat ON detail_pa.id_alat = alat.kd_barang
			INNER JOIN `user` ON transaksi_pa.id_user = `user`.id_user
			where detail_pa.status='2'
			order by transaksi_pa.indate asc";
			$result = mysql_query($query) or die(mysql_error());
			$id_pinjam = 1;?>
<html>
	<head>
		
	</head>
	<body>
		<div class='span8  offset2'>
			<h2 style='text-align: center'> Rekap Peminjaman Alat dan Barang SYSIN TE UM</h2>
			<hr>
			<table  class="table table-bordered table-striped table-condensed cf">
				<thead>
			<tr>
				<th>Id Pinjam</th>
	      		<th>Tanggal Masuk</th>
	       		<th>Tanggal Kembali</th>
	    		<th>Peminjam</th>
				<th>Laboran</th>
				<th>Kode Alat</th>
				<th>Nama Alat</th>
				<th>Jumlah</th>
				<th>Status</th>
			</tr>
				</thead>
				<tbody>
					<?php
		$query="SELECT
			transaksi_pa.id_pinjam,
			transaksi_pa.indate,
			transaksi_pa.outdate,
			laboran.nama AS nama_laboran,
			alat.nama AS nama_alat,
			detail_pa.jumlah,
			detail_pa.`status`,
			`user`.username,
			alat.kd_barang
			FROM
			detail_pa
			INNER JOIN transaksi_pa ON transaksi_pa.id_pinjam = detail_pa.id_pinjam
			INNER JOIN laboran ON transaksi_pa.id_lab = laboran.id_user
			INNER JOIN alat ON detail_pa.id_alat = alat.kd_barang
			INNER JOIN `user` ON transaksi_pa.id_user = `user`.id_user
			where detail_pa.status='2'
			order by transaksi_pa.indate asc";

$result=mysql_query($query) or die(mysql_error());
$id_pinjam=1;
//proses menampilkan data
while($rows=mysql_fetch_object($result)){
					?>
					<tr>
						<td><?		echo $rows -> id_pinjam;?></td>
						<td><?		echo $rows -> indate;?></td>
						<td><?		echo $rows -> kembali;?></td>
						<td><?		echo $rows -> username;?></td>
						<td><?		echo $rows -> nama_laboran;?></td>
						<td><?		echo $rows -> kd_barang;?></td>
						<td><?		echo $rows -> nama_alat;?></td>
						<td><?		echo $rows -> jumlah;?></td>
						<td><?		echo $rows -> status;?></td>
					</tr>
					<?
}?>
				</tbody>
			</table>
			<p align='center'>
		<a href="rekap_kembali_cetak.php" cls='btn' onClick="window.print();return false"> <i class='icon-print'></i>Cetak </a>
			</p>
		</div>
	</body>
</html>
