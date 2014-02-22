<?php
session_start();
if (empty($_SESSION['login_user'])) {
    //exit("You don't have permission.Account cause.");
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
        $sql = "SELECT hm.*,hs.pid,hs.`name`,hs.lname FROM `patient_home` hm
LEFT JOIN patient_hos hs on hm.pid = hs.pid
where hm.id = $_GET[id]";
        $result = mysql_query($sql);
        $row = mysql_fetch_array($result);
        ?>
        <div data-role="page" id="page-1">
            <div data-role="header" data-position="fixed" data-theme="f">
                <a href="pt_info.php?pid=<?=$_GET[pid]?>" rel="external"  data-icon="back">Back</a>
                <?php require 'txt_head.php'; ?>
                <a href="#" rel="external" onclick=" window.print();" data-icon="info">Print</a>
            </div>
            <div data-role="content" data-theme="f">
                <?php require 'office_title.php'; ?>
                <ul data-role="listview" data-inset="true">

                    <li data-role="fieldcontain">
                        <?php
                        echo "วันที่/เวลา ดำเนินการ: " . $row[datetime_do];
                        echo "<hr>";

                        echo "<h3>" . $row[name] . " " . $row[lname] . "<h2>";
                        ?>
                        <br>
                        <p>
                            ที่อยู่ <?= $row[addr] . " ," . $row[road] . " ," . $row[tmb] . " ," . $row[amp] ?> 
                            แผนที่ : <a target="_blank" href="http://maps.google.com?q=<?= $row[lat] ?>,<?= $row[lng] ?>">คลิก</a>
                        </p>
                    </li>
                    <li data-role="fieldcontain">
                        <h3><?= nl2br($row[note_patient]) ?></h3>


                    </li>
                    <li data-role="fieldcontain">
                        <h3><?= nl2br($row[note_home]) ?></h3>


                    </li>
                    <li data-role="fieldcontain">
                        <h3><?= nl2br($row[note_activity]) ?></h3>

                    </li>

                    <li data-role="fieldcontain">
                        <p> ผู้บันทึก: <?= $row[reporter] ?></p>

                    </li>


                </ul>


            </div> <!-- end content -->
            <div data-role="footer" data-position="fixed" data-theme="f"  class="ui-bar" >

                <?php require 'txt_foot.php'; ?>
            </div>
        </div>  <!-- end page-1 -->


    </body>
</html>
