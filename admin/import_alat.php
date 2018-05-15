<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
//koneksi ke database, username,password  dan namadatabase menyesuaikan 
require("../config/config.php");
 
//memanggil file excel_reader
require "excel_reader2.php";
 
//jika tombol import ditekan
if(isset($_POST['submit'])){
 
    $target = basename($_FILES['filetabel_kompetensiall']['nama']) ;
    move_uploaded_file($_FILES['filetabel_kompetensiall']['tmp_name'], $target);
    
    $data = new Spreadsheet_Excel_Reader($_FILES['filetabel_kompetensiall']['nama'],false);
    
//    menghitung jumlah baris file xls
    $baris = $data->rowcount($sheet_index=0);
    
//    jika kosongkan data dicentang jalankan kode berikut
    if($_POST['drop']==1){
//             kosongkan tabel tabel_kompetensi
             $truncate ="TRUNCATE TABLE alat";
             mysql_query($truncate);
    };
    
//    import data excel mulai baris ke-2 (karena tabel xls ada header pada baris 1)
    for ($i=2; $i<=$baris; $i++)
    {
//       membaca data (kolom ke-1 sd terakhir)
     $kd_barang = $data->val($i,1);
 //membaca data nama depan (kolom ke-2)
     $nama = $data->val($i,2);
     //membaca data nama belakang (kolom ke-3)
     $merk = $data->val($i,3);
     $spec = $data->val($i,4);
     $tahun = $data->val($i,5);
     $jumlah = $data->val($i,6);
     $satuan = $data->val($i,7);
     $kondisi = $data->val($i,8);
     $harga = $data->val($i,9);
     $smbr_dana = $data->val($i,10);
     $no_aset = $data->val($i,11);
     $id_dep = $data->val($i,12);
     $tgl_masuk = $data->val($i,13);
 
//      setelah data dibaca, masukkan ke tabel tabel_kompetensi sql
      $a = "INSERT into alat VALUES('','$kd_barang','$nama','$merk','$spec', '$tahun','$jumlah','$satuan','$kondisi','$harga','$smbr_dana','$no_aset','$id_dep') ";
      $query = "INSERT into transaksi_ma VALUES('','$kd_barang','$kondisi', '$tgl_masuk') ";
      $hasil = mysql_query($a);
      $hasil = mysql_query($query);
    }
    
    if(!$hasil){
//          jika import gagal
          die(mysql_error());
      }else{
//          jika impor berhasil
          echo "Data berhasil diimpor.";
    }
    
//    hapus file xls yang udah dibaca
    unlink($_FILES['filetabel_kompetensiall']['nama']);
}
 
?>
 
<form name="form_import" id="form_import" onSubmit="return validateForm()" action="import.php" method="post" enctype="multipart/form-data">
    <input type="file" id="filetabel_kompetensiall" name="filetabel_kompetensiall" />
    <input type="submit" name="submit" value="Import" /><br/>
    <label><input type="checkbox" name="drop" value="1" /> <u>Kosongkan tabel sql terlebih dahulu.</u> </label>
</form>
 
<script type="text/javascript">
//    validasi form (hanya file .xls yang diijinkan)
    function validateForm()
    {
        function hasExtension(inputID, exts) {
            var fileName = document.getElementById(inputID).value;
            return (new RegExp('(' + exts.join('|').replace(/\./g, '\\.') + ')$')).test(fileName);
        }
 
        if(!hasExtension('filetabel_kompetensiall', ['.xls'])){
            alert("Hanya file XLS (Excel 2003) yang diijinkan.");
            return false;
        }
    }
</script>