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

if ($level <> 'hos') {
    // exit("You don't have permission.Level cause.");
}
require 'condb.php'
?>
<!DOCTYPE html> 
<html>
    <head>
        <?php
        require 'lib.php';
        ?>

        <link rel="stylesheet" type="text/css" href="http://dev.jtsage.com/cdn/datebox/latest/jqm-datebox.min.css" /> 

        <script type="text/javascript" src="http://dev.jtsage.com/cdn/datebox/latest/jqm-datebox.core.min.js"></script>
        <script type="text/javascript" src="http://dev.jtsage.com/cdn/datebox/latest/jqm-datebox.mode.calbox.min.js"></script>
        <script type="text/javascript" src="http://dev.jtsage.com/cdn/datebox/i18n/jquery.mobile.datebox.i18n.en_US.utf8.js"></script>
        <script type="text/javascript" src="http://dev.jtsage.com/cdn/datebox/1.1.0/jqm-datebox-1.1.0.mode.flipbox.js"></script>
        <script>
            $(function() {
                $('#frm_hos').find('input,select').keydown(function(event) {
                    if (event.keyCode == 13) {
                        event.preventDefault();
                    }
                });
            });
        </script>

    </head> 
    <body> 
        <div data-role="page" id="page-1">
            <div data-role="header" data-position="fixed" data-theme="f">
                <a href="hos_list_own_pt.php" rel="external" data-rel="back" data-icon="back">Back</a>
                <?php require 'txt_head.php'; ?>
                <a href="#" data-icon="info">About</a>
            </div>
            <div data-role="content" data-theme="f">
                <?php require 'office_title.php'; ?>
                <form action="qry_pcu_frm_add_invest.php" id="frm_pcu" name="frm_pcu"
                      data-ajax="false" method="post"
                      enctype="multipart/form-data">
                    <!-- hidden field -->
                    <input type="hidden"  name="office_own" value="<?= $_SESSION[pcucode] ?>"/>
                    <input type="hidden"  name="user_own" value="<?= $_SESSION[user] ?>"/>                    

                    <ul data-role="listview" data-inset="true">
                        <li data-role="fieldcontain">
                            <img src="img_ic/people.png">
                        </li>
                        <li data-role="fieldcontain">
                            <label for="hn">HN:</label>
                            <input type="text" name="hn" id="hn"  data-clear-btn="true">
                        </li>
                        <li data-role="fieldcontain">
                            <label for="prename">คำนำหน้า:</label>
                            <input type="text" name="prename" id="prename" data-clear-btn="true">
                        </li>
                        <li data-role="fieldcontain">
                            <label for="name">ชื่อผู้ป่วย:</label>
                            <input type="text" name="name" id="name" data-clear-btn="true">
                        </li>
                        <li data-role="fieldcontain">
                            <label for="name">นามสกุล:</label>
                            <input type="text" name="lname" id="lname" data-clear-btn="true">
                        </li>
                        <li data-role="fieldcontain">
                            <label for="cid">เลข 13 หลัก:</label>
                            <input type="text" name="cid" id="cid" data-clear-btn="true">
                        </li>
                        <li data-role="fieldcontain">
                            <label for="sex">เพศ:</label>
                            <select name="sex" id="sex" data-role="slider">
                                <option value="1">ชาย</option>
                                <option value="2">หญิง</option>
                            </select>
                        </li>
                        <li data-role="fieldcontain">
                            <label for="bdate">ว/ด/ป เกิด:</label>
                            <input name="bdate" id="bdate" placeholder="(ค.ศ. เท่ากับ พ.ศ. ลบด้วย 543)"
                                   type="date" data-role="datebox"
                                   data-options='{"mode": "flipbox","overrideDateFormat": "%Y-%m-%d"}'
                                   /> 
                        </li>

                        <li data-role="fieldcontain">
                            <label for="occupat">อาชีพ:</label>
                            <input type="text" name="occupat" id="occupat" data-clear-btn="true">
                        </li>
                        <li data-role="fieldcontain">
                            <label for="occupat">โรงเรียน:</label>
                            <input type="text" name="occupat" id="occupat" placeholder="โรงเรียน,ชั้นเรียน" data-clear-btn="true">
                        </li>

                        <li data-role="fieldcontain">
                            <label for="date_ill">ว/ด/ป เริ่มป่วย:</label>
                            <input name="date_ill" id="date_ill" placeholder="(ค.ศ. เท่ากับ พ.ศ. ลบด้วย 543)"
                                   type="date" data-role="datebox"
                                   data-options='{"mode": "flipbox","overrideDateFormat": "%Y-%m-%d"}'
                                   /> 
                        </li>
                        <li data-role="fieldcontain">
                            <label for="date_found">ว/ด/ป รับรักษา:</label>
                            <input name="date_found" id="date_found" placeholder="(ค.ศ. เท่ากับ พ.ศ. ลบด้วย 543)"
                                   type="date" data-role="datebox"
                                   data-options='{"mode": "flipbox","overrideDateFormat": "%Y-%m-%d"}'
                                   /> 
                        </li>

                        <li data-role="fieldcontain">
                            <label for="addr_ill">ที่อยู่ขณะป่วย:</label>
                            <input type="text" name="addr_ill" id="addr_ill" placeholder="บ้านเลขที่ หมู่ที่ ถนน ตำบล อำเภอ จังหวัด">
                        </li>

                        <li data-role="fieldcontain">
                            <label for="addr_home">ภูมิลำเนา:</label>
                            <input type="text" id="addr_home" placeholder="บ้านเลขที่ หมู่ที่ ถนน ตำบล อำเภอ จังหวัด / หรือ เช่นเดียวกับที่อยู่ขณะป่วย">
                        </li>

                        <li data-role="fieldcontain">
                            <label for="code506">วินิจฉัย:</label>
                            <select name="code506" id="code506">
                                <option value="26">26=DHF</option>
                                <option value="27">27=DSS</option>
                                <option value="66">66=DF</option>

                            </select>
                        </li>
                        <li data-role="fieldcontain">
                            <label for="icd10">ICD-10-TM:</label>
                            <input type="text" name="icd10" id="icd10" data-clear-btn="true">
                        </li>

                        <li data-role="fieldcontain">
                            <label for="note_text">บันทึกการสอบสวนโรคที่ รพ.:</label>
                            <textarea cols="40" rows="8" name="note_text" id="note_text" placeholder="อาการ/อาการแสดง/ผลทางห้องปฏิบัติการ/ประวัติเดินทาง/อื่นๆ"></textarea>
                        </li>

                        <li data-role="fieldcontain">
                            <label for="img_pt">รูปผู้ป่วย:</label>
                            <input type="file" name="img_pt" id="img_pt">
                        </li>

                        <li data-role="fieldcontain">
                            <label for="sent_to_amp">ส่ง CASE ให้:</label>
                            <select name="sent_to_amp" id="sent_to_amp">
                                <option >ศูนย์ระบาดอำเภอ...</option>

                                <?php
                                $sql = "select concat(prov,amp) as acode,pcucode,off_name from user where off_type='02'";
                                $res = mysql_query($sql);
                                while ($row = mysql_fetch_array($res)) {
                                    ?>
                                    <option value="<?= $row[pcucode] ?>"><?= $row[off_name] ?></option>

                                    <?php
                                }
                                ?>


                            </select>
                        </li>

                        <li data-role="fieldcontain">
                            <label for="sender">ผู้รายงาน:</label>
                            <input type="text" name="sender" id="sender" placeholder="ชื่อ-นามสกุลผู้รายงาน /เบอร์โทร">
                        </li>


                        <li class="ui-body ui-body-f">
                            <fieldset class="ui-grid-a">
                                <div class="ui-block-a"><button type="reset" data-icon="delete">ยกเลิก</button></div>
                                <div class="ui-block-b"><button type="submit" data-icon="check">ตกลง</button></div>
                            </fieldset>
                        </li>

                    </ul>


                </form>

            </div> <!-- end content -->
            <div data-role="footer" data-position="fixed" data-theme="f" >                
                <?php require 'txt_foot.php'; ?>
            </div>
        </div>  <!-- end page-1 -->


    </body>
</html>
