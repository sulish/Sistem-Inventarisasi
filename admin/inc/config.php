<?php
	
	define('db_host','localhost');
	define('db_user','root');
	define('db_pass','');
	define('db_name','sys1');
	
	mysql_connect(db_host,db_user,db_pass);
	mysql_select_db(db_name);
	
	
//fungsi format rupiah 
function format_rupiah($rp) {
	$hasil = "Rp." . number_format($rp, 0, "", ".") . ",00";
	return $hasil;
}
?>
