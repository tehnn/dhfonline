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

            function validate() {
                var validate_pass = true;
                var validate_msg = "";

                var hn = $("#hn").val();
                var name = $("#name").val();
                var code506 = $("#code506").val();
                var date_found = $("#date_found").val();
                var send_to_amp = $("#send_to_amp").val();
                var sender = $("#sender").val();

                if (hn == '' || hn == null) {
                    validate_pass = false;
                    validate_msg += "hn ว่าง\r\n";
                }
                if (name == '' || name == null) {
                    validate_msg += "ชื่อ ว่าง\r\n";
                    validate_pass = false;
                }
                if (code506 == '' || code506 == null) {
                    validate_msg += "รหัสโรค ว่าง\r\n";
                    validate_pass = false;
                }
                if (date_found == '' || date_found == null) {
                    validate_msg += "วันรับรักษา ว่าง\r\n";
                    validate_pass = false;
                }
                if (send_to_amp == '' || send_to_amp == null) {
                    validate_msg += "อำเภอ ว่าง\r\n";
                    validate_pass = false;
                }
                if (sender == '' || sender == null) {
                    validate_msg += "ผู้รายงาน ว่าง\r\n";
                    validate_pass = false;
                }
                if (validate_msg != "") {
                    alert(validate_msg);
                }
                return validate_pass;
            }
        </script>

    </head> 
    <body> 
        <div data-role="page" id="page-1">
            <div data-role="header" data-position="fixed" data-theme="f">
                <a href="#" data-rel="back" data-icon="back">Back</a>
                <?php require 'txt_head.php'; ?>
                <a href="#" data-icon="info">About</a>
            </div>
            <div data-role="content" data-theme="f">
                <?php require 'office_title.php'; ?>
                <form action="qry_add_pt_hos.php" 
                      id="frm_hos" name="frm_hos"
                      data-ajax="false" method="post"
                      enctype="multipart/form-data"
                      onsubmit="return validate()">
                    <!-- hidden field -->
                    <input type="hidden"  name="office_own" value="<?= $_SESSION[pcucode] ?>"/>
                    <input type="hidden"  name="user_own" value="<?= $_SESSION[user] ?>"/>                    

                    <ul data-role="listview" data-inset="true">
                        <li data-role="fieldcontain">
                            <label for="hn">HN:</label>
                            <input type="text" name="hn" id="hn"  data-clear-btn="true">
                        </li>
                        <li data-role="fieldcontain">
                            <label for="prename">คำนำหน้า:</label>
                            <input type="text" name="prename" id="prename" data-clear-btn="true" placeholder="นาย/นาง/น.ส./ด.ช./ด.ญ.">
                        </li>
                        <li data-role="fieldcontain">
                            <label for="name">ชื่อผู้ป่วย:</label>
                            <input type="text" name="name" id="name" data-clear-btn="true">
                        </li>
                        <li data-role="fieldcontain">
                            <label for="lname">นามสกุล:</label>
                            <input type="text" name="lname" id="lname" data-clear-btn="true">
                        </li>
                        <li data-role="fieldcontain">
                            <label for="cid">เลข 13 หลัก:</label>
                            <input type="text" name="cid" id="cid" data-clear-btn="true" maxlength="13">
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
                            <label for="school_workplace">โรงเรียน/สถานที่ทำงาน:</label>
                            <input type="text" name="school_workplace" id="school_workplace" placeholder="โรงเรียน,ชั้นเรียน/สถานที่ทำงาน" data-clear-btn="true">
                        </li>
                          <li data-role="fieldcontain">
                            <label for="tel">เบอร์โทรติดต่อ:</label>
                            <input type="text" name="tel" id="tel" placeholder="เบอร์โทรติดต่อคนไข้/ญาติ" data-clear-btn="true">
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
                            <input type="text" id="addr_home" name="addr_home" placeholder="บ้านเลขที่ หมู่ที่ ถนน ตำบล อำเภอ จังหวัด / หรือ เช่นเดียวกับที่อยู่ขณะป่วย">
                        </li>

                        <li data-role="fieldcontain">
                            <label for="code506">วินิจฉัย:</label>
                            <select name="code506" id="code506">
                                <option value="">รหัสโรค...</option>
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
                            <label for="send_to_amp">ผู้ป่วยในเขตพื้นที่:</label>
                            <select name="send_to_amp" id="send_to_amp">
                                <option value="">อำเภอ...</option>
                                <?php
                                $sql = "select amp,pcucode,off_name from user where off_type='02'";
                                $res = mysql_query($sql);
                                while ($row = mysql_fetch_array($res)) {
                                    ?>
                                    <option value="<?= $row[amp] ?>"><?= $row[off_name] ?></option>

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
                                <div class="ui-block-a"><button type="submit" data-icon="check">ตกลง</button></div>
                                <div class="ui-block-b"><button type="reset" data-icon="delete">ยกเลิก</button></div>                                
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
