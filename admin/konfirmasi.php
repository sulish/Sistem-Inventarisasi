<?php
	
	session_start();
	require("../config/config.php");
	if(isset($_SESSION['username']) && isset($_SESSION['type']) ){
		
	if(isset($_SESSION['username'])){
		extract($_POST);

		// mendapatkan id transaksi bedasarakan urutan untuk Alat TA001 nomor 1 terakhir adalah urutan nomor
		if($type_brg == "Alat"){
			//Buat Kode transaksi untuk alat TA dan untuk bhp TB. selanjutnya diikuti dengan kode auto increment yang dibuat manual bukan dari database karena tipe varchar. caranya lihat jumlah recod transaksi tambahkan +1. artinya jika ada 10 transaksi maka transaksi berikutnya 11. hasilnya TA11 dst.
			$q=mysql_query("SELECT * FROM transaksi_pa order by no DESC limit 1");
			$row=mysql_fetch_row($q);
			
			// karena transaksi bisa dilakukan multi item maka untuk memperingkas coding dibuat kondisi dimana sama dengan sintaks di sql untuk multiple insert. INSERT into table (id,nama) VALUES (1,"abc"),(2,"DCE"),(3,"EFGH") dst. 
			//dimana hasinya nanti seperti ini  (1,'barang A'),(NULL,'barang B'),(NULL,'barang A')  yang dibuat dari perulangan berikut: 
			$id_trans = "TA0".($row[0]+1);
			$val ="";
			for($i=0;$i< sizeof($nama);$i++){
				$val .="(NULL,'".$id_trans."', '".$kode[$i]."', '".$jumlah[$i]."', '0')";
				if($i != (sizeof($nama) - 1)){
					$val .=",";
				}
			}
			// kemudian di query tinggal ditampilkan values dari nilai variable val.
			$query_det_pa = " INSERT INTO `detail_pa` (`no`, `id_pinjam`, `id_alat`, `jumlah`, `status`) VALUES ".$val."";
			$transaksi_pa = " INSERT INTO `transaksi_pa` (`no`, `id_pinjam`, `indate`, `outdate`, `id_user`,`id_lab`) VALUES ('','".$id_trans."','".date('Y-m-d')."','0000-00-00','".$id_user."','".$laboran_id."')";
			
			$exc_1 = mysql_query($query_det_pa);	
			$exc_2 = mysql_query($transaksi_pa);
			//mengecek apakah berhasi insert ke detail dan transaksi
			if($exc_1 && $exc_2){
				echo "<script>
					function Redirect(){
						window.location = 'pinjam.php';
					}
					window.alert('Peminjaman Telah dilakukan Silahkan Menunggu Konfirmasi ');
					setTimeout('Redirect()', 100);
			 
				</script>";
				
			}else{
				echo "<script>
					function Redirect(){
						window.location = 'pinjam.php';
					}
					window.alert('Peminjaman Gagal Silahkan Mengulang Kembali  ');
					setTimeout('Redirect()', 100);
			 
				</script>";
				
			}			
		}else if($type_brg=="Bahan"){
			$q=mysql_query("SELECT * FROM transaksi_pb order by no DESC limit 1");
			$row=mysql_fetch_row($q);
	
			$id_trans = "TB0".($row[0]+1);
			$val ="";
			for($i=0;$i< sizeof($nama);$i++){
				$val .="(NULL,'".$id_trans."', '".$kode[$i]."', '".$jumlah[$i]."', '0')";
				if($i != (sizeof($nama) - 1)){
					$val .=",";
				}
			}
			$query_det_pb = " INSERT INTO `detail_pb` (`no`, `id_pinjam`, `id_alat`, `jumlah`, `status`) VALUES ".$val."";
			$transaksi_pb = " INSERT INTO `transaksi_pb` (`no`, `id_pinjam`, `indate`, `outdate`, `id_user`,`id_lab`) VALUES ('','".$id_trans."','".date('Y-m-d')."','0000-00-00','".$id_user."','".$laboran_id."')";
			
			$exc_1 = mysql_query($query_det_pb);	
			$exc_2 = mysql_query($transaksi_pb);
			if($exc_1 && $exc_2){
				echo "<script>
					function Redirect(){
						window.location = 'pinjam.php';
					}
					window.alert('Peminjaman Telah dilakukan Silahkan Menunggu Konfirmasi ');
					setTimeout('Redirect()', 100);
			 
				</script>";
				
			}else{
				echo "<script>
					function Redirect(){
						window.location = 'pinjam.php';
					}
					window.alert('Peminjaman Gagal Silahkan Mengulang Kembali  ');
					setTimeout('Redirect()', 100);
			 
				</script>";
				
			}			
			
		}else{
				echo "<script>
					function Redirect(){
						window.location = 'pinjam.php';
					}
					window.alert('Peminjaman Gagal Silahkan Mengulang Kembali  ');
					setTimeout('Redirect()', 100);
			 
				</script>";	
		}
		
	}
	
?>
<?php
	 }else{
	 	header("location:../masuk.php");

	}
?>
