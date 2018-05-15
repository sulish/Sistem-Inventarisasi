<?php 
	$db="sys1";
	$host="localhost";
	$username="root";
	$pass="";
	mysql_connect($host,$username,$pass)  or die("work offline");
	mysql_select_db($db) or die("Database not found");
?>