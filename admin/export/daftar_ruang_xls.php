<?php

error_reporting(E_ALL);

require_once '../plugins/excel/PHPExcel.php';
require_once '../inc/config.php';
// Create new PHPExcel object
$objPHPExcel = new PHPExcel();


$query="SELECT * from kantor order by id_dep asc ";
$hasil = mysql_query($query);
 
// Set properties
$objPHPExcel->getProperties()->setCreator("Sulis S")
      ->setLastModifiedBy("Sulis S")
      ->setTitle("Office 2007 XLSX Test Document")
      ->setSubject("Office 2007 XLSX Test Document")
       ->setDescription("Laporan transaksi .")
       ->setKeywords("office 2007 openxml php")
       ->setCategory("Daftar Ruangan SYSIN TE UM");
 
// Add some data
$objPHPExcel->setActiveSheetIndex(0)
       ->setCellValue('A1', 'ID Dept')
       ->setCellValue('B1', 'Nama')
       ->setCellValue('C1', 'Ruang')
       ->setCellValue('D1', 'Kategori');
      
 
$baris = 2;
$id_dep = 0;			
while($row=mysql_fetch_array($hasil)){
$id_dep = $id_dep +1;
$objPHPExcel->setActiveSheetIndex(0)
     ->setCellValue("A$baris", $row['id_dep'])
     ->setCellValue("B$baris", $row['nama'])
     ->setCellValue("C$baris", $row['ruang'])
     ->setCellValue("D$baris", $row['kategori']);
    

$baris = $baris + 1;
}
 
// Rename sheet
$objPHPExcel->getActiveSheet()->setTitle('transaksi');
 
// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);
 
// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="daftar_ruang.xls"');
header('Cache-Control: max-age=0');
 
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;
?>
 