<?php
	session_start();
	require("config/config.php");

	//Proses masuk
	//POST untuk variabel penting spt login
	if($_POST['submit_login']=='masuk'){

				// deklarasi variabel username dan password
				$user = $_POST['username'];
				$password = $_POST['password'];
				$pass = md5($password);

				//memberi backslash untuk mengamankan username n password dri hacker
				$user= mysql_real_escape_string($user);
				$pass = mysql_real_escape_string($pass);

				// Cek database
				$row = mysql_query("SELECT * from user where username='$user' AND password='$pass' ")  or die (mysql_error());
				$fetch = mysql_fetch_row($row);

				// selesi user
				if($fetch > 1){
					$type = "";
					// JUMLAH array nya 3 
					switch($fetch[3]){
						case 1:
							$type="admin";
						break;
						case 2:
							$type="laboran";
						break;
						case 3:
							$type="pegawai";
						break;
						case 4:
							$type="mhs";
						break;

					}

					// penyimpanan data pada session
					$id=$fetch[0];
					$query_detail = mysql_query("SELECT * from $type where id_user=$id ");
					$row_detail=mysql_fetch_row($query_detail);
					$_SESSION['nama']=$row_detail[1];
					$_SESSION['id']=$id;
					$_SESSION['username']=$fetch[1];
					$_SESSION['type']=$type;
					header("location:admin/index.php");

				}else{
					?>
					
					<script>
					function Redirect(){
						window.location = "masuk.php";
					}
					window.alert("Username dan Password Tidak Sesuai ");
					setTimeout('Redirect()', 100);
					
					</script>
					
					<?php
				}
	}else{
		

	}


?>