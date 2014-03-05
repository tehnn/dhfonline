<?php
session_start();
$login_pcucode = $_SESSION['login_pcucode'];
if (empty($login_pcucode)) {
    exit("Not allow!!");
}
?>
<!DOCUMENT HTML>
<html>
    <head>
        <meta charset="UTF-8">
        <title>[<?=$login_pcucode?>]-MOO Registration</title>
        <style>
            .head_title{
                color: #fff5f8;
                font-size: 30px;
                font-weight: bold;
                background-color: #2a85a0;
                border-bottom: wheat 1px solid;
                padding: 15px

            }
            .contrainer{
                padding: 15px;
                border: #005599 1px solid;
            }
            table{
                width:100%;
            }
        </style>

        <script src="lib/jquery-1.9.1.min.js" ></script>
        <script>
            $(function() {
                $("select#amp").change(function() {
                    $.getJSON("ajx_list_tmb.php", {amp: $(this).val(), ajax: 'true'}, function(j) {
                        var options;
                        $("select#moo").html(options);//ล้างหมู่
                        for (var i = 0; i < j.length; i++) {
                            options += '<option value="' + j[i].code + '">' + j[i].name + '</option>';
                        }
                        $("select#tmb").html(options);
                    });

                });

                $("select#tmb").change(function() {
                    $.getJSON("ajx_list_moo.php", {tmb: $(this).val(), ajax: 'true'}, function(j) {
                        var options;
                        for (var i = 0; i < j.length; i++) {
                            options += '<option value="' + j[i].code + '">' + j[i].name + '</option>';
                        }
                        $("select#moo").html(options);
                    });
                });


            });
        </script>
        <script>
            function qry_add_pcu_moo(moo) {
                if (moo) {
                    //alert(moo);
                    window.location = 'qry_add_pcu_moo.php?moo=' + moo + '&pcucode=' +<?=$_SESSION['login_pcucode']?>;
                }
            }

            function qry_del_pcu_moo(id) {

                if (id) {
                    //alert(id);
                    window.location = 'qry_del_pcu_moo.php?id=' + id + '&pcucode=' +<?= $login_pcucode ?>;
                }
            }

        </script>

    </head>
    <body>
        <?php
        require './condb.php';
        ?>
        <div class="head_title"><input type="button" onclick="window.location='main_screen.php'" value='กลับหน้าหลัก'>จัดการหมู่บ้านรับผิดชอบ</div>
        <div class="contrainer">
            <table border="1">
                <tr>
                    <th width="15%">1-เลือกอำเภอ</th>
                    <th width="25%">2-เลือกตำบล</th>
                    <th width="25%">3-เลือกหมู่บ้าน</th>
                    <th width="10%">4-เพิ่ม/ลบ</th>
                    <th width="25%">5-หมู่บ้านรับผิดชอบของท่าน</th>
                </tr>
                <tr>
                    <td>
                        <SELECT NAME="amp"  SIZE=15 style="width: 100%" id="amp">

                            <?php
                            $res_amp = mysql_query("select code,name from amp where code<>'6500'");
                            while ($row_amp = mysql_fetch_array($res_amp)) {
                                echo "<option value='$row_amp[code]'>$row_amp[name]</option>\r\n";
                            }
                            ?>
                        </SELECT>

                    </td>
                    <td>
                        <SELECT NAME="tmb" id="tmb"  SIZE=15 style="width: 100%">

                        </SELECT>
                    </td>
                    <td>
                        <SELECT NAME="moo"  id="moo" SIZE=15 style="width: 100%">

                        </SELECT>
                    </td>
                    <td align="center">
                        
                        <div><button type="button" class="btn btn-default" onclick="qry_add_pcu_moo($('#moo').val());">เพิ่ม</button></div>
                        <div>..</div>
                        <div><button type="button" class="btn btn-default" onclick="qry_del_pcu_moo($('#pcu_moo').val());">ลบ</button></div>
                    </td>
                    <td>
                        <SELECT NAME="pcu_moo" id="pcu_moo" SIZE=15 style="width: 100%">
                            <?php
                            $sql = "SELECT pcumoo.id,pcumoo.moo,moo.name FROM pcu_moo pcumoo
                                LEFT JOIN moo moo on pcumoo.moo = moo.code  
                                where pcumoo.pcucode='$login_pcucode' order by pcumoo.id asc";
                            $res = mysql_query($sql);
                            while ($row = mysql_fetch_array($res)) {
                                echo "<option value='$row[0]'>" . substr($row[1], 6, 2) . "-$row[2]</option>\r\n";
                            }
                            ?>


                        </SELECT>

                    </td>
                </tr>
            </table>
        </div>

    </body>

</html>