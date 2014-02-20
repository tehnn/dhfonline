<?php
require 'condb.php';
$amp=$_GET[amp];
//$amp=6503;
$result = array();
$amp = mysql_real_escape_string($amp);
$res = mysql_query("SELECT code,name FROM tmb WHERE amp = '$amp'");
while ($row = mysql_fetch_array($res)) {
  $result[] = array(
    'code' => $row['code'],
    'name' => $row['name'],
  );
}
echo json_encode($result);
?>
