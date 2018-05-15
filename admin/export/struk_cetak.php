<?php		
			require_once '../inc/config.php';

		if(isset($_SESSION['username']) && isset($_POST['id_trans'])){
	
		$id = $_POST['id_trans'];
		$katg = $_POST['kategori'];
		$nama = $_POST['nama_user'];
		$laboran = $_POST['nama_laboran'];
		$prefix="pa";
		$jenis="alat";
		$p="barang";
		$indate="";
		$outdate="";
		if($katg=="bahan"){
			$prefix="pb";
			$jenis="bahan";
			$p="bahan";
		}
		$q=mysql_query("SELECT * FROM transaksi_".$prefix." WHERE id_pinjam='".$id."'");
		while($row=mysql_fetch_array($q)){
			$indate = $row['indate'];
			$outdate = $row['outdate'];
			
		}

			$query = "SELECT detail_".$prefix.".jumlah,id_alat,".$jenis.".nama FROM detail_".$prefix.",".$jenis." WHERE detail_".$prefix.".id_pinjam='".$id."' AND status=1 AND detail_".$prefix.".id_alat =".$jenis.".kd_".$p." ";
		
		//echo "SELECT detail_".$prefix.".jumlah,id_alat,".$jenis.".nama FROM detail_".$prefix.",".$jenis." WHERE detail_".$prefix.".id_pinjam='".$id."' AND status=1 AND detail_".$prefix.".id_alat =".$jenis.".kd_".$p."";
			$result = mysql_query($query) or die(mysql_error());
			$id_pinjam = 1;
			}
			?>
<html>
	<head>
		
	</head>
	<body>
		<div class='span8  offset2'>
		  <div style="width:500px;height:auto;margin:0 auto">
		  <table>
		  <tr rowspan="4"><td><img src="../images/logo-print.png" /></td><td><h3>Jurusan Teknik Ektro<br/>
		  Fakultas Teknik<br />
		  'Universitas Negeri Malang</h3>
		  <p>Jln Semarang No 5  Malang</p></td></tr></table><br/>
		  <div style="width:500px;height:2px;margin:10px 0;clear:both;display:block; background:#000;"></div><br/><h2 style="text-align:center;">Struk Peminjaman Alat & Barang</h2><br/>
		  <table>
			<tr>
				<td><strong>Unit</strong></td>
				<td>:</td>
				<td>Laboran</td>
			</tr>
			<tr>
				<td><strong>Nama</strong></td>
				<td>:</td>
				<td>'.$nama.'</td>
			</tr>
			<tr>
				<td><strong>NID</strong></td>
				<td>:</td>
				<td>'.$laboran.'</td>
			</tr>
			<tr>
				<td><strong>Tanggal Pinjam</strong></td>
				<td>:</td>
				<td>'.$indate.'</td>
			</tr>
			<tr>
				<td><strong>Tanggal Kembali</strong></td>
				<td>:</td>
				<td>'.$outdate.'</td>
			</tr>
		  </table>
		  <br/>
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
$query="SELECT detail_".$prefix.".jumlah,id_alat,".$jenis.".nama FROM detail_".$prefix.",".$jenis." WHERE detail_".$prefix.".id_pinjam='".$id."' AND status=1 AND detail_".$prefix.".id_alat =".$jenis.".kd_".$p." ";
		
		//echo "SELECT detail_".$prefix.".jumlah,id_alat,".$jenis.".nama FROM detail_".$prefix.",".$jenis." WHERE detail_".$prefix.".id_pinjam='".$id."' AND status=1 AND detail_".$prefix.".id_alat =".$jenis.".kd_".$p."";
$result=mysql_query($query) or die(mysql_error());
$pinjam=1;
//proses menampilkan data
while($rows=mysql_fetch_object($result)){
					?>
					<tr>
						<td><?		echo $rows -> jumlah;?></td>
						<td><?		echo $rows -> id_alat;?></td>
						<td><?		echo $rows -> nama;?></td>
					</tr>
					<?
}?>
				</tbody>
			</table>
			<p align='center'>
		<a href="struk_cetak.php" cls='btn' onClick="window.print();return false"> <i class='icon-print'></i>Cetak </a>
			</p>
		</div>
	</body>
</html>
