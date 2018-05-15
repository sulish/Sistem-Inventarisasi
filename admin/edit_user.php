<?php
	require("../config/config.php");
	$tipe=$_REQUEST['type'];
	$kode = $_REQUEST['id'];
	if($tipe == "mhs"){

	$hasil=mysql_query("SELECT
		`user`.id_user,
		`user`.username,
		mhs.id_mem,
		mhs.nama,
		mhs.nim,
		mhs.sex,
		mhs.ttl,
		mhs.alamat,
		mhs.prodi,
		mhs.angkatan,
		mhs.kelas,
		mhs.email,
		mhs.tlp,
		mhs.foto
		FROM
		`user`
		INNER JOIN mhs ON `user`.id_user = mhs.id_user where mhs.id_mem='$kode'") or die (mysql_error());
	$x=mysql_fetch_array($hasil);
?>	  
		<div class="content-block">
		
		<h2>UPDATE DATA USER : MAHASISWA</h2>
        <form class="form-horizontal" method="post" action= "<?php $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data" style="width:35%"  >
				<div class="control-group" style="height: 50px;">	
					<label class="control-label" for="inputusername">Username</label>
					<div class="controls">
			  			<input type="text" name="username" id="username_register" readonly="readonly" value="<?php echo $x['username'];?>" placeholder="Username" style="height:30px; width:400px !important">
					</div>
		  		</div>

		   		<div class="control-group">
					<label class="control-label" for="inputNama">Nama Lengkap</label>
					<div class="controls">
					  <input type="text" name="nama" value="<?php echo $x['nama'];?>" placeholder="Nama Lengkap" style="height:30px; width:400px !important">
					</div>
				</div>

				<div class="control-group">
					<label class="control-label" for="inputNim">NIM</label>
					<div class="controls">
						<input type="text" name="nim" id="id_register" value="<?php echo $x['nim'];?>" placeholder="NIM" style="height:30px; width:400px !important">
					</div>
				</div>

			  	<div class="control-group">
					<label class="control-label" for="inputJK">Jenis Kelamin</label>
					<div class="controls">
						<select class="form-control" name="sex" id="search-option" value="<?php echo $x['sex'];?>" style="width:400px !important">
						<option value="laki">Laki-Laki</option>
						<option value="perempuan">Perempuan</option>
						</select>
					</div>
			  	</div>

				<div class="control-group">
					<label class="control-label" for="inputtl">Tanggal Lahir</label>
					<div class="controls">
					  <input type="date" name="ttl" id="inputtl" value="<?php echo $x['ttl'];?>" placeholder="Tanggal Lahir" style="height:30px; width:400px !important">
					</div>
				</div>

				<div class="control-group">
					<label class="control-label" for="inputProdi">Prodi</label>
					<div class="controls">
						<select class="form-control" name="prodi" id="search-option" value="<?php echo $x['prodi'];?>" style="width:400px !important">
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
					<select class="form-control" name="angkatan" id="inputAngkatan" value="<?php echo $x['angkatan'];?>" style="width:400px !important">
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
					  <input type="text" id="inputKelas" name="kelas" value="<?php echo $x['kelas'];?>" placeholder="Kelas" style="height:30px; width:400px !important">
					</div>
				</div>

			   	<div class="control-group">
					<label class="control-label" for="inputNim">Alamat</label>
					<div class="controls">
				  		<textarea name="alamat" value="<?php echo $x['alamat'];?>" placeholder="alamat" class="form-control" rows="3" style="width:400px !important"></textarea> 
					</div>
			  	</div>

				<div class="control-group">
					<label class="control-label" for="inputEmail">Email</label>
					<div class="controls">
					  <input type="email"  name="email" id="inputEmail" value="<?php echo $x['email'];?>" placeholder="Email" style="height:30px; width:400px !important">
					</div>
				</div>

				<div class="control-group">
					<label class="control-label" for="inputtlp">Telepon</label>
					<div class="controls">
					  <input type="text" name="tlp" id="inputtlp" value="<?php echo $x['tlp'];?>" placeholder="Telepon" style="height:30px; width:400px !important">
					</div>
				</div>

				

			  	<div class="controls">
			<!--  <div class="form-actions"> -->
			  		 <input type="hidden" name="username" value="<?php echo $x['username'];?>">
		  			 <button type="submit" class="btn btn-primary" name="edit_data" value="edit_mhs">Simpan</button>
			<!-- </div> -->
				</div>

		</form>
	</div>

	<?php
		
	}else if($tipe=="peg"){
		
		$peg=mysql_query("SELECT
		`user`.id_user,
		`user`.username,
		pegawai.id_peg,
		pegawai.nama,
		pegawai.nip,
		pegawai.sex,
		pegawai.ttl,
		pegawai.alamat,
		pegawai.jabatan,
		pegawai.email,
		pegawai.tlp,
		pegawai.foto
		FROM
		`user`
		INNER JOIN pegawai ON `user`.id_user = pegawai.id_user where id_peg='$kode'");
		$y=mysql_fetch_array($peg);
	?>

	<div class="content-block">
		
		<h2> UPDATE DATA USER PEGAWAI </h2>
        <form class="form-horizontal" method="post" action= "<?php $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data" style="width:35%"  >
				<div class="control-group" style="height: 50px;">	
					<label class="control-label" for="inputusername">Username</label>
					<div class="controls">
			  			<input type="text" name="username" id="username_register" readonly="readonly" value="<?php echo $y['username'];?>" placeholder="Username" style="height:30px; width:400px !important">
					</div>
		  		</div>

		   		<div class="control-group">
					<label class="control-label" for="inputNama">Nama Lengkap</label>
					<div class="controls">
					  <input type="text" name="nama" value="<?php echo $y['nama'];?>" placeholder="Nama Lengkap" style="height:30px; width:400px !important">
					</div>
				</div>

				<div class="control-group">
					<label class="control-label" for="inputNim">NIP</label>
					<div class="controls">
						<input type="text" name="nip" id="id_register" value="<?php echo $y['nip'];?>" placeholder="NIP" style="height:30px; width:400px !important">
					</div>
				</div>

			  	<div class="control-group">
					<label class="control-label" for="inputJK">Jenis Kelamin</label>
					<div class="controls">
						<select class="form-control" name="sex" id="search-option" value="<?php echo $y['sex'];?>" style="width:400px !important">
						<option value="laki">Laki-Laki</option>
						<option value="perempuan">Perempuan</option>
						</select>
					</div>
			  	</div>

				<div class="control-group">
					<label class="control-label" for="inputtl">Tanggal Lahir</label>
					<div class="controls">
					  <input type="date" name="ttl" id="inputtl" value="<?php echo $y['ttl'];?>" placeholder="Tanggal Lahir" style="height:30px; width:400px !important">
					</div>
				</div>

			   	<div class="control-group">
					<label class="control-label" for="inputNim">Alamat</label>
					<div class="controls">
				  		<textarea name="alamat" value="<?php echo $y['alamat'];?>" placeholder="alamat" class="form-control" rows="3" style="width:400px !important"></textarea> 
					</div>
			  	</div>

			  	 <div class="control-group">
			<label class="control-label" for="inputProdi">Jabatan</label>
			<div class="controls">
					<select class="form-control" name="jabatan" id="search-option" value= "<?php echo $y['jabatan'];?>" style="width:400px !important">
					<option value="pegawai">Pegawai </option>
					<option value="dosen">Dosen</option>
					<option value="tenaga-kependidikan">Tenaga Kependidikan</option>
					</select>
			</div>
			</div>

				<div class="control-group">
					<label class="control-label" for="inputEmail">Email</label>
					<div class="controls">
					  <input type="email"  name="email" id="inputEmail" value="<?php echo $y['email'];?>" placeholder="Email" style="height:30px; width:400px !important">
					</div>
				</div>

				<div class="control-group">
					<label class="control-label" for="inputtlp">Telepon</label>
					<div class="controls">
					  <input type="text" name="tlp" id="inputtlp" value="<?php echo $y['tlp'];?>" placeholder="Telepon" style="height:30px; width:400px !important">
					</div>
				</div>

				

			  	<div class="controls">
			<!--  <div class="form-actions"> -->
			  		 <input type="hidden" name="username" value="<?php echo $y['username'];?>">
		  			 <button type="submit" class="btn btn-primary" name="edit_data" value="edit_peg">Simpan</button>
			<!-- </div> -->
				</div>

		</form>
        </div>

    <?php
		
	}else if($tipe=="laboran"){
		$query=mysql_query("SELECT
		`user`.id_user,
		`user`.username,
		laboran.nama,
		laboran.nip,
		laboran.sex,
		laboran.ttl,
		laboran.alamat,
		laboran.jabatan,
		laboran.email,
		laboran.tlp,
		laboran.id_dep,
		laboran.foto,
		laboran.id_lab
		FROM
		`user`
		INNER JOIN laboran ON `user`.id_user = laboran.id_user where id_lab='$kode'");
		$y=mysql_fetch_array($query);
	?>

	<div class="content-block">
		
		<h2>UPDATE DATA LABORAN</h2><br>
        <form class="form-horizontal" method="post" action= "<?php $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data" style="width:35%"  >
				<div class="control-group" style="height: 50px;">	
					<label class="control-label" for="inputusername">Username</label>
					<div class="controls">
			  			<input type="text" name="username" id="username_register" readonly="readonly" value="<?php echo $y['username'];?>" placeholder="Username" style="height:30px; width:400px !important">
					</div>
		  		</div>

		   		<div class="control-group">
					<label class="control-label" for="inputNama">Nama Lengkap</label>
					<div class="controls">
					  <input type="text" name="nama" value="<?php echo $y['nama'];?>" placeholder="Nama Lengkap" style="height:30px; width:400px !important">
					</div>
				</div>

				<div class="control-group">
					<label class="control-label" for="inputNim">NIP</label>
					<div class="controls">
						<input type="text" name="nip" id="id_register" value="<?php echo $y['nip'];?>" placeholder="NIP" style="height:30px; width:400px !important">
					</div>
				</div>

			  	<div class="control-group">
					<label class="control-label" for="inputJK">Jenis Kelamin</label>
					<div class="controls">
						<select class="form-control" name="sex" id="search-option" value="<?php echo $y['sex'];?>" style="width:400px !important">
						<option value="laki">Laki-Laki</option>
						<option value="perempuan">Perempuan</option>
						</select>
					</div>
			  	</div>

				<div class="control-group">
					<label class="control-label" for="inputtl">Tanggal Lahir</label>
					<div class="controls">
					  <input type="date" name="ttl" id="inputtl" value="<?php echo $y['ttl'];?>" placeholder="Tanggal Lahir" style="height:30px; width:400px !important">
					</div>
				</div>

			   	<div class="control-group">
					<label class="control-label" for="inputNim">Alamat</label>
					<div class="controls">
				  		<textarea name="alamat" value="<?php echo $y['alamat'];?>" placeholder="alamat" class="form-control" rows="3" style="width:400px !important"></textarea> 
					</div>
			  	</div>

			  	<div class="control-group">
			<label class="control-label" for="inputProdi">Jabatan</label>
			<div class="controls">
					<select class="form-control" name="jabatan" id="search-option" value= "<?php echo $y['jabatan'];?>" style="width:400px !important">
					<option value="pegawai">Pegawai </option>
					<option value="dosen">Dosen</option>
					<option value="tenaga-kependidikan">Tenaga Kependidikan</option>
					</select>
			</div>
			</div>

			 <div class="control-group" id="ruangan">
			<label class="control-label" for="inputruang">Ruangan</label>
			<div class="controls">
					<select class="form-control" name="id_dep" id="inputRuang" value= "<?php echo $y['id_dep'];?>" style="width:400px !important">
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
					<label class="control-label" for="inputEmail">Email</label>
					<div class="controls">
					  <input type="email"  name="email" id="inputEmail" value="<?php echo $y['email'];?>" placeholder="Email" style="height:30px; width:400px !important">
					</div>
				</div>

				<div class="control-group">
					<label class="control-label" for="inputtlp">Telepon</label>
					<div class="controls">
					  <input type="text" name="tlp" id="inputtlp" value="<?php echo $y['tlp'];?>" placeholder="Telepon" style="height:30px; width:400px !important">
					</div>
				</div>

				

			  	<div class="controls">
			<!--  <div class="form-actions"> -->
			  		<input type="hidden" name="username" value="<?php echo $y['username'];?>">
		  			<button type="submit" class="btn btn-primary" name="edit_data" value="edit_laboran">Simpan</button>
			<!-- </div> -->
				</div>

		</form>
        </div>

	<?php
		
	}else if($tipe=="admin"){
		$query = mysql_query("SELECT
		`user`.id_user,
		`user`.username,
		admin.nama,
		admin.id_admin,
		admin.nid,
		admin.email,
		admin.foto
		FROM
		`user`
		INNER JOIN admin ON `user`.id_user = admin.id_user where id_admin='$kode'");
		$x = mysql_fetch_array($query);
	?>

	<div class="content-block">
		
		<h2>UPDATE DATA ADMINISTRATOR</h2><br>
        <form class="form-horizontal" method="post" action= "<?php $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data" style="width:35%"  >
				<div class="control-group" style="height: 50px;">	
					<label class="control-label" for="inputusername">Username</label>
					<div class="controls">
			  			<input type="text" name="username" id="username_register" readonly="readonly" value="<?php echo $x['username'];?>" placeholder="Username" style="height:30px; width:400px !important">
					</div>
		  		</div>

		   		<div class="control-group">
					<label class="control-label" for="inputNama">Nama Lengkap</label>
					<div class="controls">
					  <input type="text" name="nama" value="<?php echo $x['nama'];?>" placeholder="Nama Lengkap" style="height:30px; width:400px !important">
					</div>
				</div>

				<div class="control-group">
					<label class="control-label" for="inputNim">No. ID ADMIN</label>
					<div class="controls">
						<input type="text" name="nid" id="id_register" value="<?php echo $x['nid'];?>" placeholder="NIP" style="height:30px; width:400px !important">
					</div>
				</div>

				<div class="control-group">
					<label class="control-label" for="inputEmail">Email</label>
					<div class="controls">
					  <input type="email"  name="email" id="inputEmail" value="<?php echo $x['email'];?>" placeholder="Email" style="height:30px; width:400px !important">
					</div>
				</div>

				

			  	<div class="controls">
			<!--  <div class="form-actions"> -->
			  		<input type="hidden" name="username" value="<?php echo $x['username'];?>">
		  			<button type="submit" class="btn btn-primary" name="edit_data" value="edit_admin">Simpan</button>
			<!-- </div> -->
				</div>

		</form>
        </div>


	<?php
	}else{
		echo "Error 404 , Data tidak ditemukan !";
	}

    if(isset($_POST['edit_data'])){
		extract($_POST);
		
		// Mengecek apakah ada data atau tidak
		if (($edit_data=="edit_mhs") && ($username!="") && ($nama!="") && ($nim!="") && ($sex!="")&& ($ttl!="") && ($alamat!="") && ($prodi!="") && ($angkatan!="") && ($kelas!="") && ($email!="")&& ($tlp!="")){


			$querya=mysql_fetch_array(mysql_query("SELECT id_user from mhs where id_mem='$kode'"));

			$update_user  = mysql_query("UPDATE `user` SET `username` = '$nim' where id_user=".$querya['id_user']) or die (mysql_error());
			$update_mhs = mysql_query("UPDATE  `mhs` SET  `nama` =  '$nama', `nim` =  '$nim', `sex` =  '$sex', `ttl` =  '$ttl', `alamat` =  '$alamat', `prodi` =  '$prodi', `angkatan` =  '$angkatan', `kelas` =  '$kelas', `email` =  '$email', `tlp` =  '$tlp' WHERE id_mem='$kode'")  or die (mysql_error());
				
				if($update_mhs == true ){
				?>
					<script>
					function Redirect(){
						window.location = "user.php?act=daftar&type=mhs";
					}
					window.alert("Data User Mahasiswa Berhasil Diubah ");
					setTimeout('Redirect()', 100);
					
					</script>
				<?php
				
			}
		}else if(($edit_data=="edit_peg") && ($nama!="") && ($nip!="") && ($sex!="")&& ($ttl!="") && ($alamat!="") && ($jabatan!="") && ($email!="") && ($tlp!="")){
			
			$querya=mysql_fetch_array(mysql_query("SELECT id_user from pegawai where id_peg='$kode'"));

			$update_user  = mysql_query("UPDATE `user` SET `username` = '$nip' where id_user=".$querya['id_user']) or die (mysql_error());

			$update_peg = mysql_query("UPDATE `pegawai` SET  `nama` =  '$nama',`nip` =  '$nip', `sex` =  '$sex', `ttl` =  '$ttl' , `alamat` =  '$alamat', `jabatan` =  '$jabatan' , `email` =  '$email' , `tlp` =  '$tlp' WHERE  `id_peg` ='$kode'")  or die (mysql_error());
			
			if($update_peg == true ){
				?>
					<script>
					function Redirect(){
						window.location = "user.php?act=daftar&type=peg";
					}
					window.alert("Data User Pegawai atau Dosen Berhasil Diubah ");
					setTimeout('Redirect()', 100);
					
					</script>
				<?php
				
			}
		}else if(($edit_data=="edit_laboran") && ($nama!="") && ($nip!="") && ($sex!="")&& ($ttl!="") && ($alamat!="") && ($jabatan!="") && ($email!="") && ($tlp!="") && ($id_dep!="")){
			
			$querya=mysql_fetch_array(mysql_query("SELECT id_user from laboran where id_lab='$kode'"));

			$update_user  = mysql_query("UPDATE `user` SET `username` = '$nip' where id_user=".$querya['id_user']) or die (mysql_error());

			$update_laboran = mysql_query("UPDATE `laboran` SET  `nama` =  '$nama',`nip` =  '$nip', `sex` =  '$sex', `ttl` =  '$ttl' , `alamat` =  '$alamat', `jabatan` =  '$jabatan' , `email` =  '$email' , `tlp` =  '$tlp' , `id_dep` =  '$id_dep' WHERE  `id_lab` ='$kode'")  or die (mysql_error());
			
			if($update_laboran == true ){
				?>
					<script>
					function Redirect(){
						window.location = "user.php?act=daftar&type=laboran";
					}
					window.alert("Data User Laboran Berhasil Diubah ");
					setTimeout('Redirect()', 100);
					
					</script>
				<?php
				
			}
		}else if(($edit_data=="edit_admin") && ($nama!="") && ($nid!="") && ($email!="")){
			
			$querya=mysql_fetch_array(mysql_query("SELECT id_user from admin where id_admin='$kode'"));

			$update_user  = mysql_query("UPDATE `user` SET `username` = '$nid' where id_user=".$querya['id_user']) or die (mysql_error());

			$update_admin = mysql_query("UPDATE `admin` SET  `nama` =  '$nama',`nid` =  '$nid', `email` =  '$email' WHERE  `id_admin` ='$kode'")  or die (mysql_error());
			
			if($update_admin == true ){
				?>
					<script>
					function Redirect(){
						window.location = "user.php?act=daftar&type=admin";
					}
					window.alert("Data User Administrator Berhasil Diubah ");
					setTimeout('Redirect()', 100);
					
					</script>
				<?php
				
			}
		}else{
			echo "Data Tidak Valid !";
		}
		
	}
?>
