<?php

error_reporting(E_ALL);

require_once '../plugins/excel/PHPExcel.php';
require_once '../inc/config.php';
// Create new PHPExcel object
$objPHPExcel = new PHPExcel();


$query="SELECT
bahan.id_bahan,
bahan.kd_bahan,
bahan.nama as nama_bahan,
transaksi_mb.merk,
transaksi_mb.tahun,
transaksi_mb.jumlah,
transaksi_mb.satuan,
transaksi_mb.tgl_masuk,
transaksi_mb.harga,
transaksi_mb.smbr_dana,
kantor.nama as nama_kantor
FROM
bahan
INNER JOIN transaksi_mb ON bahan.kd_bahan = transaksi_mb.kd_bahan
INNER JOIN kantor ON bahan.id_dep = kantor.id_dep order by tgl_masuk asc ";
$hasil = mysql_query($query);
 
// Set properties
$objPHPExcel->getProperties()->setCreator("Sulis S")
      ->setLastModifiedBy("Sulis S")
      ->setTitle("Office 2007 XLSX Test Document")
      ->setSubject("Office 2007 XLSX Test Document")
       ->setDescription("Laporan transaksi .")
       ->setKeywords("office 2007 openxml php")
       ->setCategory("Transaksi Masuk Bahan Habis Pakai");
 
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
       ->setCellValue('I1', 'Lokasi')
       ->setCellValue('J1', 'Tanggal Masuk');
 
$baris = 2;
$id_bahan = 0;			
while($row=mysql_fetch_array($hasil)){
$id_bahan = $id_bahan +1;
$objPHPExcel->setActiveSheetIndex(0)
     ->setCellValue("A$baris", $row['kd_bahan'])
     ->setCellValue("B$baris", $row['nama_bahan'])
     ->setCellValue("C$baris", $row['merk'])
     ->setCellValue("D$baris", $row['tahun'])
     ->setCellValue("E$baris", $row['jumlah'])
     ->setCellValue("F$baris", $row['satuan'])
     ->setCellValue("G$baris", format_rupiah($row['harga']))
      ->setCellValue("H$baris", $row['smbr_dana'])
      ->setCellValue("I$baris", $row['nama_kantor'])
      ->setCellValue("J$baris", $row['tgl_masuk']);

$baris = $baris + 1;
}
 
// Rename sheet
$objPHPExcel->getActiveSheet()->setTitle('transaksi');
 
// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);
 
// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="transaksi_masuk_bahan.xls"');
header('Cache-Control: max-age=0');
 
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;
?>
 