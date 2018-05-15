<?php

error_reporting(E_ALL);

require_once '../plugins/excel/PHPExcel.php';
require_once '../inc/config.php';
// Create new PHPExcel object
$objPHPExcel = new PHPExcel();


$query="SELECT
alat.kd_barang,
alat.nama,
alat.merk,
alat.tahun,
alat.jumlah,
alat.satuan,
alat.harga,
alat.smbr_dana,
alat.no_aset,
kantor.nama as lokasi,
transaksi_ma.kondisi,
transaksi_ma.tgl_masuk
FROM
alat
INNER JOIN transaksi_ma ON alat.kd_barang = transaksi_ma.kd_barang
INNER JOIN kantor ON alat.id_dep = kantor.id_dep order by tgl_masuk asc ";
$hasil = mysql_query($query);
 
// Set properties
$objPHPExcel->getProperties()->setCreator("Sulis S")
      ->setLastModifiedBy("Sulis S")
      ->setTitle("Office 2007 XLSX Test Document")
      ->setSubject("Office 2007 XLSX Test Document")
       ->setDescription("Laporan transaksi .")
       ->setKeywords("office 2007 openxml php")
       ->setCategory("Transaksi Masuk");
 
// Add some data
$objPHPExcel->setActiveSheetIndex(0)
       ->setCellValue('A1', 'Kode')
       ->setCellValue('B1', 'Nama')
       ->setCellValue('C1', 'Merk')
       ->setCellValue('D1', 'Tahun')
       ->setCellValue('E1', 'Jumlah')
       ->setCellValue('F1', 'Satuan')
       ->setCellValue('G1', 'Harga')
       ->setCellValue('H1', 'Sumber Dana')
       ->setCellValue('I1', 'No Aset')
       ->setCellValue('J1', 'Lokasi')
       ->setCellValue('K1', 'Kondisi')
       ->setCellValue('L1', 'Tanggal Masuk');
 
$baris = 2;
$kd_barang = 0;			
while($row=mysql_fetch_array($hasil)){
$kd_barang = $kd_barang +1;
$objPHPExcel->setActiveSheetIndex(0)
     ->setCellValue("A$baris", $row['kd_barang'])
     ->setCellValue("B$baris", $row['nama'])
     ->setCellValue("C$baris", $row['merk'])
     ->setCellValue("D$baris", $row['tahun'])
     ->setCellValue("E$baris", $row['jumlah'])
     ->setCellValue("F$baris", $row['satuan'])
     ->setCellValue("G$baris", format_rupiah($row['harga']))
      ->setCellValue("H$baris", $row['smbr_dana'])
      ->setCellValue("I$baris", $row['no_aset'])
      ->setCellValue("J$baris", $row['lokasi'])
      ->setCellValue("K$baris", $row['kondisi'])
      ->setCellValue("L$baris", $row['tgl_masuk']);

$baris = $baris + 1;
}
 
// Rename sheet
$objPHPExcel->getActiveSheet()->setTitle('transaksi');
 
// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);
 
// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="transaksi_masuk_alat.xls"');
header('Cache-Control: max-age=0');
 
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;
?>
 