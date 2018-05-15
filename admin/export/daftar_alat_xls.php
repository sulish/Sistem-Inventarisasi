<?php

error_reporting(E_ALL);

require_once '../plugins/excel/PHPExcel.php';
require_once '../inc/config.php';
// Create new PHPExcel object
$objPHPExcel = new PHPExcel();


$query="SELECT alat.id_barang,
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
INNER JOIN kantor ON kantor.id_dep = alat.id_dep order by alat.nama asc ";
$hasil = mysql_query($query);
 
// Set properties
$objPHPExcel->getProperties()->setCreator("Sulis S")
      ->setLastModifiedBy("Sulis S")
      ->setTitle("Office 2007 XLSX Test Document")
      ->setSubject("Office 2007 XLSX Test Document")
       ->setDescription("Laporan transaksi .")
       ->setKeywords("office 2007 openxml php")
       ->setCategory("Daftar Alat dan Barang SYSIN");
 
// Add some data
$objPHPExcel->setActiveSheetIndex(0)
       ->setCellValue('A1', 'Kode')
       ->setCellValue('B1', 'Nama')
       ->setCellValue('C1', 'Merk')
       ->setCellValue('D1', 'Tahun')
       ->setCellValue('E1', 'Jumlah')
       ->setCellValue('F1', 'Satuan')
       ->setCellValue('G1', 'Kondisi')
       ->setCellValue('H1', 'Harga')
       ->setCellValue('I1', 'Sumber Dana')
       ->setCellValue('J1', 'No Aset')
       ->setCellValue('K1', 'Lokasi');
 
$baris = 2;
$kd_barang = 0;			
while($row=mysql_fetch_array($hasil)){
$kd_barang = $kd_barang +1;
$objPHPExcel->setActiveSheetIndex(0)
     ->setCellValue("A$baris", $row['kd_barang'])
     ->setCellValue("B$baris", $row['nama_alat'])
     ->setCellValue("C$baris", $row['merk'])
     ->setCellValue("D$baris", $row['tahun'])
     ->setCellValue("E$baris", $row['jumlah'])
     ->setCellValue("F$baris", $row['satuan'])
     ->setCellValue("G$baris", $row['kondisi'])
     ->setCellValue("H$baris", format_rupiah($row['harga']))
     ->setCellValue("I$baris", $row['smbr_dana'])
     ->setCellValue("J$baris", $row['no_aset'])
     ->setCellValue("K$baris", $row['nama_kantor']);

$baris = $baris + 1;
}
 
// Rename sheet
$objPHPExcel->getActiveSheet()->setTitle('transaksi');
 
// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);
 
// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="daftar_alat.xls"');
header('Cache-Control: max-age=0');
 
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;
?>
 