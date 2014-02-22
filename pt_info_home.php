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
        <?php require 'lib.php'; ?>
    </head> 
    <body> 

        <?php
        $sql = "SELECT  CONCAT(pt.prename,pt.`name`,' ',pt.lname) as fullname,pt.date_ill,
CONCAT(pt.addr,' ม.',SUBSTR(pt.moo,7,2),'  ',moo.`name`,'  ต.',tmb.`name`,'  อ.',amp.`name`) as address,
ph.*
from patient_home ph
LEFT JOIN patient_hos pt on pt.pid = ph.pid
LEFT JOIN moo moo on moo.`code` = pt.moo
LEFT JOIN tmb tmb on tmb.`code`=pt.tmb
LEFT JOIN amp amp on amp.`code` = pt.amp
where ph.pid='$_GET[pid]' and ph.id=$_GET[id]";
        $result = mysql_query($sql);
        $row = mysql_fetch_array($result);
        ?>
        <div data-role="page" id="page-1">
            <div data-role="header" data-position="fixed" data-theme="f">
                <a href="pt_info.php?pid=<?= $_GET[pid] ?>" rel="external"  data-icon="back">Back</a>
                <?php require 'txt_head.php'; ?>
                <a href="#" rel="external" onclick=" window.print();" data-icon="info">Print</a>
            </div>
            <div data-role="content" data-theme="f">
                <?php require 'office_title.php'; ?>
                <ul data-role="listview" data-inset="true">

                    <li data-role="fieldcontain">
                        วันที่/เวลา ดำเนินการ: <?= $row[datetime_do] ?>
                        <h3><?= $row[fullname] ?>  ,ป่วย:<?= $row[date_ill] ?></h3>

                        <p><?= $row[address] ?>, <?= $row[occupat] ?>,<?= $row[school_workplace] ?></p>

                        <p>
                            <?php
                            if (!empty($row[date_ill_diff])) {
                                echo "ระยะห่างของวันเริ่มป่วยกับรายก่อนหน้านี้ในชุมชนเดียวกัน $row[date_ill_diff] วัน";
                            }
                            ?>
                        </p>
                        <p>
                            ภายใน 14 วันก่อนป่วยได้เดินทางไปที่ :<?= $row[travel_to] ?>,วันที่เดินทาง <?= $row[date_travel] ?>
                        </p>
                        <br>
                        <p><b>การสำรวจค่าดัชนีลูกน้ำยุงลาย</b></p>
                        <p>บ้านผู้ป่วย : สำรวจ..<?= $row[s1] ?> ภาชนะ พบ..<?= $row[f1] ?> ภาชนะ ,CI=<?= $row[ci1] ?></p>
                        <p>ที่ทำงาน/โรงเรียน : สำรวจ..<?= $row[s2] ?> ภาชนะ พบ..<?= $row[f2] ?> ภาชนะ ,CI=<?= $row[ci2] ?></p>
                        <p>วัด/ศาสนสถาน : สำรวจ..<?= $row[s3] ?> ภาชนะ พบ..<?= $row[f3] ?> ภาชนะ ,CI=<?= $row[ci3] ?></p>
                        <p>หมู่บ้าน/ชุมชน : สำรวจ..<?= $row[s4] ?> หลัง พบ..<?= $row[f4] ?> หลัง,HI=<?= $row[hi] ?></p>
                        <p>หมู่บ้าน/ชุมชน : สำรวจ..<?= $row[s5] ?> ภาชนะ พบ..<?= $row[f5] ?> ภาชนะ,CI=<?= $row[ci] ?> , BI=<?= $row[bi] ?></p>

                        <br>
                        <p><b>กิจกรรม</b></p>
                        <p>พ่นสารเคมีกำจัดยุงตัวเต็มวัย..<?= $row[num_spray_home] ?> หลัง</p>
                        <p>ทำลายแหล่งเพาะพันธุ์ กำจัดลูกน้ำยุงลาย..<?= $row[num_destroy_home] ?> หลัง</p>
                        <p>
                            <?php
                            if (!empty($row[chk_meeting])) {
                                echo "ทำประชุม/ประชาคมหมู่บ้าน";
                            }
                            echo ",";
                            if (!empty($row[chk_campaign])) {
                                echo "รณรงค์ประชาสัมพันธ์ ให้ความรู้ประชาชน";
                            }
                            ?>
                        </p>
                        <p><?= $row[note_other] ?></p>

                        <p>สภาพแวดล้อม , <?= nl2br($row[note_env]); ?></p>
                        <p>ข้อเสนอแนะ/สรุปผล ,<?= nl2br($row[note_sum]); ?></p>

                        <h3> ผู้บันทึก: <?= $row[reporter] ?></h3>

                    </li>


                </ul>
                <a href="img_hm/<?= $row[img_act] ?>" target="_blank">รูปกิจกรรม</a>


            </div> <!-- end content -->
            <div data-role="footer" data-position="fixed" data-theme="f"  class="ui-bar" >

                <?php require 'txt_foot.php'; ?>
            </div>
        </div>  <!-- end page-1 -->


    </body>
</html>
