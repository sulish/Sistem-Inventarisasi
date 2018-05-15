<?php
	session_start();
	require("../config/config.php");
	if(isset($_SESSION['username']) && isset($_SESSION['type']) ){
	require("../includes/admin_header.php"); 
	require("../includes/admin_sidebar.php");
	
	$kategori = 'alat';

	if( isset($_POST['kategori']) && $_POST['kategori'] == 'Bahan' ){
		$kategori = 'bahan';
	}


	if( isset($_POST['ajax_request']) ){
		$nama = $_POST['cari'];
		$query = mysql_query("select * from ". $kategori ." where nama like '%". $nama ."%'");
		// $hasil = [];
		while( $data = mysql_fetch_assoc($query) ){
			$hasil[] = $data;
		}

		echo json_encode($hasil);
		die();
	}

	
	$url = 'pinjam.php';//$_SERVER['REQUEST_URI'];
?>
	<!-- clone jenis peminjaman, pencarian, dan tambah item -->
	<script>
		
		jQuery(function(){
			
			jQuery('#fieldNama').stop(true, true).on('keyup', function(){

				console.log(jQuery(this).val());
				var form = jQuery('.form-inline');

				jQuery.ajax({
					type 	 : 'post',
					url      : <?php echo "'".$url."'"; ?>,
					data     : form.serialize() + '&ajax_request=true',
					dataType : 'json',
					success  : function(data){
						
						var htmlObject = '';
						for( var i = 0; i < data.length; i++ ){
							htmlObject += '<tr>';
							htmlObject += '<td>'+ <?php if( $kategori == 'alat' ){ ?> data[i].kd_barang <?php }elseif( $kategori == 'bahan' ){ ?> data[i].kd_bahan <?php } ?> +'</td>';
							htmlObject += '<td>'+ data[i].nama +'</td>';
							htmlObject += '<td>'+ data[i].merk +'</td>';
							htmlObject += '<td>'+ data[i].tahun +'</td>';
							htmlObject += '<td>'+ data[i].jumlah +'</td>';
							htmlObject += '<td>'+ data[i].satuan +'</td>';
							htmlObject += '<td>'+ data[i].tgl_masuk +'</td>';
							<?php if( $kategori == 'alat' ){ ?> 
								htmlObject += '<td>'+ data[i].kondisi +'</td>';
							<?php } ?>
							htmlObject += '<td>'+ data[i].lokasi +'</td>';
							<?php if( $kategori == 'alat' ){ ?> 
								if( data[i].kondisi == 'baik' || data[i].kondisi == 'rusak ringan' ){
									htmlObject += '<td><a href="" class="pinjamButton">pinjam</a></td>';
								}else{
									htmlObject += '<td>tidak tersedia</td>';
								}
							<?php }elseif( $kategori == 'bahan' ){ ?>
								if( data[i].jumlah > 0 ){
									htmlObject += '<td><a href="" class="pinjamButton">pinjam</a></td>';
								}else{
									htmlObject += '<td>tidak tersedia</td>';
								}
							<?php } ?>
							htmlObject += '<td>'+ data[i].lokasi +'</td>';
							htmlObject += '</tr>';
						}

						console.log(htmlObject);

						jQuery('table .result').html(htmlObject);
					}
				});
			});
			var check_jml_alat = 0;
			jQuery('.pinjamButton').on('click', function(e){
				e.preventDefault();

				var data = {
					kode : jQuery(this).closest('tr').children('.kode').text(),
					nama : jQuery(this).closest('tr').children('.nama').text()
				};

				var form = jQuery('.clone-master.master').clone();

				form.find('input.brg-kode').attr("value",data.kode);
				form.find('input.brg-nama').attr("value",data.nama);
				form.find('input.brg-jumlah').attr("value",1);
				form.find('input.brg-jumlah').closest('.clone-master').removeClass('master');
				jQuery('.list-barang .list').append(form);
				check_jml_alat++;
				delete_brg();
			});
			function confirms() {
			  return confirm("Apakah anda yakin menghapus item ini?");
			}
			function delete_brg(){
				jQuery('.brg-delete').click( function(e){
					e.preventDefault();
					var x=0;
					if(confirms()==true){
						
						alert("Item Terhapus!");
						jQuery(this).closest('.clone-master').remove();
						if(check_jml_alat > 0){
							check_jml_alat--;
						}
					}
					return false;
				
				});
			}
			jQuery('#order-button').on('click',function(){
				if(confirm("Apakah anda yakin meminjam item ini?")==true){
					if(check_jml_alat > 0){
						jQuery('.clone-master.master').remove();
						return true;
					}else{
						alert("Minimal Harus Ada satu alat/barang yang dipinjam !");
						return false;
					}
				
				}else{
					return false;
				
				}
				
			});
			
				
		});
	</script>

		<div class="content-block">
		
		<h2>Peminjaman Alat dan Penggunaan Bahan Habis Pakai</h2>
		<form class="form-inline" method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
	      <input type="hidden" value="alat" name="type_form" />
	      <div class="control-group" style="height: 50px;"> 
	      <label class="control-label" >Pencarian</label>
	      <div class="controls">
	      <select name="kategori" name="kategori">
	      	<option value="Alat" <?php if(isset($_POST['kategori']) && $_POST['kategori'] == 'Alat'){ echo "selected='selected'"; } ?>>Alat</option>
	      	<option value="Bahan" <?php if(isset($_POST['kategori']) && $_POST['kategori'] == 'Bahan'){ echo "selected='selected'"; } ?>>Bahan</option>
      	  </select>
	      <input type="text" placeholder="Ketikkan lokasi alat/bahan" name="cari" id="fieldNama" style="height:30px; width:250px">
	      <button type="submit" class="btn">Cari</button>
        </div>
        </div>
        </form>

<div style="max-height:300px;overflow:scroll;">
<p style="width:100%;">
<br><br><table class="table table-striped"  >

<?php
	// ALAT
	if( $kategori == 'alat' ) {
	if(isset($_POST['cari'])){
       $query=mysql_query("SELECT alat.id_barang,
alat.kd_barang,
alat.nama as nama_alat,
alat.merk,
alat.tahun,
alat.jumlah,
alat.satuan,
alat.kondisi,
alat.harga,
alat.smbr_dana,
alat.no_aset,
alat.id_dep,
kantor.nama as nama_kantor
FROM
alat
INNER JOIN kantor ON kantor.id_dep = alat.id_dep where alat.kd_barang like '%$_POST[cari]%' or alat.nama like '%$_POST[cari]%' or alat.merk like '%$_POST[cari]%' or alat.tahun like '%$_POST[cari]%' 
        or alat.jumlah like '%$_POST[cari]%' or alat.satuan like '%$_POST[cari]%' or alat.kondisi like '%$_POST[cari]%' or alat.harga like '%$_POST[cari]%' 
        or alat.smbr_dana like '%$_POST[cari]%' or alat.no_aset like '%$_POST[cari]%' or kantor.nama like '%$_POST[cari]%' order by alat.nama asc");
}else{
  		$query=mysql_query("SELECT alat.id_barang,
alat.kd_barang,
alat.nama as nama_alat,
alat.merk,
alat.tahun,
alat.jumlah,
alat.satuan,
alat.kondisi,
alat.harga,
alat.smbr_dana,
alat.no_aset,
alat.id_dep,
kantor.nama as nama_kantor
FROM
alat
INNER JOIN kantor ON kantor.id_dep = alat.id_dep");
  	}
?>
	  	<thead>
	    	<tr >
	      		<th>Kode</th>
	      		<th>Nama</th>
	       		<th>Merk</th>
	    		<th>Tahun</th>
				<th>Jumlah</th>
				<th>Satuan</th>
				<th>Kondisi</th>
				<th>Lokasi</th>
				<th>Action</th>
	    	</tr>
	  	</thead>
	  	<tbody class="result">
		<?php
			while($hasil=mysql_fetch_array($query)){
		?>
			<tr>
			  	<td class="kode"><?php echo $hasil['kd_barang'];?></td>
			  	<td class="nama"><?php echo $hasil['nama_alat'];?></td>
			   	<td><?php echo $hasil['merk'];?></td>
			  	<td><?php echo $hasil['tahun'];?></td>
			   	<td><?php echo $hasil['jumlah'];?></td>
			  	<td><?php echo $hasil['satuan'];?></td>
			    <td><?php echo $hasil['kondisi'];?></td>
			    <td><?php echo $hasil['nama_kantor'];?></td>
			   	<th>
			       	<?php
			       		if( $hasil['kondisi'] == 'baik' || $hasil['kondisi'] == 'rusak ringan'){
			       			?>
			       			<a href="" class="pinjamButton">pinjam</a>
			       			<?php
			       		}else{
			       			echo "tidak tersedia";
			       		}
			       	?>
			   	</th>
			</tr>
	<?php
	    }
?>
	  	</tbody>
<?php
	// BAHAN
	}elseif( $kategori == 'bahan' ){
		if(isset($_POST['cari'])){
       $query=mysql_query("SELECT
  bahan.id_bahan,
  bahan.kd_bahan,
  bahan.nama as nama_bahan,
  bahan.tahun,
  bahan.jumlah,
  bahan.satuan,
  kantor.nama as lokasi
  FROM
  bahan
  INNER JOIN kantor ON bahan.id_dep = kantor.id_dep where bahan.kd_bahan like '%$_POST[cari]%' or bahan.nama like '%$_POST[cari]%' or bahan.tahun like '%$_POST[cari]%' or bahan.jumlah like '%$_POST[cari]%' 
        or bahan.satuan like '%$_POST[cari]%' or kantor.nama like '%$_POST[cari]%' order by bahan.nama asc");
}else{
  $query=mysql_query("SELECT
  bahan.id_bahan,
  bahan.kd_bahan,
  bahan.nama as nama_bahan,
  bahan.tahun,
  bahan.jumlah,
  bahan.satuan,
  kantor.nama as lokasi
  FROM
  bahan
  INNER JOIN kantor ON bahan.id_dep = kantor.id_dep");
}
?>

	<thead>
    	<tr >
      		<th>Kode</th>
      		<th>Nama</th>
    		<th>Tahun</th>
			<th>Jumlah</th>
			<th>Satuan</th>
			<th>Lokasi</th>
			<th>Action</th>
    	</tr>
  	</thead>
  	<tbody class="result">
	<?php
		while($hasil=mysql_fetch_array($query)){
	?>
		<tr>
		  	<td class="kode"><?php echo $hasil['kd_bahan'];?></td>
		  	<td class="nama"><?php echo $hasil['nama_bahan'];?></td>
		  	<td><?php echo $hasil['tahun'];?></td>
		   	<td><?php echo $hasil['jumlah'];?></td>
		  	<td><?php echo $hasil['satuan'];?></td>
		  	<td><?php echo $hasil['lokasi'];?></td>
		 
		   	<th>
		       	<?php
		       		if( $hasil['jumlah'] > 0){
		       			?>
		       			<a href="" class="pinjamButton">pinjam</a>
		       			<?php
		       		}else{
		       			echo "tidak tersedia";
		       		}
		       	?>
		   	</th>
		</tr>
<?php
		}
?>
  	</tbody>
<?php
	}
?>
 
        </table>
        </p>
        </div>
    <div>

	<form id="order-form" method="post" action="konfirmasi.php">			
	<br>» <span class="ContentTitle">Permintaan Peminjaman</span>, Pilih ke:
	<select name="laboran_id" id="laboran-id" >
		<!-- LOGIKA QUERY NYA??? -->
		<?php 
			$laboran_q = mysql_query("SELECT * FROM laboran ");
			while($row=mysql_fetch_array($laboran_q)){
				echo "<option value='".$row['id_user']."'>".$row['nama']."</option>";
				
			}
		?>
		
	
	</select>
	<br>&nbsp;
	<table class="adminlist table table-striped">
	<thead>
		<tr>
			<th class="title" width="250"> No. Permintaan</th>
			<th class="title"> Rincian item</th>
		</tr>
		</thead>
		<tbody  class="list-barang">
		<tr valign="top">
		<td>
		<span>
			<!-- memanggil id transaksi alat atau bahan -->
			<?php 
			if(isset($_POST['kategori'])){
				if($_POST['kategori']=="Bahan"){
					$q=mysql_query("SELECT * FROM transaksi_pb order by no DESC limit 1");
					$row=mysql_fetch_row($q);
					$id_trans = "TB0".($row[0]+1);	
					echo $id_trans;

					
				}else{
					
					$q=mysql_query("SELECT * FROM transaksi_pa order by no DESC limit 1");
					$row=mysql_fetch_row($q);
					$id_trans = "TA0".($row[0]+1);	
					echo $id_trans;
				}
				
			}else{
				$q=mysql_query("SELECT * FROM transaksi_pa order by no DESC limit 1");
				$row=mysql_fetch_row($q);
				$id_trans = "TA0".($row[0]+1);	
				echo $id_trans;
			}
		?></span></td>
		<td  class="list"></td>
		</tbody>
		<tbody>
			
			<tr class="clone-master master">
				<td width="30" align="center">
					<span>1</span>
					<input type="hidden" name="kode[]" value="0" class="brg-kode" />
				</td>
				<td>» <input type="text" name="nama[]" class="brg-nama" size="15" value="" readonly="readonly"></td>
				<td> <input type="text" name="jumlah[]" class="brg-jumlah" size="35" value="" <?php if(isset($_POST['kategori']) && ($_POST['kategori']=="Bahan") ){ }else{ ?> readonly="readonly" <?php } ?>></td>
				<td align="center" width="100">
					<a href="#" class="brg-delete">Delete</a>
				</td>
			</tr>
						
						<tr>
							<td colspan="2">
								<input type="hidden" name="id_user"  value="<?php echo $_SESSION['id']; ?>">
								<input type="hidden" name="type_brg" id="order-items" value="<?php if(isset($_POST['kategori'])){ echo $_POST['kategori']; }else{ echo "Alat"; } ?>" >
								<input type="submit" name="kirim" id="order-button" value="Kirim permintaan">
							</td>
						</tr>
				
					
				</tbody>
				</td>
			</table>
			</form>
		</div>
</div>

<?php
	 }else{
	 	header("location:../masuk.php");

	}
?>
