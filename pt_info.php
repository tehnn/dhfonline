<?php
session_start();
?>
<!DOCTYPE html> 
<html>
    <head>
        <style>
            @media print{
                div[data-role="header"]{
                    display: none;
                }
                div[data-role="footer"]{
                    display: none;
                }
                a[data-role="button"]{
                    display: none;
                }
               
                ul[data-role="listview"]{
                    background-color: white;
                    
                }
                li[data-role="fieldcontain"]{
                    color: black;
                     
                     
                }
            }
        </style>
        <?php require 'lib.php'; ?>
    </head> 
    <body> 
        <div data-role="page" id="page-1">
            <div data-role="header" data-position="fixed" data-theme="f">
                <a href="main_screen.php" rel="external" data-icon="back">Back</a>
                <?php require 'txt_head.php'; ?>
                <a href="#" rel="external" onclick=" window.print();" data-icon="info">Print</a>
            </div>
            <div data-role="content" data-theme="f">
                <?php require 'office_title.php'; ?>
                <ul data-role="listview" data-inset="true">
                    <li data-role="fieldcontain">
                        <img src="img_ic/people.png">
                        <h2>นายสมศักดิ์ เลิสคน,33ป 6ด</h2>
                        <p><strong>เริ่มป่วย: 2014-02-13,รับรักษา:2014-02-14,แจ้งcase: 2014-02-15</strong></p>
                        <p>cid :3650000234556,hn :00223333</p>
                        <p>ส่งจาก :</p>
                        <p><a href="#">แผนที่บ้านผู้ป่วย</a></p>
                        <h4>
                            วันสอบสวน : 
                            <?php
                            for ($i = 1; $i <= 3; $i++) {
                                ?>
                                <a  href="pt_info_home.php?pid=1111&invest_time=<?= $i ?>" rel="external">2014-01-15</a>, 
                                <?php
                            }
                            ?>
                        </h4>
                    </li>

                </ul>
                <?php
                if ($_GET[hos_own] <> 'y') {
                    ?>
                    <a href="frm_add_pt_home.php" rel="external" data-icon ="plus" data-role="button">บันทึกสอบสวนโรค</a>
                    <?php
                }
                ?>



            </div> <!-- end content -->
            <div data-role="footer" data-position="fixed" data-theme="f"  class="ui-bar" >

                <?php require 'txt_foot.php'; ?>
            </div>
        </div>  <!-- end page-1 -->


    </body>
</html>
