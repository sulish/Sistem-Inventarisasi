<?php
	error_reporting(0);
	ob_start();
	session_start();
	require("../config/config.php");
	if(isset($_SESSION['username']) && isset($_SESSION['type']) ){
	require("../includes/admin_header.php");
	require("../includes/admin_sidebar.php");
?>

		<div class="content-block">
		<?php
			// deklarasi aksi dan type alat atau bahan
			$act = $_REQUEST['act'];
			$type = $_REQUEST['type'];
			
			// seleksi aksi tambah, lihat, hapus dan delete
			switch($act){
				case "tambah" :
					require("reg_data.php");
				break;
				case "daftar" :
					require("daftar.php");
				break;
				case "delete":
					$kode=$_REQUEST['id'];
					switch($type){
					case "barang":
						$query=mysql_query("DELETE FROM alat WHERE kd_barang='$kode'")or die (mysql_error());
					
						if($query){
							
							header("location:tambah_data.php?act=daftar&type=ab");
							
						}
					break;
					case "bahan" :
						$query=mysql_query("DELETE FROM bahan WHERE kd_bahan='$kode'")or die (mysql_error());
						
						if($query){
							header("location:tambah_data.php?act=daftar&type=bhp");
							
						}
					break;
					default :
						echo "Halaman 404. Maaf Data Tidak Ditemukan !";
					}
				break;
				case "edit" :
					require("edit_alat.php");
				break;
				default:
			}
		?>
		
		</div>
		
		</div>

	</body>
</html>
<?php
	 }else{
	 	header("location:../masuk.php");

	}
?>
