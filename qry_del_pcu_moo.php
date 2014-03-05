<?php
session_start();
$id = $_GET[id];
$pcucode = $_SESSION['login_pcucode'];
if (!empty($id)) {

    require './condb.php';

    $sql = "delete from pcu_moo where id='$id' and pcucode='$pcucode'";

    mysql_query($sql);
    //exit;   
}
?>
<script>
    window.location = 'frm_setting.php';
</script>

