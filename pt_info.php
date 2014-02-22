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

if ($login_level <> 'hos') {
    // exit("You don't have permission.Level cause.");
}
////


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
        <style>
            .map-div{
                height: 300px;
                width: 100%;

            }
        </style>
        <?php require 'lib.php'; ?>


    </head> 
    <body> 

        <?php
        $sql = "select pt.pid,CONCAT(pt.prename,pt.name,' ',pt.lname) as fullname
,pt.hn,pt.cid
,pt.sex,pt.bdate,TIMESTAMPDIFF(YEAR,pt.bdate,pt.date_found) as agey
,pt.occupat,pt.school_workplace ,
CONCAT(pt.addr,' ม.',SUBSTR(pt.moo,7,2),' ',moo.`name`,'  ต.',tmb.`name`,'  อ.',amp.`name`) as address
,off_own.off_name as send_from,pt.date_ill,pt.date_found,pt.datetime_send
,rp.datetime_receive,rp.pcu_receive as receiver,rp.off_name as receiver1
,pt.icd10,pt.code506,pt.lab_wbc,pt.lab_plt,pt.lab_hct,pt.lab_tt,pt.symtom
,pt.refer_from,pt.note_text
from patient_hos pt
LEFT JOIN (select r.*,u.off_name from receive r LEFT JOIN user u on r.pcu_receive = u.pcucode) rp on rp.pid = pt.pid
LEFT JOIN user off_own on off_own.pcucode=pt.office_own
LEFT JOIN moo moo on moo.`code` = pt.moo
LEFT JOIN tmb tmb on tmb.`code`=pt.tmb
LEFT JOIN amp amp on amp.`code` = pt.amp
where pt.pid ='$_GET[pid]'";

        $result = mysql_query($sql);
        $row = mysql_fetch_array($result);
        ?>
        <div data-role="page" id="page-1">
            <div data-role="header" data-position="fixed" data-theme="f">
                <a href="main_screen.php" rel="external"  data-icon="back">Back</a>
                <?php require 'txt_head.php'; ?>
                <a href="#" rel="external" onclick=" window.print();" data-icon="info">Print</a>
            </div>
            <div data-role="content" data-theme="f">
                <?php require 'office_title.php'; ?>
                <ul data-role="listview" data-inset="true">

                    <li data-role="fieldcontain">
                        <img src="img_pt/nopic.png">
                        <p>pid:<?= $row[pid] ?></p>
                        <h2><?= $row[fullname] ?></h2>
                        <p><?= $row[sex] == 1 ? 'ชาย' : 'หญิง' ?>,เกิด<?= $row[bdate] ?>,อายุ <?= $row[agey] ?>ปี ,อาชีพ <?= $row[occupat] ?></p>
                        <p>cid:<?= $row[cid] ?>,hn:<?= $row[hn] ?></p>
                        <p>อาชีพ:<?= $row[occupat] . " ที่ " . $row[school_workplace] . " " . $row[tel] ?></a></p>
                        <p>ที่อยู่ขณะป่วย:<?= $row[address] ?></p>    
                        <p>ส่งจาก:<?= $row[send_from] ?>,ป่วย<?= $row[date_ill] ?>,พบ<?= $row[date_found] ?>,แจ้ง<?= $row[datetime_send] ?></p>
                        <p>รับ:<?= $row[receiver] . "-" . $row[receiver1] ?>,เมื่อ<?= $row[datetime_receive] ?></p>
                        <hr>
                        <p>รหัสโรค:<?= $row[code506] ?>,icd10:<?= $row[icd10] ?>
                            Lab-wbc:<?= $row[lab_wbc] ?>,
                            Lab-plt:<?= $row[lab_plt] ?>,
                            Lab-hct:<?= $row[lab_hct] ?>,
                            Lab-tt:<?= $row[lab_tt] ?>

                        </p>
                        <hr>                        
                        <h4>
                            วันสอบสวน : 
                            <?php
                            $result_invest = mysql_query("select id,date(datetime_do) as dtd from patient_home where pid='$_GET[pid]'");
                            while ($rw = mysql_fetch_array($result_invest)) {
                                ?>
                                <a  href="pt_info_home.php?pid=<?= $_GET[pid] ?>&id=<?= $rw[id] ?>" rel="external"><?= $rw[dtd] ?></a>, 
                                <?php
                            }
                            ?>
                        </h4>
                    </li>

                </ul>
                <?php
                if (empty($row[receiver]) and $_GET[hos_own] <> "y" and $login_level <> 'amp') {
                    ?>
                    <div align="center">
                        <a href="qry_receive_case.php?pid=<?= $row[pid] ?>&pcu_receive=<?= $login_pcucode ?>" rel="external" data-role="button"  data-icon="check" data-inline="true">รับ case</a>
                        <a href="main_screen.php" rel="external" data-role="button"  data-icon="delete" data-inline="true">ยกเลิก</a>
                    </div>
                    <?php
                }
                ?>
                <?php
                if ($row[receiver] == $login_pcucode) {
                    ?>
                    <a href="frm_add_pt_home.php?pid=<?= $row[pid] ?>" rel="external" data-icon ="check" data-role="button">บันทึกสอบสวนโรค</a>
                    <a href="qry_send_back.php?pid=<?= $row[pid] ?>" rel="external" data-icon ="forward" data-role="button">ส่ง CASE กลับให้ สสจ.</a>
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
