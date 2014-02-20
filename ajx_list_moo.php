<?php
require 'condb.php';
$tmb=$_GET[tmb];
//$amp=6503;
$result = array();
$tmb = mysql_real_escape_string($tmb);
$res = mysql_query("SELECT code,name FROM moo WHERE tmb = '$tmb'");
while ($row = mysql_fetch_array($res)) {
  $result[] = array(
    'code' => $row['code'],
    'name' => $row['name'],
  );
}
echo json_encode($result);
?>
