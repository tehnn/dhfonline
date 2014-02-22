<?php
session_start();
if (empty($_SESSION['login_user'])) {
    exit("You don't have permission.Account cause.");
}
$login_user = $_SESSION['login_user'];
$login_off_name = $_SESSION['login_off_name'];
$login_pcucode = $_SESSION['login_pcucode'];
$login_prov_code = $_SESSION['login_prov_code'];
$login_amp_code = $_SESSION['login_amp_code'];
$login_tmb_code = $_SESSION['login_tmb_code'];
$login_level = $_SESSION['login_level'];
$login_count = $_SESSION['login_count'];


?>
<!DOCTYPE html> 
<html>
    <head>
        <?php require 'lib.php'; ?>
    </head> 
    <body> 
        <div data-role="page" id="page-1">
            <div data-role="header" data-position="fixed" data-theme="f">
                <a href="#" data-rel="back" data-icon="back">Back</a>
                <?php require 'txt_head.php'; ?>
                <a href="#" data-icon="info">About</a>
            </div>
            <div data-role="content" data-theme="f">
                <div> 
                    ยืนยันการส่งผู้ป่วยกลับให้ สสจ.
                </div>
                <div class="ui-body ui-body-f" align="center">
                    <a href="qry_send_back.php?pid=<?=$_GET[pid]?>" data-role="button" rel="external" data-icon="check">ตกลง</a>
                    <a href="pt_info.php?pid=<?=$_GET[pid]?>" data-role="button" rel="external" data-icon="delete">ยกเลิก</a>
                </div>

            </div> <!-- end content -->
            <div data-role="footer" data-position="fixed" data-theme="f" >                
                <?php require 'txt_foot.php'; ?>
            </div>
        </div>  <!-- end page-1 -->


    </body>
</html>
