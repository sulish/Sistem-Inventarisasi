

<div id="sidebar">
	<div class="profile-admin">
		<div class="photo">
			<?php
				require("../config/config.php");
				// Menampilkan foto
					$type = $_SESSION['type'];
					$foto=mysql_fetch_array(mysql_query("SELECT foto from $type where id_user='$_SESSION[id]'")) or die(mysql_error());

					if(isset($foto['foto']) and $foto['foto']!= ''){
			?>
						<img src="../images/foto/<?php echo $foto['foto'];?>">
				<?php
					}else{
				?>
						<img src="../images/foto/user.png">
				<?php
					}
				?>
		</div>
			<div class="detail">
				USER : <?php echo $_SESSION['username']; ?> <br/>
				NAMA : <?php  echo $_SESSION['nama']; ?>
			</div>
	</div>	

		<a href="#" class="visible-phone"><i class="icon icon-home"></i> Beranda</a>				
		<ul>
			<li class="active"><a href="index.php"><i class="icon icon-home"></i> <span>Beranda</span></a></li>
			
			<!-- Menu Admin -->
			<?php if( $_SESSION['type']=="admin"){ ?>
			<li class="submenu">
				<a href="#"><i class="icon icon-user"></i> <span>Kelola User</span><span class="label">7</span></a>
				<ul>
					<li><a href="user.php?act=daftar&type=mhs">Daftar User-Mahasiswa</a></li>
					<li><a href="user.php?act=daftar&type=peg">Daftar User-Pegawai</a></li>
					<li><a href="user.php?act=daftar&type=laboran">Daftar User-Laboran</a></li>
					<li><a href="user.php?act=daftar&type=admin">Daftar Administrator</a></li>
					<li><a href="user.php?act=registrasi&type=mhs">Tambah User-Mahasiswa</a></li>
					<li><a href="user.php?act=registrasi&type=peg">Tambah User-Pegawai</a></li>
					<li><a href="user.php?act=registrasi&type=admin">Tambah Administrator</a></li>
				</ul>
			</li>
			<li class="submenu">
				<a href="#"><i class="icon icon-file"></i> <span>Kelola Berita</span> <span class="label">2</span></a>
				<ul>
					<li><a href="berita.php">Lihat Berita</a></li>
					<li><a href="tambah_berita.php">Tambah Berita</a></li>
				</ul>
			</li>
			<li class="submenu">
				<a href="#"><i class="icon icon-th-list"></i> <span>Kelola Ruangan</span><span class="label">2</span></a>
				<ul>
					<li><a href="ruang.php">Daftar Ruangan</a></li>
					<li><a href="tambah_ruang.php">Tambah Ruangan</a></li>
				</ul>
			</li>
			<li><a href="reset_pass.php"><i class="icon-th-list"></i> <span>Reset Password</span></a></li>
			<?php } ?>


			<!-- Menu pada admin dan laboran -->
			<?php if( ($_SESSION['type']=="laboran") || ($_SESSION['type']=="admin") ){ ?>
			<li class="submenu">
				<a href="#"><i class="icon-shopping-cart"></i> <span>Kelola Barang</span><span class="label">4</span></a>
				<ul>
					<li><a href="tambah_data.php?act=daftar&type=ab">Data Alat atau Barang</a></li>
					<li><a href="tambah_data.php?act=daftar&type=bhp">Data Bahan habis pakai</a></li>
					<li><a href="tambah_data.php?act=tambah&type=alat">Tambah Alat/Barang</a></li>
					<li><a href="tambah_data.php?act=tambah&type=bahan">Tambah Bahan habis pakai</a></li>
				</ul>
			</li>
			<li class="submenu">
				<a href="#"><i class="icon-shopping-cart"></i> <span>Transaksi Masuk</span><span class="label">2</span></a>
				<ul>
					<li><a href="transaksi_masuk_alat.php">Alat atau Barang</a></li>
					<li><a href="transaksi_masuk_bahan.php">Bahan habis pakai</a></li>
				</ul>
			</li>
			<?php } ?>


			<!-- Menu pada laboran pegawai dan mahasiswa -->
			<?php if( ($_SESSION['type']=="laboran") || ($_SESSION['type']=="pegawai") || ($_SESSION['type']=="mhs") ){ ?>
			<li><a href="pinjam.php"><i class="icon icon-th"></i> <span>Peminjaman</span></a></li>
			<li><a href="riwayat_pinjam.php"><i class="icon icon-th"></i> <span>Riwayat Pinjam</span></a></li>
			<?php } ?>

			<!-- Menu pada laboran -->
			<?php if( $_SESSION['type']=="laboran") { ?>
			<li><a href="detail_konfirmasi.php"><i class="icon-check"></i> <span>Konfirmasi</span>
			<!-- Notifikasi jumlah konfirmasi -->
			<?php
				$pb = mysql_query("SELECT detail_pb.no FROM detail_pb,transaksi_pb WHERE status = 0 AND transaksi_pb.id_pinjam=detail_pb.id_pinjam AND transaksi_pb.id_lab=".$_SESSION['id']."");
				$pa = mysql_query("SELECT detail_pa.no FROM detail_pa,transaksi_pa WHERE status = 0 AND transaksi_pa.id_pinjam=detail_pa.id_pinjam AND transaksi_pa.id_lab=".$_SESSION['id']." ");
				$jml_konfirmasi_pb = mysql_num_rows($pb);
				$jml_konfirmasi_pa = mysql_num_rows($pa);

				// fungsi counting jumlah
				$count = $jml_konfirmasi_pb+$jml_konfirmasi_pa;
				
				if($count > 0) {
					echo  '<span class="label">'.$count.'</span>';
				}
			?>
			</a></li>
			<li><a href="kembali_alat.php"><i class="icon-th-list"></i> <span>Pengembalian Alat</span></a></li>
			<li class="submenu">
				<a href="#"><i class="icon-shopping-cart"></i> <span>Rekap Peminjaman</span><span class="label">2</span></a>
				<ul>
					<li><a href="rekap_peminjaman.php">Peminjaman Alat</a></li>
					<li><a href="rekap_pinjam.php">Penggunaan Bahan</a></li>
				</ul>
			</li>
			<li><a href="rekap_kembali.php"><i class="icon-th-list"></i> <span>Rekap Pengembalian</span></a></li>
			
			<?php } ?>

		</ul>
	</div>
		  <div id="mainBody">
			<h1><img src="../images/logo1.png"/>
				<div class="pull-right">
				<a class="btn btn-large" title="" href="../inventaris.php"><i class="icon icon-user"></i> Bantuan</a>
				<a class="btn btn-large" title="" href="setting.php"><i class="icon icon-cog"></i> Pengaturan</a>
				<a class="btn btn-large btn-danger" title="" href="../logout.php"><i class="icon-off"></i></a>
				</div>
			</h1>
		<div id="breadcrumb">
			<a href="../index.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Depan</a>
			<a href="#" class="current">Beranda</a>
		</div>
		<!-- letak script -->
	