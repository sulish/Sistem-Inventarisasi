<?php

error_reporting(E_ALL);

require_once '../plugins/excel/PHPExcel.php';
require_once '../inc/config.php';
// Create new PHPExcel object
$objPHPExcel = new PHPExcel();


$query="SELECT * from mhs order by nama asc ";
$hasil = mysql_query($query);
 
// Set properties
$objPHPExcel->getProperties()->setCreator("Sulis S")
      ->setLastModifiedBy("Sulis S")
      ->setTitle("Office 2007 XLSX Test Document")
      ->setSubject("Office 2007 XLSX Test Document")
       ->setDescription("Laporan transaksi .")
       ->setKeywords("office 2007 openxml php")
       ->setCategory("Daftar User Mahasiswa SYSIN TE UM");
 
// Add some data
$objPHPExcel->setActiveSheetIndex(0)
       ->setCellValue('A1', 'Nama')
       ->setCellValue('B1', 'NIM')
       ->setCellValue('C1', 'Jenis Kelamin')
       ->setCellValue('D1', 'Tanggal Lahir')
       ->setCellValue('E1', 'Alamat')
       ->setCellValue('F1', 'Jurusan')
       ->setCellValue('G1', 'Email')
       ->setCellValue('H1', 'Telepon');
 
$baris = 2;
$id_mem = 0;			
while($row=mysql_fetch_array($hasil)){
$id_mem = $id_mem +1;
$objPHPExcel->setActiveSheetIndex(0)
     ->setCellValue("A$baris", $row['nama'])
     ->setCellValue("B$baris", $row['nim'])
     ->setCellValue("C$baris", $row['sex'])
     ->setCellValue("D$baris", $row['ttl'])
     ->setCellValue("E$baris", $row['alamat'])
     ->setCellValue("F$baris", $row['prodi'])
     ->setCellValue("G$baris", $row['email'])
     ->setCellValue("H$baris", $row['tlp']);

$baris = $baris + 1;
}
 
// Rename sheet
$objPHPExcel->getActiveSheet()->setTitle('transaksi');
 
// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);
 
// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="daftar_mhs.xls"');
header('Cache-Control: max-age=0');
 
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;
?>
 