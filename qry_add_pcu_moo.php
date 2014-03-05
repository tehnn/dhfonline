<?php
session_start();
echo $moo = $_GET[moo];
echo "<br>";
echo $pcucode = $_SESSION['login_pcucode'];

//exit;
if (!empty($moo)) {

    require './condb.php';

    $sql = "insert into pcu_moo (id,pcucode,moo) values (null,'$pcucode','$moo')";

    mysql_query($sql);
    //exit;   
}
?>
<script>
    window.location = 'frm_setting.php';
</script>
