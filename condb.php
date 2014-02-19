<?php

$mhost = "localhost";
$muser = "root";
$mpass = "1234";
$db = "dhfonline";

$con = mysql_connect($mhost, $muser, $mpass) or die(mysql_error());
mysql_select_db($db) or die(mysql_error());
mysql_query("SET NAMES UTF8") or die(mysql_error());
?>
