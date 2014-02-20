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
            <form action="qry_add_pt_hoome.php" 
                  id="frm_home" name="frm_home"
                  method="post"
                  enctype="multipart/form-data"
                  onsubmit="return validate()">

                <input type="hidden" name="office_own" value="">
                <input type="hidden" name="user_own" value="">

                <table width="75%" border="1" cellspacing="0" cellpadding="2">
                    <tr bgcolor="#33CCFF">
                        <td bgcolor="#66FFFF"> แบบบันทึกการสอบสวนโรคของผู้ป่วยชื่อ :<strong>นายก ไม่ทราบนามสกุล อายุ 33 ปี</strong></td>
                    </tr>
                    <tr>
                        <td bgcolor="#66FFFF">
                        
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td>บันทึกวันที่...
                            <?=date("Y-m-d H:i:s")?></td>
                          </tr>
                          <tr>
                            <td><strong>ผลการสอบสวนโรคและกิจกรรมควบคุมโรค</strong></td>
                          </tr>
                          <tr>
                            <td>: : ผู้ป่วยอาชีพ..
                              <input type="text" name="occupat" id="occupat">
                            โรงเรียน/สถานที่ทำงาน..
                            <input name="school_workplace" type="text" id="school_workplace" size="52"></td>
                          </tr>
                          <tr>
                            <td>: : ระยะห่างของวันเริ่มป่วยกับรายก่อนหน้านี้ในชุมชนเดียวกัน
                            <input name="date_ill_diff" type="text" id="date_ill_diff" size="5">
                            วัน</td>
                          </tr>
                          <tr>
                            <td>: : ภายใน 14 วันก่อนป่วยได้เดินทางไปที่
                              ..
                              <input name="travel_to" type="text" id="travel_to" size="45">
                            วันที่..
                            <input type="text" name="date_travel" id="date_travel"></td>
                          </tr>
                          <tr>
                            <td>: : การสำรวจค่าดัชนีลูกน้ำยุงลาย</td>
                          </tr>
                          <tr>
                            <td><table width="100%" border="0" cellspacing="0" cellpadding="1">
                              <tr>
                                <td width="16%" align="right" valign="top">บ้านผู้ป่วย</td>
                                <td width="84%">&nbsp;</td>
                              </tr>
                              <tr>
                                <td align="right" valign="top">ทีทำงาน/โรงเรียน</td>
                                <td>&nbsp;</td>
                              </tr>
                              <tr>
                                <td align="right" valign="top">วัด</td>
                                <td>&nbsp;</td>
                              </tr>
                              <tr>
                                <td align="right" valign="top">หมู่บ้าน/ชุมชน</td>
                                <td>&nbsp;</td>
                              </tr>
                              <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                              </tr>
                            </table></td>
                          </tr>
                          <tr>
                            <td>: : กิจกรรมควบคุมโรค</td>
                          </tr>
                          <tr>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="checkbox" name="checkbox" id="checkbox">
                            ผลสารเคมีกำจัดยุงตัวเต็มวัน
                            <input name="spray_chem" type="text" id="spray_chem" size="10">
                            หลังคาเรือน</td>
                          </tr>
                          <tr>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;
                              <input type="checkbox" name="checkbox2" id="checkbox2">
                              ทำลายแหล่งเพาะพันธุ์ กำจัดลูกน้ำยุงลาย
                              <input name="spray_chem2" type="text" id="spray_chem2" size="10">
หลังคาเรือน</td>
                          </tr>
                          <tr>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;
                              <input type="checkbox" name="checkbox3" id="checkbox3">
ประชุม/ประชาคมหมู่บ้าน&nbsp;&nbsp;&nbsp;&nbsp;
<input type="checkbox" name="checkbox5" id="checkbox5">
รณรงค์ประชาสัมพันธ์ ให้ความรู้ประชาชน</td>
                          </tr>
                          <tr>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;
                              <input type="checkbox" name="checkbox4" id="checkbox4">
                              อื่นๆ
                              <input name="spray_chem4" type="text" id="spray_chem4" size="100"></td>
                          </tr>
                          <tr>
                            <td>: : สภาพแวดล้อม</td>
                          </tr>
                          <tr>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <textarea style="width:500px"></textarea>
                            </td>
                          </tr>
                          <tr>
                            <td>: : ข้อเสนอแนะ/สรุปผล</td>
                          </tr>
                          <tr>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <textarea name="textarea" style="width:500px"></textarea></td>
                          </tr>
                          <tr>
                            <td>: : รูปภาพกิจกรรม
                            <input type="file" name="img_act" id="img_act"></td>
                          </tr>
                        </table>
                        
                        </td>
                    </tr>
                      <tr>
                        <td bgcolor="#66FFFF">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ชื่อผู้บันทึกข้อมูล..
                        <input name="reporter" type="text" id="reporter" size="35">
                        <input type="submit" value="บันทึกข้อมูล">
                        <input type="reset" id="button" value="ยกเลิก"></td>
                    </tr>
                    
                
                    

                </table>

            </form>

        </div>
    </body>
</html>