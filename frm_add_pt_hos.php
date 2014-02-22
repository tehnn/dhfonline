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
        <meta charset="UTF-8"/>

        <link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
        <script src="//code.jquery.com/jquery-1.9.1.js"></script>
        <script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
        <script>
            $(function() {
                $("#date_dx").datepicker({
                    dayNamesMin: ['อา', 'จ', 'อ', 'พ', 'พฤ', 'ศ', 'ส'],
                    monthNamesShort: ['มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฎาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม'],
                    changeMonth: true,
                    changeYear: true,
                    showOn: "button",
                    dateFormat: "yy-mm-dd"
                });
                $("#bdate").datepicker({
                    dayNamesMin: ['อา', 'จ', 'อ', 'พ', 'พฤ', 'ศ', 'ส'],
                    monthNamesShort: ['มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฎาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม'],
                    changeMonth: true,
                    changeYear: true,
                    showOn: "button",
                    dateFormat: "yy-mm-dd"
                });

                $("#date_ill").datepicker({
                    dayNamesMin: ['อา', 'จ', 'อ', 'พ', 'พฤ', 'ศ', 'ส'],
                    monthNamesShort: ['มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฎาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม'],
                    changeMonth: true,
                    changeYear: true,
                    showOn: "button",
                    dateFormat: "yy-mm-dd"
                });

                $("#date_found").datepicker({
                    dayNamesMin: ['อา', 'จ', 'อ', 'พ', 'พฤ', 'ศ', 'ส'],
                    monthNamesShort: ['มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฎาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม'],
                    changeMonth: true,
                    changeYear: true,
                    showOn: "button",
                    dateFormat: "yy-mm-dd"
                });
               
                
                $("#date_refer").datepicker({
                    dayNamesMin: ['อา', 'จ', 'อ', 'พ', 'พฤ', 'ศ', 'ส'],
                    monthNamesShort: ['มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฎาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม'],
                    changeMonth: true,
                    changeYear: true,
                    showOn: "button",
                    dateFormat: "yy-mm-dd"
            });
            });
        </script>

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
                var lname = $("#lname").val();
                var bdate = $("#bdate").val();
                var code506 = $("#code506").val();
                var date_ill = $("#date_ill").val();
                var date_found = $("#date_found").val();
                var amp, tmb, moo, addr;
                amp = $("#amp").val();
                tmb = $("#tmb").val();
                moo = $("#moo").val();
                addr = $("#addr").val();
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
                if (lname == '' || lname == null) {
                    validate_msg += "นามสกุล ว่าง\r\n";
                    validate_pass = false;
                }
                if (bdate == '' || bdate == null) {
                    validate_msg += "วดป.เกิด ว่าง\r\n";
                    validate_pass = false;
                }
                if (code506 == '' || code506 == null) {
                    validate_msg += "รหัสโรค ว่าง\r\n";
                    validate_pass = false;
                }
                if (date_ill == '' || date_ill == null) {
                    validate_msg += "วันเริ่มป่วย ว่าง\r\n";
                    validate_pass = false;
                }
                if (date_found == '' || date_found == null) {
                    validate_msg += "วันพบ ว่าง\r\n";
                    validate_pass = false;
                }

                if (amp == '' || amp == null) {
                    validate_msg += "อำเภอ ว่าง\r\n";
                    validate_pass = false;
                }
                if (tmb == '' || tmb == null) {
                    validate_msg += "ตำบล ว่าง\r\n";
                    validate_pass = false;
                }

                if (moo == '' || moo == null) {
                    validate_msg += "หมู่ที่ ว่าง\r\n";
                    validate_pass = false;
                }

                if (addr == '' || addr == null) {
                    validate_msg += "บ้านเลขที่ ว่าง\r\n";
                    validate_pass = false;
                }


                if (send_to_amp == '' || send_to_amp == null) {
                    validate_msg += "ป่วยในพื้นที่ ว่าง\r\n";
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
        <script>
            $(function() {
                $("select#amp").change(function() {
                    $.getJSON("ajx_list_tmb.php", {amp: $(this).val(), ajax: 'true'}, function(j) {
                        var options = '<option value="">เลือก...</option>';
                        $("select#moo").html(options);//ล้างหมู่
                        for (var i = 0; i < j.length; i++) {
                            options += '<option value="' + j[i].code + '">' + j[i].name + '</option>';
                        }
                        $("select#tmb").html(options);
                    });
                });

                $("select#tmb").change(function() {
                    $.getJSON("ajx_list_moo.php", {tmb: $(this).val(), ajax: 'true'}, function(j) {
                        var options = '<option value="">เลือก...</option>';
                        for (var i = 0; i < j.length; i++) {
                            options += '<option value="' + j[i].code + '">' + j[i].name + '</option>';
                        }
                        $("select#moo").html(options);
                    });
                });
            });
        </script>
        <title>#PLK DHF Online</title>
    </head>
    <body>
        <div align="center">
            <form action="qry_add_pt_hos.php" 
                  id="frm_hos" name="frm_hos"
                  method="post"
                  enctype="multipart/form-data"
                  onsubmit="return validate()">

                <input type="hidden" name="office_own" value="<?= $pcucode ?>">
                <input type="hidden" name="user_own" value="<?= $user ?>">

                <table width="75%" border="1" cellspacing="0" cellpadding="0">
                    <tr bgcolor="#33CCFF">
                        <td bgcolor="#66FFFF">
                        <input type="button" value="ย้อนกลับ" onClick="window.location = 'hos_list_own_pt.php'">
                            แบบสอบสวนโรคไข้เลือดออกในโรงพยาบาล Short Form Report
                            </td>
                    </tr>
                    <tr>
                        <td bgcolor="#66FFFF">

                            <table width="100%" border="0" cellspacing="0" cellpadding="2">
                                <tr>
                                    <td colspan="2" align="left" bgcolor="#3399FF">1.ข้อมูลส่วนบุคคล</td>
                                </tr>
                                <tr>
                                    <td width="16%" align="right" bgcolor="#66FFFF"> HN:</td>
                                    <td width="84%" bgcolor="#66FFFF"> 
                                        <input type="text" name="hn" id="hn">
                                        คำนำหน้า:
                                        <select name="prename" id="prename">
                                            <option value="">เลือก...</option>
                                            <option value="นาย">นาย</option>
                                            <option value="นาง">นาง</option>
                                            <option value="น.ส.">น.ส.</option>
                                            <option value="ด.ช.">ด.ช.</option>
                                            <option value="ด.ญ.">ด.ญ.</option>
                                            <option value="พระ">พระ</option>
                                        </select>
                                        เพศ:
                                        <select name="sex" id="sex">
                                            <option value="">เลือก...</option>
                                            <option value="ชาย">ชาย</option>
                                            <option value="หญิง">หญิง</option>
                                  </select></td>
                                </tr>
                                <tr>
                                    <td align="right" bgcolor="#66FFFF">ชื่อ:</td>
                                    <td bgcolor="#66FFFF"><input type="text" name="name" id="name">
                                        นามสกุล:
                                        <input type="text" name="lname" id="lname">
                                    </td>
                                </tr>
                                <tr>
                                    <td align="right" bgcolor="#66FFFF">เลข13หลัก:</td>
                                    <td bgcolor="#66FFFF"><input type="text" name="cid" id="cid"> 
                                        วดป.เกิด:
                                        <input type="text" name="bdate" id="bdate"></td>
                                </tr>
                                <tr>
                                    <td align="right" bgcolor="#66FFFF">เบอร์โทรติดต่อ:</td>
                                    <td bgcolor="#66FFFF"><input type="text" name="pt_tel" id="pt_tel">
                                        ชื่อญาติ:
                                        <input type="text" name="family" id="family"></td>
                                </tr>
                                <tr>
                                    <td align="right" bgcolor="#66FFFF">อาชีพ:</td>
                                    <td bgcolor="#66FFFF"><input type="text" name="occupat" id="occupat"> 
                                        สถานที่ทำงาน/โรงเรียน :
                                        <input type="text" name="school_workplace" id="school_workplace"></td>
                                </tr>
                                <tr>
                                    <td colspan="2" align="left" bgcolor="#3399FF">2.ข้อมูลการป่วย</td>
                                </tr>
                                <tr>
                                    <td align="right" bgcolor="#00FFFF">วินิจฉัย:</td>
                                    <td bgcolor="#00FFFF">
                                        <select name="code506" id="code506">
                                            <option value="" selected>เลือก...</option>
                                            <option value="26">26=DHF</option>
                                            <option value="27">27=DSS</option>
                                            <option value="66">66=DF</option>

                                        </select>
                                        รหัส ICD-10-TM: 
                                        <input type="text" name="icd10" id="icd10">
                                        ประเภท:
                                        <select name="pt_type" id="pt_type">
                                            <option value="" selected>เลือก...</option>
                                            <option value="OPD">OPD</option>
                                            <option value="IPD">IPD</option>
                                  </select></td>
                                </tr>
                                <tr>
                                    <td align="right" bgcolor="#00FFFF">แพทย์: </td>
                                    <td bgcolor="#00FFFF"><input type="text" name="doctor" id="doctor"> 
                                        วันที่ Dx: 
                                        <input type="text" name="date_dx" id="date_dx"></td>
                                </tr>
                                <tr>
                                    <td align="right" bgcolor="#00FFFF">วันเริ่มป่วย:</td>
                                    <td bgcolor="#00FFFF"><input type="text" name="date_ill" id="date_ill"> 
                                        วันพบผู้ป่วย:
                                        <input type="text" name="date_found" id="date_found">
                                        สภาพผู้ป่วย:
                                        <select name="pt_status" id="pt_status">
                                            <option value="">เลือก...</option>
                                            <option value="หาย">หาย</option>
                                            <option value="ตาย">ตาย</option>
                                            <option value="ยังรักษาอยู่" selected>ยังรักษาอยู่</option>
                                            <option value="ไม่ทราบ">ไม่ทราบ</option>
                                  </select></td>
                                </tr>
                                <tr>
                                    <td align="right" valign="top" bgcolor="#00FFFF">อาการแสดงสำคัญ:</td>
                                    <td bgcolor="#00FFFF"><input type="text" name="symtom" id="symtom" style="width:400px"></td>
                                </tr>
                                <tr>
                                    <td align="right" valign="top" bgcolor="#00FFFF">Refer จาก:</td>
                                    <td bgcolor="#00FFFF"><input type="text" name="refer_from" id="refer_from">
                                        วันที่ Refer :
                                        <input type="text" name="date_refer" id="date_refer"></td>
                                </tr>
                                <tr>
                                    <td colspan="2" align="left" bgcolor="#3399FF">3.ที่อยู่ขณะป่วย</td>
                                </tr>

                                <tr>
                                    <td align="right" bgcolor="#00FFFF">อำเภอ:</td>
                                    <td bgcolor="#00FFFF">
                                        <select name="amp" id="amp">
                                            <option value="">เลือก...</option>
                                            <?php
                                            $res_amp = mysql_query("select code,name from amp");
                                            while ($row_amp = mysql_fetch_array($res_amp)) {
                                                echo "<option value='$row_amp[code]'>$row_amp[name]</option>\r\n";
                                            }
                                            ?>
                                        </select> 
                                        ตำบล:
                                        <select name="tmb" id="tmb">
                                            <option value="">เลือก...</option>
                                        </select> 
                                        หมู่:
                                        <select name="moo" id="moo">
                                            <option value="">เลือก...</option>
                                        </select> 
                                        เลขที่:
                                        <input type="text" name="addr" id="addr" style="width:50px"></td>
                                </tr>

                                <tr>
                                    <td colspan="2" align="right" bgcolor="#00FFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                                <td colspan="2" bgcolor="#3399FF">4.ผลตรวจทางห้องปฏิบัติการ</td>
                                                <td width="50%" bgcolor="#3399FF">5.รายละเอียดอื่นๆ(ถ้ามี)</td>
                                            </tr>
                                            <tr>
                                                <td width="16%" align="right">Wbc.</td>
                                                <td width="34%"><input type="text" name="lab_wbc" id="lab_wbc">
                                                    cell/mm3</td>
                                                <td rowspan="4" align="left" valign="top"><textarea name="note_text" id="note_text" cols="45" rows="5" placeholder="อื่นๆ(ถ้ามี)"></textarea></td>
                                            </tr>
                                            <tr>
                                                <td align="right">Platelet.</td>
                                                <td><input type="text" name="lab_plt" id="lab_plt">
                                                    cell/mm3</td>
                                            </tr>
                                            <tr>
                                                <td align="right">Hct.</td>
                                                <td><input type="text" name="lab_hct" id="lab_hct">
                                                    %</td>
                                            </tr>
                                            <tr>
                                                <td align="right">TT.</td>
                                                <td><input type="radio" name="lab_tt" id="tt" value="บวก">
                                                    บวก
                                                    <input type="radio" name="lab_tt" id="tt2" value="ลบ">
                                                    ลบ
                                                    <input name="lab_tt" type="radio" id="tt3" value="ไม่ทราบ" checked>
                                                    ไม่ทราบ</td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>

                                <tr>
                                    <td align="right" valign="top" bgcolor="#FFCC99">รูปผู้ป่วย:</td>
                                    <td bgcolor="#FFCC99"><input type="file" name="img_pt" id="img_pt"></td>
                                </tr>
                                <tr>
                                    <td align="right" valign="top" bgcolor="#FFCC99">เป็นผู้ป่วยในพื้นที่:</td>
                                    <td bgcolor="#FFCC99">
                                        <select name="send_to_amp" id="send_to_amp">
                                            <option value="" selected>เลือกอำเภอ...</option>
                                            <?php
                                            $res_amp = mysql_query("select code,name from amp");
                                            while ($row_amp = mysql_fetch_array($res_amp)) {
                                                echo "<option value='$row_amp[code]'>$row_amp[name]</option>\r\n";
                                            }
                                            ?>
                                        </select>
                                        ชื่อผู้รายงาน:
                                        <input type="text" name="sender" id="sender" style="width:180px" placeholder="ชื่อ-สกุล ตำแหน่ง">
                                        <input type="submit" id="button" value="บันทึกข้อมูล">
                                        <input type="reset" value="  ยกเลิก  "></td>
                                </tr>
                            </table>

                        </td>
                    </tr>
                    <tr>

                </table>

            </form>

        </div>
    </body>
</html>