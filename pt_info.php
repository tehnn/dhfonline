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
                        <h3>cid:3650000234556,hn:00223333</h3>
                        <h3>เริ่มป่วย:2014-02-13,รับรักษา:2014-02-14</h3>
                        <h3>แจ้งcase:2014-02-15 23:00:01,รับcase:2014-02-15 12:00:01</h3>                       
                        <h3>ส่งจาก:รพ.นครไทย,รับโดย:รพ.สต.นครชุม</h3> 
                        <h3>ข้อมูล :</h3>
                        <p>
                            ssssssssssssssssssssssssssssssssssssssssssssssssssss
                            sssssssssssssssssssssssssssssssssssssssssssssssssssss
                            sssssssssssssssssssssssssssssssssssssssssssssssssss
                            sssssssssssssssssssssssssssssssssssssssssssssssssss
                            ssssssssssssssssssssssssssssssssssssssssssssssssss
                        </p>                        
                        <hr>
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
