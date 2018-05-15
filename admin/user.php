<?php
	ob_start();
	session_start();
	require("../config/config.php");
	if(isset($_SESSION['username']) && isset($_SESSION['type']) ){
	require("../includes/admin_header.php");
	require("../includes/admin_sidebar.php");
?>

		<div class="content-block">
		<?php
			// deklarasi aksi dan type user
			$act = $_REQUEST['act'];
			$type = $_REQUEST['type'];
			
			// deklarasi untuk aksi daftar, delete,lihat
			switch($act){
				case "registrasi" :
					require("registrasi_user.php");
				break;
				case "daftar" :
					require("daftar_user.php");
							break;
				case "delete":
					$kode=$_REQUEST['id'];
					switch($type){
					case "mhs":
						$a=mysql_fetch_array(mysql_query("SELECT nim from mhs where id_mem='$kode'"));
						$nim=$a['nim'];


						$query=mysql_query("DELETE FROM mhs WHERE id_mem='$kode'")or die (mysql_error());
						$user=mysql_query("DELETE FROM user Where username='$nim'");

						if($query){
							header("location:user.php?act=daftar&type=mhs");
							
						}
					break;
					case "peg" :
						$a=mysql_fetch_array(mysql_query("SELECT nip from pegawai where id_peg='$kode'"));
						$nip=$a['nip'];

						$query=mysql_query("DELETE FROM pegawai WHERE id_peg='$kode'")or die (mysql_error());
						$user=mysql_query("DELETE FROM user Where username='$nip'");

						if($query){
							header("location:user.php?act=daftar&type=peg");
							
						}
					break;
					case "laboran" :
						$a=mysql_fetch_array(mysql_query("SELECT nip from laboran where id_lab='$kode'"));
						$nip=$a['nip'];

						$query=mysql_query("DELETE FROM laboran WHERE id_lab='$kode'")or die (mysql_error());
						$user=mysql_query("DELETE FROM user Where username='$nip'");

						if($query){
							header("location:user.php?act=daftar&type=laboran");
							
						}
					break;
					case "admin" :
						$a=mysql_fetch_array(mysql_query("SELECT nip from admin where id_admin='$kode'"));
						$nid=$a['nid'];

						$query=mysql_query("DELETE FROM admin WHERE id_admin='$kode'")or die (mysql_error());
						$user=mysql_query("DELETE FROM user Where username='$nid'");

						if($query){
							header("location:user.php?act=daftar&type=admin");
							
						}
					break;
					default :
						echo "Halaman 404. Maaf Data Tidak Ditemukan !";
					}
				break;
				case "edit" :
					require("edit_user.php");
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

