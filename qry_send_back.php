<?php
session_start();
$login_user = $_SESSION['login_user'];
$login_pcucode = $_SESSION['login_pcucode'];
?>
<meta charset="UTF-8">
<?php
if (!empty($_GET[pid])) {
    $pid = $_GET[pid];
    require 'condb.php';
    $sql = "update patient_hos set send_to_amp='6500',send_back_by='$login_pcucode' where pid=$pid";
    mysql_query($sql) or die(mysql_error());

    $sql = "delete from receive where pid=$pid";
    mysql_query($sql);
    echo "<div align='center'><a href='pt_info.php?pid=$pid'>ส่งกลับสำเร็จ</a></div>";
}
?>

