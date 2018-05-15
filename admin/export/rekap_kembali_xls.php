<?php

error_reporting(E_ALL);

require_once '../plugins/excel/PHPExcel.php';
require_once '../inc/config.php';
// Create new PHPExcel object
$objPHPExcel = new PHPExcel();


$query="SELECT
    transaksi_pa.no,
    transaksi_pa.id_pinjam,
    transaksi_pa.indate,
    transaksi_pa.outdate,
    laboran.nama AS nama_laboran,
    alat.nama AS nama_alat,
    detail_pa.jumlah,
    detail_pa.`status`,
    `user`.username,
    alat.kd_barang
    FROM
    detail_pa
    INNER JOIN transaksi_pa ON transaksi_pa.id_pinjam = detail_pa.id_pinjam
    INNER JOIN laboran ON transaksi_pa.id_lab = laboran.id_user
    INNER JOIN alat ON detail_pa.id_alat = alat.kd_barang
    INNER JOIN `user` ON transaksi_pa.id_user = `user`.id_user
    where detail_pa.status='2'
    order by transaksi_pa.indate asc ";
$hasil = mysql_query($query);
 
// Set properties
$objPHPExcel->getProperties()->setCreator("Sulis S")
      ->setLastModifiedBy("Sulis S")
      ->setTitle("Office 2007 XLSX Test Document")
      ->setSubject("Office 2007 XLSX Test Document")
       ->setDescription("Laporan transaksi .")
       ->setKeywords("office 2007 openxml php")
       ->setCategory("Rekap Pengembalian Alat atau Barang SYSIN TE UM");
 
// Add some data
$objPHPExcel->setActiveSheetIndex(0)
       ->setCellValue('A1', 'Id Pinjam')
       ->setCellValue('B1', 'Tanggal Masuk')
       ->setCellValue('C1', 'Tanggal Kembali')
       ->setCellValue('D1', 'Peminjam')
       ->setCellValue('E1', 'Petugas')
        ->setCellValue('F1', 'Kode Alat')
       ->setCellValue('G1', 'Nama Alat')
       ->setCellValue('H1', 'Jumlah')
        ->setCellValue('I1', 'Status');
 
$baris = 2;
$no = 1;      
while($row=mysql_fetch_array($hasil)){
$no = $no +1;
$objPHPExcel->setActiveSheetIndex(0)
     ->setCellValue("A$baris", $row['id_pinjam'])
     ->setCellValue("B$baris", $row['indate'])
     ->setCellValue("C$baris", $row['outdate'])
     ->setCellValue("D$baris", $row['username'])
     ->setCellValue("E$baris", $row['nama_laboran'])
     ->setCellValue("F$baris", $row['kd_barang'])
     ->setCellValue("G$baris", $row['nama_alat'])
     ->setCellValue("H$baris", $row['jumlah'])
     ->setCellValue("I$baris", $row['status']);

$baris = $baris + 1;
}
 
// Rename sheet
$objPHPExcel->getActiveSheet()->setTitle('transaksi');
 
// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);
 
// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="rekap_kembali.xls"');
header('Cache-Control: max-age=0');
 
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;
?>
 