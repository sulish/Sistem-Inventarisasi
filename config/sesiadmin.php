<?php
$sesi1=$_COOKIE['useradmin']; $sesi2=$_COOKIE['passadmin'];

if(!isset($sesi1) || !isset($sesi2))
{
header("Location:../index.php");
}
?>