<?php

session_start();
require 'condb.php';

$user = $_POST['user'];
$pass = $_POST['pass'];

$sql = "select * from user where user='$user' and pass='$pass' and permit='y'";
$res = mysql_query($sql) or die(mysql_error());
$num = mysql_num_rows($res) or die(mysql_error());
$row = mysql_fetch_array($res);
if ($num > 0) {
    //echo trim("ok");   
    $last = date("Y-m-d H:i:s");
    mysql_query("update user set last_login='$last',login_count=login_count+1 where user='$user'") or die(mysql_error());
    $_SESSION['login_user'] = $row['user'];
    $_SESSION['login_off_name'] = $row['off_name'];
    $_SESSION['login_pcucode'] = $row['pcucode'];
    $_SESSION['login_prov_code'] = $row['prov'];
    $_SESSION['login_amp_code'] = $row['amp'];
    $_SESSION['login_tmb_code'] = $row['tmb'];
    $_SESSION['login_level'] = $row['level'];
    $_SESSION['login_count'] = (int) $row['login_count'] + 1;

    echo trim("ok");
}
?>
