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
  bahan.tahun,
  bahan.jumlah,
  bahan.satuan,
  kantor.nama as lokasi
  FROM
  bahan
  INNER JOIN kantor ON bahan.id_dep = kantor.id_dep order by bahan.nama asc ";
$hasil = mysql_query($query);
 
// Set properties
$objPHPExcel->getProperties()->setCreator("Sulis S")
      ->setLastModifiedBy("Sulis S")
      ->setTitle("Office 2007 XLSX Test Document")
      ->setSubject("Office 2007 XLSX Test Document")
       ->setDescription("Laporan transaksi .")
       ->setKeywords("office 2007 openxml php")
       ->setCategory("Daftar Bahan SYSIN TE UM");
 
// Add some data
$objPHPExcel->setActiveSheetIndex(0)
       ->setCellValue('A1', 'Kode')
       ->setCellValue('B1', 'Nama')
       ->setCellValue('C1', 'Tahun')
       ->setCellValue('D1', 'Jumlah')
       ->setCellValue('E1', 'Satuan')
       ->setCellValue('F1', 'Lokasi');
      
 
$baris = 2;
$id_bahan = 0;			
while($row=mysql_fetch_array($hasil)){
$id_bahan = $id_bahan +1;
$objPHPExcel->setActiveSheetIndex(0)
     ->setCellValue("A$baris", $row['kd_bahan'])
     ->setCellValue("B$baris", $row['nama_bahan'])
     ->setCellValue("C$baris", $row['tahun'])
     ->setCellValue("D$baris", $row['jumlah'])
     ->setCellValue("E$baris", $row['satuan'])
     ->setCellValue("F$baris", $row['lokasi']);
    

$baris = $baris + 1;
}
 
// Rename sheet
$objPHPExcel->getActiveSheet()->setTitle('transaksi');
 
// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);
 
// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="daftar_bahan.xls"');
header('Cache-Control: max-age=0');
 
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;
?>
 