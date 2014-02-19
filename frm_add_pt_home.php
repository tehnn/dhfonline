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


        <style>  
            .map-div{
                height: 300px;
                width: 100%;

            }
            #latlng{
                position:absolute;
                top:300px;  /* adjust value accordingly */
                left:5px;  /* adjust value accordingly */
                z-index: 9999;
                background-color:#008c8c;
                color: white;

            }
        </style>

        <script type="text/javascript" src="http://dev.jtsage.com/cdn/datebox/latest/jqm-datebox.core.min.js"></script>
        <script type="text/javascript" src="http://dev.jtsage.com/cdn/datebox/latest/jqm-datebox.mode.calbox.min.js"></script>
        <script type="text/javascript" src="http://dev.jtsage.com/cdn/datebox/i18n/jquery.mobile.datebox.i18n.en_US.utf8.js"></script>
        <script type="text/javascript" src="http://dev.jtsage.com/cdn/datebox/1.1.0/jqm-datebox-1.1.0.mode.flipbox.js"></script>
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

        <script src="http://maps.google.com/maps/api/js?sensor=false&libraries=geometry&v=3.7&language=TH"></script>

        <script>

            $(document).ready(function() {
                getGeo();
            });

            function getGeo() {
                if (navigator.geolocation) { // ตรวจสอบว่า support geolocation หรือไม่
                    navigator.geolocation.getCurrentPosition(function(position) {
                        lat = position.coords.latitude;
                        lng = position.coords.longitude;
                        $('#lat').val(lat);
                        $('#lng').val(lng);
                    });
                } else {
                    alert("อุปกรณ์นี้ไม่สนับสนุน Geo-Location");

                }
            }// end getGeo


            $(document).on('pageshow', '#page-map', function(e, data) {
                var map, lat, lng;



                if (navigator.geolocation) { // ตรวจสอบว่า support geolocation หรือไม่
                    navigator.geolocation.getCurrentPosition(function(position) {
                        lat = position.coords.latitude;
                        lng = position.coords.longitude;
                        $("#latlng").html(lat + "," + lng);


                        initMap(lat, lng, 15);
                    });
                } else {
                    $("#latlng").html("อุปกรณ์นี้ไม่สนับสนุน Geo-Location");
                    initMap(16.8175556, 100.2609311, 8);// พิษณุโลก                    

                }
                // map
                function initMap(lat, lng, zoom) {
                    var mapOptions = {
                        zoom: zoom,
                        center: new google.maps.LatLng(lat, lng),
                        mapTypeId: google.maps.MapTypeId.SATELLITE
                    };
                    map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

                    var marker = new google.maps.Marker({
                        map: map,
                        position: map.getCenter(),
                        clickable: true,
                        draggable: true,
                        title: 'ลากหมุดเพื่อเปลี่ยนค่าพิกัด'
                    });

                    google.maps.event.addListener(marker, 'drag', function() {

                        $('#latlng').html(marker.getPosition().lat() + "," + marker.getPosition().lng());


                    });//drag

                    google.maps.event.addListener(marker, 'dragend', function() {

                        $('#latlng').html(marker.getPosition().lat() + "," + marker.getPosition().lng());
                        $('#lat').val(marker.getPosition().lat());
                        $('#lng').val(marker.getPosition().lng());


                        map.panTo(marker.getPosition());

                    });// drag-end

                }

            });// end page-map show

        </script>



    </head> 
    <body>         
        <?php
        $datetime_do = date("Y-m-d H:i:s");

        $sql = "select u.off_name,pt.*,TIMESTAMPDIFF(YEAR,pt.bdate,pt.date_found) AS agey,rp.pcu_receive,rp.datetime_receive,rp.off_name as off_name_receive from patient_hos pt
LEFT JOIN (select rc.*,uu.pcucode,uu.off_name from receive rc LEFT JOIN user uu on rc.pcu_receive=uu.pcucode ) as rp on pt.pid=rp.pid
LEFT JOIN user u on pt.office_own = u.pcucode
where pt.pid='$pid'";
        $result = mysql_query($sql);
        $row = mysql_fetch_array($result);
        ?>
        <div data-role="page" id="page-1">
            <div data-role="header" data-position="fixed" data-theme="f">
                <a href="#" data-rel="back" data-icon="back">Back</a>
                <?php require 'txt_head.php'; ?>
                <a href="#" data-icon="info">About</a>
            </div>
            <div data-role="content" data-theme="f">
                <?php require 'office_title.php'; ?>
                <form action="qry_add_pt_home.php" 
                      id="frm_home" name="frm_home"
                      data-ajax="false" method="post"
                      enctype="multipart/form-data"
                      onsubmit="return true">
                    <!-- hidden field -->
                    <input type="hidden"  name="office_own" value="<?= $row[office_own] ?>"/>
                    <input type="hidden"  name="office_do" value="<?= $_SESSION[pcucode] ?>"/>
                    <input type="hidden"  name="user_do" value="<?= $_SESSION[user] ?>"/>  
                    <input type="hidden"  name="datetime_do" value="<?= $datetime_do ?>"/>  
                    <input type="hidden"  name="pid" value="<?= $row[pid] ?>"/>  


                    <ul data-role="listview" data-inset="true">
                        <li data-role="fieldcontain">
                            <img src="img_pt/nopic.png">
                            <p>pid:<?= $row[pid] ?></p>
                            <h2><?= $row[prename] . $row[name] . " " . $row[lname] ?> 
                                ,เริ่มป่วย:<?= $row[date_ill] ?>,รับรักษา:<?= $row[date_found] ?></h2>
                            <p><?= $row[sex] == 1 ? 'ชาย' : 'หญิง' ?>,อายุ <?= $row[agey] ?>ปี</p>


                            <h3>ข้อมูลผู้ป่วย (<?= $row[off_name] ?>)</h3>
                            <p>
                                <?= nl2br($row[note_text]) ?>
                            </p>  
                        </li>
                        <li data-role="fieldcontain">
                            <table width ="100%">
                                <tr>
                                    <td >
                                        <select name="amp" id="amp">
                                            <?php
                                            $amp_sql = "select code,name from amp";
                                            $amp_res = mysql_query($amp_sql);
                                            while ($rw_amp = mysql_fetch_array($amp_res)) {
                                                ?>
                                                <option value="<?= $rw_amp[code] ?>" <?php
                                                if ($rw_amp[code] == $row[send_to_amp]) {
                                                    echo 'selected';
                                                }
                                                ?>>
                                                <?= $rw_amp[name] ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>

                                    </td>

                                    <td >
                                        <select name="tmb" id="tmb">
                                            <option value="">เลือกตำบล...</option>
                                            <?php
                                            $tmb_sql = "select code,name from tmb where amp=$row[send_to_amp]";
                                            $tmb_res = mysql_query($tmb_sql);
                                            while ($rw_tmb = mysql_fetch_array($tmb_res)) {
                                                ?>
                                                <option value="<?= $rw_tmb[code] ?>">
                                                <?= $rw_tmb[name] ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </td>
                                    <td >
                                        <input  name="moo" id="moo" data-mini="true" type="text" placeholder="หมู่ที่">
                                    </td>

                                </tr>
                                <tr>

                                    <td >
                                        <input  name="road" id="road" data-mini="true" type="text" placeholder="ถนน/ซอย">
                                    </td>
                                    <td >
                                        <input  name="addr" id="addr" data-mini="true" type="text" placeholder="บ้านเลขที่">
                                    </td>
                                    <td> 
                                        <input  maxlength="11" name="house_id" id="house_id" data-mini="true" type="text" placeholder="รหัสบ้าน 11 หลัก">
                                    </td>
                                </tr>
                            </table>
                        </li>

                        <li data-role="fieldcontain">

                            <table width ="100%">
                                <tr>
                                    <td width="40%"><input  name="lat" id="lat" data-mini="true" type="text" placeholder="ละติจูด"></td>
                                    <td width="40%"><input  name="lng" id="lng" data-mini="true" type="text" placeholder="ลองติจูด"></td>
                                    <td width="20%">
                                        <a href="#" onclick="getGeo()" data-role="button" data-inline="true" data-mini="true"> พิกัด </a>
                                        <a href="#page-map" data-rel="dialog" data-position-to="window" data-role="button" data-inline="true" data-mini="true"> แผนที่ </a>

                                    </td>
                                </tr>

                            </table>
                        </li>
                        <li data-role="fieldcontain">
                            <label for="is_larva">พบลูกน้ำยุงลายที่บ้านผู้ป่วย:</label>
                            <select name="is_larva" id="is_larva" data-role="slider">
                                <option value="n">ไม่พบ</option>
                                <option value="y">พบ</option>

                            </select>
                        </li>


                        <li data-role="fieldcontain">
                            <label for="note_patient">บันทึกกิจกรรม 1:</label>
                            <textarea cols="40" rows="8" name="note_patient" id="note_patient" placeholder="ข้อมูลผู้ป่วย/ประวัติการเจ็บป่วย"></textarea>

                        </li>
                        <li data-role="fieldcontain">
                            <label for="note_home">บันทึกกิจกรรม 2:</label>
                            <textarea cols="40" rows="8" name="note_home" id="note_home" placeholder="สภาพแวดล้อมบริเวณบ้าน"></textarea>

                        </li>
                        <li data-role="fieldcontain">
                            <label for="note_activity">บันทึกกิจกรรม 3:</label>
                            <textarea cols="40" rows="8" name="note_activity" id="note_activity" placeholder="กิจกรรมควบคุมโรค"></textarea>

                        </li>

                        <li data-role="fieldcontain">
                            <label for="img_home">รูปบ้านผู้ป่วย:</label>
                            <input type="file" name="img_home" id="img_home">
                        </li>
                        <li data-role="fieldcontain">
                            <label for="img_activity">รูปกิจกรรม:</label>
                            <input type="file" name="img_activity" id="img_activity">
                        </li>

                        <li data-role="fieldcontain">
                            <label for="reporter">ผู้รายงาน:</label>
                            <input type="text" name="reporter" id="reporter" placeholder="ชื่อ-นามสกุลผู้รายงาน /เบอร์โทร">
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


        <div data-role="page" id="page-map">
            <div data-role="header" data-position="fixed" data-theme="f">
                <h1>Map</h1>
            </div>
            <div data-role="content" id="map-content">
                <div id="latlng"></div>
                <div id="map-canvas" class="map-div"></div>
            </div> <!-- end content -->

        </div>  <!-- end page -->


    </body>
</html>
