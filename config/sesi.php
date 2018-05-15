<?php
session_name("user");
$sesi1=$_SESSION['user']; $sesi2=$_SESSION['password'];

if(isset($sesi1) || isset($sesi2))
{
$id=$_SESSION['id'];
}
else {
//echo "<meta http-equiv='refresh' content='0;URL=../index.php'>";
header("Location:../index.php");
}
?>