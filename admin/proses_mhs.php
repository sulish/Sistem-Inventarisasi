<?php
 //menggunakan class phpExcelReader
 include "excel_reader2.php";
 
//koneksi ke db mysql
require("../config/config.php");
 
//membaca file excel yang diupload
 $data = new Spreadsheet_Excel_Reader($_FILES['userfile']['tmp_name']);
 //membaca jumlah baris dari data excel
 $baris = $data->rowcount($sheet_index=0);
 
//nilai awal counter jumlah data yang sukses dan yang gagal diimport
 $sukses = 0;
 $gagal = 0;
 
//import data excel dari baris kedua, karena baris pertama adalah nama kolom
 for ($i=2; $i<=$baris; $i++) {
 //membaca data nip (kolom ke-1)
 $username = $data->val($i,1);
 //membaca data nama depan (kolom ke-2)
 $password = md5($data->val($i,2));
 //membaca data nama belakang (kolom ke-3)
 $nama = $data->val($i,3);
 $nim = $data->val($i,4);
 $jk = $data->val($i,5);
 $ttl = $data->val($i,6);
 $alamat = $data->val($i,7);
 $prodi = $data->val($i,8);
 $angkatan = $data->val($i,9);
 $kelas = $data->val($i,10);
 $email = $data->val($i,11);
 $telpon = $data->val($i,12);
 
//setelah data dibaca, sisipkan ke dalam tabel pegawai
 $a="INSERT INTO user VALUES('','$username','$password','4')";
 $hasil = mysql_query($a);
 $id_user=mysql_query("SELECT LAST_INSERT_ID() INTO @user");

$query = "INSERT into mhs VALUES('','$nama','$nim','$jk','$ttl','$alamat','$prodi','$angkatan','$kelas','$email','$telpon','',@user) ";

 $hasil = mysql_query($query);
 
 
//menambah counter jika berhasil atau gagal
 if($hasil) $sukses++;
 else $gagal++;
 
}
 //tampilkan report hasil import
 echo "<h3> Proses Import Data Pegawai Selesai</h3>";
 echo "<p>Jumlah data sukses diimport : ".$sukses."<br>";
 echo "Jumlah data gagal diimport : ".$gagal."<p>";
 
?>