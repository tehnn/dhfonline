<?php
session_start();
if (empty($_SESSION['user'])) {
    //exit("You don't have permission.Account cause.");
}
$user = $_SESSION['user'];
$off_name = $_SESSION['off_name'];
$pcucode = $_SESSION['pcucode'];
$prov_code = $_SESSION['prov_code'];
$amp_code = $_SESSION['amp_code'];
$tmb_code = $_SESSION['tmb_code'];
$level = $_SESSION['level'];
$login_count = $_SESSION['login_count'];

////

$pid = $_GET[pid];
$hos_own = $_GET[hos_own];

if ($level <> 'hos') {
    // exit("You don't have permission.Level cause.");
}
require 'condb.php';
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

        <?php
        $sql = "select u.off_name,pt.*,TIMESTAMPDIFF(YEAR,pt.bdate,pt.date_found) AS agey,rp.pcu_receive,rp.datetime_receive,rp.off_name as off_name_receive from patient_hos pt
LEFT JOIN (select rc.*,uu.pcucode,uu.off_name from receive rc LEFT JOIN user uu on rc.pcu_receive=uu.pcucode ) as rp on pt.pid=rp.pid
LEFT JOIN user u on pt.office_own = u.pcucode
where pt.pid='$pid'";
        $result = mysql_query($sql);
        $row = mysql_fetch_array($result);
        ?>
        <div data-role="page" id="page-1">
            <div data-role="header" data-position="fixed" data-theme="f">
                <a href="#" data-rel="back"  data-icon="back">Back</a>
                <?php require 'txt_head.php'; ?>
                <a href="#" rel="external" onclick=" window.print();" data-icon="info">Print</a>
            </div>
            <div data-role="content" data-theme="f">
                <?php require 'office_title.php'; ?>
                <ul data-role="listview" data-inset="true">

                    <li data-role="fieldcontain">
                        <img src="img_pt/nopic.png">
                        <p>pid:<?= $row[pid] ?></p>
                        <h2><?= $row[prename] . $row[name] . " " . $row[lname] ?></h2>
                        <p><?= $row[sex] == 1 ? 'ชาย' : 'หญิง' ?>,เกิด<?= $row[bdate] ?>,อายุ <?= $row[agey] ?>ปี</p>
                        <h3>cid:<?= $row[cid] ?>,hn:<?= $row[hn] ?></h3>
                        <h3>เริ่มป่วย:<?= $row[date_ill] ?>,รับรักษา:<?= $row[date_found] ?></h3>
                        <h3>แจ้งcase:<?= $row[datetime_send] ?></h3>
                        <h3>รับcase:<?= $row[datetime_receive] ?></h3>                       
                        <h3>ส่งจาก:<?= $row[off_name] ?>,รับโดย:<?= $row[off_name_receive] ?></h3> 
                        <h3>ข้อมูลผู้ป่วย :</h3>
                        <p>
                            <?= nl2br($row[note_text]) ?>
                        </p>                        
                        <hr>
                        <h4>
                            วันสอบสวน : 
                            <?php
                            $result_invest = mysql_query("select id,date(datetime_do) as dtd from patient_home where pid='$pid'");
                            while ($rw = mysql_fetch_array($result_invest)) {
                                ?>
                                <a  href="pt_info_home.php?pid=<?= $pid ?>&id=<?= $rw[id] ?>" rel="external"><?= $rw[dtd] ?></a>, 
                                <?php
                            }
                            ?>
                        </h4>
                    </li>

                </ul>
                <?php
                if (empty($row[datetime_receive])) {
                    ?>
                    <div align="center">
                        <a href="qry_receive_case.php?pid=<?= $row[pid] ?>&pcu_receive=<?= $pcucode ?>" rel="external" data-role="button"  data-icon="check" data-inline="true">รับ case</a>
                        <a href="main_screen.php" rel="external" data-role="button"  data-icon="delete" data-inline="true">ยกเลิก</a>
                    </div>
                    <?php
                }
                ?>
                <?php
                
                if ($row[pcu_receive] == "$pcucode") {
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
