<?php
session_start();
?>
<!DOCTYPE html> 
<html>
    <head>
        <?php require 'lib.php'; ?>
    </head> 
    <body> 
        <div data-role="page" id="page-1">
            <div data-role="header" data-position="fixed" data-theme="f">
                <a href="#" data-icon="back">Back</a>
                <?php require 'txt_head.php'; ?>
                <a href="#" data-icon="info">About</a>
            </div>
            <div data-role="content" data-theme="f">
                <div> 
                    หน่วยงาน : <?php echo "($_SESSION[level]) $_SESSION[off_name],$_SESSION[pcucode]  เข้าใช้งาน $_SESSION[login_count] ครั้ง"; ?>
                </div>
                <div class="ui-body ui-body-f" align="center">
                    // content
                </div>

            </div> <!-- end content -->
            <div data-role="footer" data-position="fixed" data-theme="f" >                
                <?php require 'txt_foot.php'; ?>
            </div>
        </div>  <!-- end page-1 -->


    </body>
</html>
