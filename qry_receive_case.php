<meta charset="UTF-8">
<?php
if (!empty($_GET)) {
    require 'condb.php';
    $pid = $_GET[pid];
    $pcu_receive = $_GET[pcu_receive];
    $datetime_receive = date("Y-m-d H:i:s");

    $sql = "insert into receive (pid,pcu_receive,datetime_receive)values('$pid','$pcu_receive','$datetime_receive')";

    if (mysql_query($sql)) {
        ?>
        <script>
            alert("Receive case successful!!");
            window.location = 'pt_info.php?pid=<?= $pid ?>';
        </script>
        <?php
    } else {
        ?>
        <script>
            alert("<?= mysql_error() ?>");
            window.history.back();
        </script>
        <?php
    }
}
?>
