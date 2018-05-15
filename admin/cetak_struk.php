<?php
	session_start();
	require("../config/config.php");
	
	if(isset($_SESSION['username']) && isset($_POST['id_trans'])){

		// deklarasi variabel
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
		require_once("../includes/dompdf/dompdf_config.inc.php");
		 $html =
		  '<html><body>'.
		  '<div style="width:500px;height:auto;margin:0 auto">
		  <table>
		  <tr rowspan="4"><td><img src="../images/logo1.png" /></td><td><h3>Jurusan Teknik Ektro<br/>'.
		  'Fakultas Teknik<br />'.
		  'Universitas Negeri Malang</h3>'.
		  '<p>Jln Semarang No 5  Malang</p></td></tr></table><br/>'.
		  '<div style="width:500px;height:2px;margin:10px 0;clear:both;display:block; background:#000;"></div><br/><h2 style="text-align:center;">Struk Peminjaman Alat & Barang</h2>
		  <table>
			<tr>
				<td><strong>Unit</strong></td>
				<td>:</td>
				<td>Laboran</td>
			</tr>
			<tr>
				<td><strong>NIM/NIP</strong></td>
				<td>:</td>
				<td>'.$nama.'</td>
			</tr>
			<tr>
				<td><strong>Laboran</strong></td>
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
		  <table border="1">
			<tr>
				<td style="width:100px;"><strong>Qty</strong></td>
				<td style="width:100px;"><strong>Kode</strong></td>
				<td style="width:300px;"><strong>Nama</strong></td>
			</tr>';
		$q_detail=mysql_query("SELECT detail_".$prefix.".jumlah,id_alat,".$jenis.".nama FROM detail_".$prefix.",".$jenis." WHERE detail_".$prefix.".id_pinjam='".$id."' AND status=1 AND detail_".$prefix.".id_alat =".$jenis.".kd_".$p." ");
		
		
		
		while($row_detail=mysql_fetch_array($q_detail)){
		
		$html .='<tr>';
		$html .='<td><strong>';
		$html .= $row_detail['jumlah'];
		$html .='</strong></td>';
		$html .='<td><strong>';
		$html .= $row_detail['id_alat'];
		$html .='</strong></td>';
		$html .='<td><strong>';
		$html .= $row_detail['nama'];
		$html .='</strong></td>';
		$html .='</tr>';
		}
		 $html .='</table></div></body></html>';
		$dompdf = new DOMPDF();
		$dompdf->load_html($html);
		$dompdf->render();
		$dompdf->stream('struk_'.$id.'.pdf');
	}
?>