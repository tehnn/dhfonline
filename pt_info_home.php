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
$id = $_GET[id];

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
        $sql = "SELECT hm.*,hs.pid,hs.`name`,hs.lname FROM `patient_home` hm
LEFT JOIN patient_hos hs on hm.pid = hs.pid
where hm.id = $id";
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
                        <?php
                        echo "เวลาสอบสวนควบคุมโรค: " . $row[datetime_do];
                        echo "<hr>";
                        echo "pid: " . $row[0];
                        echo "<br>";
                        echo "<h3>".$row[name]." ".$row[lname]."<h2>";
                        ?>
                    </li>

                </ul>


            </div> <!-- end content -->
            <div data-role="footer" data-position="fixed" data-theme="f"  class="ui-bar" >

                <?php require 'txt_foot.php'; ?>
            </div>
        </div>  <!-- end page-1 -->


    </body>
</html>
