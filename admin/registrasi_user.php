<?php
	
	if(isset($_POST['tambah_data'])){
		
		extract($_POST);

		if($type_form =="mahasiswa"){
			if(($username !="") && ($password !="") && ($nama !="") && ($nim !="") && ($jk !="") && ($ttl !="") && ($alamat !="")){
				$password = md5($password);
				$user=mysql_query("INSERT INTO user (username,password,status) VALUES('$username','$password','4')") or die (mysql_error());
				$id_user=mysql_query("SELECT LAST_INSERT_ID() INTO @user");

				// menambahkan berdasarkan last id yang disimpan
				$query = mysql_query("INSERT into mhs VALUES('','$nama','$nim','$jk','$ttl','$alamat','$prodi','$angkatan','$kelas','$email','$telpon','',@user) ") or die (mysql_error());
				if($query){
				?>
					<div class="alert alert-success"><b>Sukses!</b> Data Mahasiswa Berhasil Ditambahkan.</div>
					<script type="text/javascript">
						//window.alert("data berhasil dimasukkan");
						
					</script>
				<?php
				}
			}  else{
			?>
				<div class="alert alert-warning"><b>Data Harus Diisi, Cek Kembali</b></div>
				<script type="text/javascript">
						//window.alert("Data Harus Diisi Semua, Cek Kembali");
				</script>
			<?php
			} 
		
		}else if($type_form =="pegawai"){
			if(($username !="") && ($password !="") && ($nama !="") && ($nip !="") && ($jk !="") && ($ttl !="") && ($alamat !="") && ($jabatan !="") && ($kategori !="")){
				$password=md5($password);

				if($kategori=="pegawai"){
					$user=mysql_query("INSERT INTO user (username,password,status) VALUES('$username','$password','3')") or die (mysql_error());
					$id_user=mysql_query("SELECT LAST_INSERT_ID() INTO @user");

					$query = mysql_query("INSERT into pegawai VALUES('','$nama','$nip','$jk','$ttl','$alamat','$jabatan','$email','$telpon','',@user) ") or die (mysql_error());
				}else{
					$user=mysql_query("INSERT INTO user (username,password,status) VALUES('$username','$password','2')") or die (mysql_error());
					$id_user=mysql_query("SELECT LAST_INSERT_ID() INTO @user");

					$query = mysql_query("INSERT into laboran VALUES('','$nama','$nip','$jk','$ttl','$alamat','$jabatan','$email','$telpon','$id_dep','',@user) ") or die (mysql_error());
				}

				if($query){
				?>
					<div class="alert alert-success"><b>Sukses!</b> Data Pegawai Berhasil Ditambahkan.</div>
					<script type="text/javascript">
						//window.alert("data berhasil dimasukkan");
						
					</script>
				<?php
				}
			}  else{
			?>
				<div class="alert alert-warning"><b>Data Harus Diisi, Cek Kembali</b></div>
				<script type="text/javascript">
						//window.alert("Data Harus Diisi Semua, Cek Kembali");
				</script>
			<?php
			} 
		}else if($type_form =="admin"){
			if(($username !="") && ($password !="") && ($nama !="") && ($nid !="") && ($email !="")){
				$password=md5($password);
					$user=mysql_query("INSERT INTO user (username,password,status) VALUES('$username','$password','1')") or die (mysql_error());
					$id_user=mysql_query("SELECT LAST_INSERT_ID() INTO @user");

					$query = mysql_query("INSERT into admin VALUES('','$nama','$nid','$email','','',@user) ") or die (mysql_error());
				if($query){
				?>
					<div class="alert alert-success"><b>Sukses!</b> Data Administrator Berhasil Ditambahkan.</div>
					<script type="text/javascript">
						//window.alert("data berhasil dimasukkan");
						
					</script>
				<?php
				}
			}  else{
			?>
				<div class="alert alert-warning"><b>Data Harus Diisi, Cek Kembali</b></div>
				<script type="text/javascript">
						//window.alert("Data Harus Diisi Semua, Cek Kembali");
				</script>
			<?php
			} 
		}
	}
	

	
?>
<?php
	//require("../config/config.php");
	switch($type){
		case 'mhs';
?>

			<h3> Tambah Data Mahasiswa</h3><br>
			<form class="form-horizontal" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" onsubmit="return validasi_input(this)" style="width:35%"  >
			<input type="hidden" value="mahasiswa" name="type_form" />
			<div class="control-group" style="height: 50px;">	
			<label class="control-label" for="inputusername">Username</label>
			<div class="controls">
			  <input type="text"  id="username_register" name="username" readonly="readonly" required="true" value="<?php if(isset($_POST['username'])){ echo $_POST['username']; } ?>" placeholder="Username" style="height:30px; width:400px !important">
			</div>
		  </div>
		  <div class="control-group">
			<label class="control-label" for="inputPassword">Password</label>
			<div class="controls">
			  <input type="password" id="inputPassword" name="password" required="true" placeholder="Password" style="height:30px; width:400px !important">
			</div>
		  </div>
		   <div class="control-group">
			<label class="control-label" for="inputNama">Nama Lengkap</label>
			<div class="controls">
			  <input type="text" id="inputNama" name="nama" required="true" value="<?php if(isset($_POST['nama'])){ echo $_POST['nama']; } ?>" placeholder="Nama Lengkap" style="height:30px; width:400px !important"> 
			</div>
		  </div>
			<div class="control-group">
			<label class="control-label" for="inputNim">NIM</label>
			<div class="controls">
			  <input type="text" name="nim" id="id_register" maxlength="12" required="true" value="<?php if(isset($_POST['nim'])){ echo $_POST['nim']; } ?>" placeholder="NIM" style="height:30px; width:400px !important">
			</div>
		  </div>
		  <div class="control-group">
			<label class="control-label" for="inputJK">Jenis Kelamin</label>
			<div class="controls">
					<select class="form-control" name="jk" id="search-option" required="true" value="<?php if(isset($_POST['jk'])){ echo $_POST['jk']; } ?>" style="width:400px !important">
					<option value="laki">Laki-Laki</option>
					<option value="perempuan">Perempuan</option>
					</select>
			</div>
		  </div>
		  <div class="control-group">
			<label class="control-label" for="inputtl">Tanggal Lahir</label>
			<div class="controls">
			  <input type="date" id="ttl" name="ttl" id="inputtl" required="true" value="<?php if(isset($_POST['ttl'])){ echo $_POST['ttl']; } ?>" placeholder="Tanggal Lahir" style="height:30px; width:400px !important">
			</div>
		  </div>
		  <div class="control-group">
			<label class="control-label" for="inputProdi">Prodi</label>
			<div class="controls">
					<select class="form-control" name="prodi" id="search-option" required="true" value="<?php if(isset($_POST['prodi'])){ echo $_POST['prodi']; } ?>" style="width:400px !important">
					<option value="TE">S1 Teknik Elektro</option>
					<option value="PTE">S1 Pendidikan Teknik Elektro</option>
					<option value="DTE">D3 Teknik Elektro</option>
					<option value="DIKA">D3 Teknik Elektronika</option>
					<option value="PTI">S1 Pendidikan Teknik Informatika</option>
					<option value="TI">S1 Teknik Informatika</option>
					</select>
			</div>
		  </div>
		  <div class="control-group">
			<label class="control-label" for="inputkondisi">Angkatan</label>
			<div class="controls">
				<select class="form-control" name="angkatan" id="input angkatan" required="true" value="<?php if(isset($_POST['angkatan'])){ echo $_POST['angkatan']; } ?>" style="width:400px !important">
				<option selected="selected">Angkatan</option>
				<?php
				for($i=date('Y'); $i>=date('Y')-10; $i-=1){
				echo"<option value='$i'> $i </option>";
				}
				?>
				</select>
			</div>
		  </div>
		   <div class="control-group">
			<label class="control-label" for="inputKelas">Kelas</label>
			<div class="controls">
			  <input type="text" id="inputKelas" name="kelas" required="true" value="<?php if(isset($_POST['kelas'])){ echo $_POST['kelas']; } ?>" placeholder="Kelas" style="height:30px; width:400px !important">
			</div>
		  </div>
		   <div class="control-group">
			<label class="control-label" for="inputNim">Alamat</label>
			<div class="controls">
			  <textarea id="inputalamat"name="alamat" required="true" value="<?php if(isset($_POST['alamat'])){ echo $_POST['alamat']; } ?>" placeholder="alamat" class="form-control" rows="3" style="width:400px !important"></textarea> 
			</div>
		  </div>
		   <div class="control-group">
			<label class="control-label" for="inputEmail">Email</label>
			<div class="controls">
			  <input type="email"  name="email" id="inputEmail" required="true" value="<?php if(isset($_POST['email'])){ echo $_POST['email']; } ?>" placeholder="Email" style="height:30px; width:400px !important">
			</div>
		  </div>
		   <div class="control-group">
			<label class="control-label" for="inputtlp">Telepon</label>
			<div class="controls">
			  <input type="number" name="telpon" id="inputtlp" required="true" value="<?php if(isset($_POST['telpon'])){ echo $_POST['telpon']; } ?>" placeholder="Telepon" style="height:30px; width:400px !important">
			</div>
		  </div>
		  <div class="controls">
		<!--  <div class="form-actions"> -->
		  <button type="submit" class="btn btn-primary" name="tambah_data" value="simpan">Simpan</button>
		  <button type="button" class="btn btn-default" id="reset_btn">Reset</button>
		<!-- </div> -->
		</div>
		</form>


		<h4>Import Data User Mahasiswa. Pastikan field sesuai</h4>
		 <form method="post" enctype="multipart/form-data" action="proses_mhs.php">
		 <div class="control-group">
    	<label class="control-label" for="inputruang"> Silakan Pilih File Excel :</label>
    	<div class="controls">
      	 <input name="userfile" type="file">
		 <input name="upload" type="submit" value="import">
		</div>
  			</div>
		 </form>
		
		<?php
		break;
		case 'peg';
		?>
			<h3> Tambah Data Pegawai</h3>
			<form class="form-horizontal" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" style="width:35%">
			
			<input type="hidden" value="pegawai" name="type_form" />
			<div class="control-group" style="height: 50px;">	
			<label class="control-label" for="inputusername">Username</label>
			<div class="controls">
			  <input type="text"  id="username_register" name="username" readonly="readonly" required="true" value="<?php if(isset($_POST['username'])){ echo $_POST['username']; } ?>" placeholder="Username" style="height:30px; width:400px !important">
			</div>
		  </div>
		  <div class="control-group">
			<label class="control-label" for="inputPassword">Password</label>
			<div class="controls">
			  <input type="password" id="inputPassword" name="password" required="true" placeholder="Password" style="height:30px; width:400px !important">
			</div>
		  </div>
		   <div class="control-group">
			<label class="control-label" for="inputNama">Nama Lengkap</label>
			<div class="controls">
			  <input type="text" id="inputNama" name="nama" required="true" value="<?php if(isset($_POST['nama'])){ echo $_POST['nama']; } ?>" placeholder="Nama Lengkap" style="height:30px; width:400px !important">
			</div>
		  </div>
			<div class="control-group">
			<label class="control-label" for="inputID">NIP/ID</label>
			<div class="controls">
			  <input type="number" id="id_register" maxlength="18" name="nip" required="true" value="<?php if(isset($_POST['nip'])){ echo $_POST['nip']; } ?>" placeholder="NIP/ID" style="height:30px; width:400px !important">
			</div>
		  </div>
		  <div class="control-group">
			<label class="control-label" for="inputJK">Jenis Kelamin</label>
			<div class="controls">
					<select class="form-control" name="jk" id="search-option" required="true" value="<?php if(isset($_POST['jk'])){ echo $_POST['jk']; } ?>" style="width:400px !important">
					<option value="laki">Laki-Laki</option>
					<option value="perempuan">Perempuan</option>
					</select>
			</div>
		  </div>
		  <div class="control-group">
			<label class="control-label" for="inputtl">Tanggal Lahir</label>
			<div class="controls">
			  <input type="date" name="ttl" id="inputtl" required="true" value="<?php if(isset($_POST['ttl'])){ echo $_POST['ttl']; } ?>" placeholder="Tanggal Lahir" style="height:30px; width:400px !important">
			</div>
		  </div>
		  <div class="control-group">
			<label class="control-label" for="inputProdi">Hak Akses</label>
			<div class="controls">
					<select class="form-control" name="kategori" id="hak_akses" required="true" value="<?php if(isset($_POST['kategori'])){ echo $_POST['kategori']; } ?>" style="width:400px !important">
					<option value="pegawai">Pegawai / Dosen</option>
					<option value="laboran">Laboran</option>
					</select>
			</div>
			</div>
			 <div class="control-group" id="ruangan" style="display:none;">
			<label class="control-label" for="inputruang">Ruangan</label>
			<div class="controls">
					<select class="form-control" name="id_dep" id="inputRuang" required="true" value="<?php if(isset($_POST['kategori'])){ echo $_POST['kategori']; } ?>" style="width:400px !important">
					<?php
					$query=mysql_query("SELECT * FROM kantor");
					while ($h=mysql_fetch_array($query)) {
						echo "<option value=$h[id_dep]>$h[nama]</option>";
					}
					?>
					</select>
			</div>
			</div>
		
		   <div class="control-group">
			<label class="control-label" for="inputNim">Alamat</label>
			<div class="controls">
			  <textarea id="inputalamat" name="alamat" required="true" value="<?php if(isset($_POST['alamat'])){ echo $_POST['alamat']; } ?>" placeholder="Alamat" class="form-control" rows="3" style="width:400px !important"></textarea> 
			</div>
		  </div>
		   <div class="control-group">
			<label class="control-label" for="inputEmail">Email</label>
			<div class="controls">
			  <input type="email" id="inputEmail" name="email" required="true" value="<?php if(isset($_POST['email'])){ echo $_POST['email']; } ?>" placeholder="Email" style="height:30px; width:400px !important">
			</div>
		  </div>
		     <div class="control-group">
			<label class="control-label" for="inputProdi">Jabatan</label>
			<div class="controls">
					<select class="form-control" name="jabatan" id="search-option" required="true" value="<?php if(isset($_POST['jabatan'])){ echo $_POST['jabatan']; } ?>" style="width:400px !important">
					<option value="pegawai">Pegawai </option>
					<option value="dosen">Dosen</option>
					<option value="tenaga-kependidikan">Tenaga Kependidikan</option>
					</select>
			</div>
			</div>
		
		   <div class="control-group">
			<label class="control-label" for="inputtlp">Telepon</label>
			<div class="controls">
			  <input type="number" id="inputtlp" name="telpon" required="true" value="<?php if(isset($_POST['telpon'])){ echo $_POST['telpon']; } ?>" placeholder="Telepon" style="height:30px; width:400px !important">
			</div>
		  </div>
		  <div class="controls">
		<!--  <div class="form-actions"> -->
		  <button type="submit" class="btn btn-primary" name="tambah_data" value="simpan">Simpan</button>
		  <button type="button" class="btn btn-default" id="reset_btn">Reset</button>
		<!-- </div> -->
		</div>
		</form>
		<?php
		break;
		case 'admin';
		?>
			<h3> Tambah Data Administrator</h3>
			<form class="form-horizontal" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" style="width:35%">
			
			<input type="hidden" value="admin" name="type_form" />
			<div class="control-group" style="height: 50px;">	
			<label class="control-label" for="inputusername">Username</label>
			<div class="controls">
			  <input type="text"  id="username_register" name="username" readonly="readonly" required="true" value="<?php if(isset($_POST['username'])){ echo $_POST['username']; } ?>" placeholder="Username" style="height:30px; width:400px !important">
			</div>
		  </div>
		  <div class="control-group">
			<label class="control-label" for="inputPassword">Password</label>
			<div class="controls">
			  <input type="password" id="inputPassword" name="password" required="true" placeholder="Password" style="height:30px; width:400px !important">
			</div>
		  </div>
		   <div class="control-group">
			<label class="control-label" for="inputNama">Nama Lengkap</label>
			<div class="controls">
			  <input type="text" id="inputNama" name="nama" required="true" value="<?php if(isset($_POST['nama'])){ echo $_POST['nama']; } ?>" placeholder="Nama Lengkap" style="height:30px; width:400px !important">
			</div>
		  </div>
			<div class="control-group">
			<label class="control-label" for="inputID">No. ID Admin</label>
			<div class="controls">
			  <input type="number" id="id_register" maxlength="18" name="nid" required="true" value="<?php if(isset($_POST['nip'])){ echo $_POST['nip']; } ?>" placeholder="NIP/ID" style="height:30px; width:400px !important">
			</div>
		  </div>
		   <div class="control-group">
			<label class="control-label" for="inputEmail">Email</label>
			<div class="controls">
			  <input type="email" id="inputEmail" name="email" required="true" value="<?php if(isset($_POST['email'])){ echo $_POST['email']; } ?>" placeholder="Email" style="height:30px; width:400px !important">
			</div>
		  </div>
		   <div class="controls">
		<!--  <div class="form-actions"> -->
		  <button type="submit" class="btn btn-primary" name="tambah_data" value="simpan">Simpan</button>
		  <button type="button" class="btn btn-default" id="reset_btn">Reset</button>
		<!-- </div> -->
		</div>
		</form>
		<?php
		break;
		default:
		
	}
?>

<!-- js untuk menampilkan ruangan berdasarkan id hak akses -->
<script type="text/javascript">
$("#hak_akses").on("change",function(){
	if($(this).val()== "laboran"){
		$("#ruangan").show("fast");
	}else{
		$("#ruangan").hide("fast");
	}

});

// reset form
$("#reset_btn").on("click",function(){
	$("#username_register").val("");
	$("#inputPassword").val("");
	$("#inputNama").val("");
	$("#id_register").val("");
	$("#inputAngkatan").val("");
	$("#inputtl").val("");
	$("#inputKelas").val("");
	$("#inputalamat").val("");
	$("#inputEmail").val("");
	$("#inputtlp").val("");
});

</script>