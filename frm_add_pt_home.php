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

if ($login_level <> 'hos' and $login_level <> 'pcu') {
    //exit("You don't have permission.Level cause.");
}
require 'condb.php';
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
                $("#date_travel").datepicker({
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
                $('#frm_home').find('input,select').keydown(function(event) {
                    if (event.keyCode == 13) {
                        event.preventDefault();
                    }
                });
            });

            function validate() {
                var validate_pass = true;
                var validate_msg = "";

                var pid = $("#pid").val();
                if (pid == '' || pid == null) {
                    validate_pass = false;
                    validate_msg += "pid ว่าง\r\n";
                }
                
                 var r = $("#reporter").val();
                if (r == '' || r == null) {
                    validate_pass = false;
                    validate_msg += "ผู้รายงานว่าง ว่าง\r\n";
                }



                if (validate_msg != "") {
                    alert(validate_msg);
                }
                return validate_pass;

            }
        </script>
        <script>
            var map_pop;
            function map_popup(url, name, windowWidth, windowHeight) {
                myleft = (screen.width) ? (screen.width - windowWidth) / 2 : 100;
                mytop = (screen.height) ? (screen.height - windowHeight) / 2 : 100;
                properties = "width=" + windowWidth + ",height=" + windowHeight;
                properties += ",scrollbars=yes, top=" + mytop + ",left=" + myleft;
                map_pop = window.open(url, name, properties);
            }
        </script>
        <script>
            $(function() {
                $("#f1").keyup(function() {
                    var ci = $("#f1").val() * 100 / $("#s1").val();
                    ci = ci.toFixed(2);
                    if (ci <= 10) {
                        $("#ci1").css("background-color", "#1BDA3A");
                    }
                    if (ci > 10 && ci <= 100) {
                        $("#ci1").css("background-color", "#E04812");
                    }
                    if (ci > 100) {
                        $("#ci1").css("background-color", "#726A68");
                    }
                    if (isNaN(ci)) {
                        $("#ci1").css("background-color", "#050505");
                    }


                    $("#ci1").val(ci);

                });
                //
                $("#f2").keyup(function() {
                    var ci = $("#f2").val() * 100 / $("#s2").val();
                    ci = ci.toFixed(2);
                    if (ci <= 10) {
                        $("#ci2").css("background-color", "#1BDA3A");
                    }
                    if (ci > 10 && ci <= 100) {
                        $("#ci2").css("background-color", "#E04812");
                    }
                    if (ci > 100) {
                        $("#ci2").css("background-color", "#726A68");
                    }
                    if (isNaN(ci)) {
                        $("#ci2").css("background-color", "#050505");
                    }


                    $("#ci2").val(ci);

                });
                //
                $("#f3").keyup(function() {
                    var ci = $("#f3").val() * 100 / $("#s3").val();
                    ci = ci.toFixed(2);
                    if (ci <= 10) {
                        $("#ci3").css("background-color", "#1BDA3A");
                    }
                    if (ci > 10 && ci <= 100) {
                        $("#ci3").css("background-color", "#E04812");
                    }
                    if (ci > 100) {
                        $("#ci3").css("background-color", "#726A68");
                    }
                    if (isNaN(ci)) {
                        $("#ci3").css("background-color", "#050505");
                    }

                    $("#ci3").val(ci);

                });
                //
                $("#f4").keyup(function() {

                    var hi = $("#f4").val() * 100 / $("#s4").val();
                    hi = hi.toFixed(2);
                    if (hi <= 10) {
                        $("#hi").css("background-color", "#1BDA3A");
                    }
                    if (hi > 10 && hi <= 100) {
                        $("#hi").css("background-color", "#E04812");
                    }
                    if (hi > 100) {
                        $("#hi").css("background-color", "#726A68");
                    }
                    if (isNaN(hi)) {
                        $("#hi").css("background-color", "#050505");
                    }

                    $("#hi").val(hi);

                });
                //
                $("#f5").keyup(function() {

                    var bi = $("#f5").val() * 100 / $("#s4").val();
                    bi = bi.toFixed(2);
                    var hi = $("#f5").val() * 100 / $("#s5").val();
                    hi = hi.toFixed(2);

                    if (hi <= 10) {
                        $("#ci").css("background-color", "#1BDA3A");
                    }
                    if (hi > 10 && hi <= 100) {
                        $("#ci").css("background-color", "#E04812");
                    }
                    if (hi > 100) {
                        $("#ci").css("background-color", "#726A68");
                    }
                    if (isNaN(hi)) {
                        $("#ci").css("background-color", "#050505");
                    }

                    $("#ci").val(hi);
                    $("#bi").val(bi);

                });

            });
        </script>
        <script>
            $(function() {

                $('#date_travel').bind('keypress', function(e) {
                    return  false;
                });

                $('#chk_spray').change(function() {
                    $('#num_spray_home').attr('disabled', !this.checked);
                    if ($(this).prop('checked') != true) {
                        $('#num_spray_home').val('');
                    }
                });

                $('#chk_destroy').change(function() {
                    $('#num_destroy_home').attr('disabled', !this.checked);
                    if ($(this).prop('checked') != true) {
                        $('#num_destroy_home').val('');
                    }
                });

                $('#chk_other').change(function() {
                    $('#note_other').attr('disabled', !this.checked);
                    if ($(this).prop('checked') != true) {
                        $('#note_other').val('');
                    }
                });

                $('#num_spray_home').bind('keypress', function(e) {
                    return (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) ? false : true;
                });
                $('#num_destroy_home').bind('keypress', function(e) {
                    return (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) ? false : true;
                });


            });
        </script>
        <title>#PLK DHF Online</title>
    </head>
    
    <body>
        <?php
        $sql = "select pt.pid,CONCAT(pt.prename,pt.name,' ',pt.lname) as fullname
,pt.hn,pt.cid
,pt.sex,pt.bdate,TIMESTAMPDIFF(YEAR,pt.bdate,pt.date_found) as agey
,pt.occupat,pt.school_workplace ,
CONCAT(pt.addr,' ม.',SUBSTR(pt.moo,7,2),' ',moo.`name`,'  ต.',tmb.`name`,'  อ.',amp.`name`) as address
,pt.date_ill,pt.date_found,pt.datetime_send
,pt.icd10,pt.code506,pt.lab_wbc,pt.lab_plt,pt.lab_hct,pt.lab_tt,pt.symtom
,pt.refer_from,pt.note_text
from patient_hos pt
LEFT JOIN moo moo on moo.`code` = pt.moo
LEFT JOIN tmb tmb on tmb.`code`=pt.tmb
LEFT JOIN amp amp on amp.`code` = pt.amp
where pt.pid ='$_GET[pid]'";

        $result = mysql_query($sql);
        $row = mysql_fetch_array($result);
        ?>
        <div align="center">
            <form action="qry_add_pt_home.php" 
                  id="frm_home" name="frm_home"
                  method="post"
                  enctype="multipart/form-data"
                  onsubmit="return validate()">

                <input type="hidden" name="pid" id="pid" value="<?= $_GET[pid] ?>">
                <input type="hidden" name="datetime_do" value="<?= date('Y-m-d H:i:s') ?>">

                <table width="75%" border="1" cellspacing="0" cellpadding="2">
                    <tr bgcolor="#33CCFF">
                        <td bgcolor="#66FFFF"> 
                            แบบบันทึกการสอบสวนโรคของผู้ป่วย รหัส<?= $_GET[pid] ?> วันที่:
                            <?= date("Y-m-d H:i:s")?>
                        </td>
                    </tr>
                    <tr>
                        <td bgcolor="#66FFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td>
                                        <strong><?= $row[fullname] ?></strong> อายุ <?= $row[agey] ?> ปี 
                                        <?= $row[address] ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>: : พิกัดที่ตั้งบ้านผู้ป่วย แลตติจูด..
                                        <input type="text" name="lat" id="lat">
                                        ลองจิจูด..
                                        <input type="text" name="lng" id="lng">
                                        <input type="button" value="พิกัด" onClick=" getGeo();">
                                        <input type="button" value="แผนที่" onClick="javascript:map_popup('map_pop.php', 'map', 500, 450)" "></td>
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
                                                <td width="12%" align="right" valign="top">บ้านผู้ป่วย</td>
                                                <td width="3%">&nbsp;</td>
                                                <td width="85%" align="left" valign="top">สำรวจ..
                                                    <input name="s1" type="text" id="s1" size="5">
                                                    ภาชนะ พบลูกน้ำ..
                                                    <input name="f1" type="text" id="f1" size="5">
                                                    ภาชนะ CI=
                                                    <input name="ci1" type="text" id="ci1" size="10"></td>
                                            </tr>
                                            <tr>
                                                <td align="right" valign="top">ทีทำงาน/โรงเรียน</td>
                                                <td>&nbsp;</td>
                                                <td align="left" valign="top">สำรวจ..
                                                    <input name="s2" type="text" id="s2" size="5">
                                                    ภาชนะ พบลูกน้ำ..
                                                    <input name="f2" type="text" id="f2" size="5">
                                                    ภาชนะ CI=
                                                    <input name="ci2" type="text" id="ci2" size="10"></td>
                                            </tr>
                                            <tr>
                                                <td align="right" valign="top">วัด</td>
                                                <td>&nbsp;</td>
                                                <td align="left" valign="top">สำรวจ..
                                                    <input name="s3" type="text" id="s3" size="5">
                                                    ภาชนะ พบลูกน้ำ..
                                                    <input name="f3" type="text" id="f3" size="5">
                                                    ภาชนะ CI=
                                                    <input name="ci3" type="text" id="ci3" size="10"></td>
                                            </tr>
                                            <tr>
                                                <td align="right" valign="top">หมู่บ้าน/ชุมชน</td>
                                                <td>&nbsp;</td>
                                                <td align="left" valign="top">บ้านที่สำรวจ..
                                                    <input name="s4" type="text" id="s4" size="5">
                                                    หลัง พบลูกน้ำ..
                                                    <input name="f4" type="text" id="f4" size="5">
                                                    หลัง HI=
                                                    <input name="hi" type="text" id="hi" size="10"></td>
                                            </tr>
                                            <tr>
                                                <td align="right" valign="top">&nbsp;</td>
                                                <td>&nbsp;</td>
                                                <td align="left" valign="top">ภาชนะสำรวจ..
                                                    <input name="s5" type="text" id="s5" size="5">
                                                    พบลูกน้ำ..
                                                    <input name="f5" type="text" id="f5" size="5">
                                                    ภาชนะ CI=
                                                    <input name="ci" type="text" id="ci" size="10">
                                                    BI=
                                                    <input name="bi" type="text" id="bi" size="10"></td>
                                            </tr>
                                        </table></td>
                                </tr>
                                <tr>
                                    <td>: : กิจกรรมควบคุมโรค</td>
                                </tr>
                                <tr>
                                    <td>&nbsp;&nbsp;&nbsp;&nbsp;
                                        <input name="chk_spray" type="checkbox" id="chk_spray" value="1">
                                        พ่นสารเคมีกำจัดยุงตัวเต็มวัย
                                        <input name="num_spray_home" type="text" disabled id="num_spray_home" size="10">
                                        หลังคาเรือน</td>
                                </tr>
                                <tr>
                                    <td>&nbsp;&nbsp;&nbsp;&nbsp;
                                        <input name="chk_destroy" type="checkbox" id="chk_destroy" value="1">
                                        ทำลายแหล่งเพาะพันธุ์ กำจัดลูกน้ำยุงลาย
                                        <input name="num_destroy_home" type="text" disabled id="num_destroy_home" size="10">
                                        หลังคาเรือน</td>
                                </tr>
                                <tr>
                                    <td>&nbsp;&nbsp;&nbsp;&nbsp;
                                        <input name="chk_meeting" type="checkbox" id="chk_meeting" value="1">
                                        ประชุม/ประชาคมหมู่บ้าน&nbsp;&nbsp;&nbsp;&nbsp;
                                        <input name="chk_campaign" type="checkbox" id="chk_campaign" value="1">
                                        รณรงค์ประชาสัมพันธ์ ให้ความรู้ประชาชน</td>
                                </tr>
                                <tr>
                                    <td>&nbsp;&nbsp;&nbsp;&nbsp;
                                        <input name="chk_other" type="checkbox" id="chk_other" value="1">
                                        อื่นๆ
                                        <input name="note_other" type="text" disabled id="note_other" size="82"></td>
                                </tr>
                                <tr>
                                    <td>: : สภาพแวดล้อม</td>
                                </tr>
                                <tr>
                                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <textarea name="note_env" id="note_env" style="width:550px; "></textarea></td>
                                </tr>
                                <tr>
                                    <td>: : ข้อเสนอแนะ/สรุปผล</td>
                                </tr>
                                <tr>
                                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <textarea name="note_sum" style="width:550px" id="note_sum"></textarea></td>
                                </tr>
                                <tr>
                                    <td>: : รูปภาพกิจกรรม
                                        <input type="file" name="img_act" id="img_act"></td>
                                </tr>
                            </table></td>
                    </tr>
                    <tr>
                        <td align="right" bgcolor="#66FFFF">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ชื่อผู้บันทึกข้อมูล..
                            <input name="reporter" type="text" id="reporter" size="35">
                            <input type="submit" value="บันทึกข้อมูล">
                            <input type="reset" id="button" value="ยกเลิก"></td>
                    </tr>
                </table>
            </form>
        </div>
    </body>
</html>