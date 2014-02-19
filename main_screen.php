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
require 'condb.php';
?>
<!DOCTYPE html> 
<html>
    <head>       

        <?php require 'lib.php'; ?>
        <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
        <link href="bootcss/bootstrap.css" rel="stylesheet" type="text/css"/>
        <link href="foocss/footable.core.css?v=2-0-1" rel="stylesheet" type="text/css"/>
        <link href="foocss/footable.metro.css" rel="stylesheet" type="text/css"/>
        <link href="bootcss/footable-demos.css" rel="stylesheet" type="text/css"/>

        <script src="foojs/footable.js?v=2-0-1" type="text/javascript"></script>
        <script src="foojs/footable.sort.js?v=2-0-1" type="text/javascript"></script>
        <script src="foojs/footable.filter.js?v=2-0-1" type="text/javascript"></script>
        <script src="foojs/footable.paginate.js?v=2-0-1" type="text/javascript"></script>
        <script src="bootjs/bootstrap-tab.js" type="text/javascript"></script>
        <script src="bootjs/demos.js" type="text/javascript"></script>

    </head> 
    <body> 
        <?php
        $sql = "select rp.pcu_receive,rp.off_name as off_name_receive,count(ph.pid) as sob,uu.off_name as hos_sender,pt.*,TIMESTAMPDIFF(YEAR,pt.bdate,pt.date_found) AS agey,
u.pcucode,u.off_name,u.amp from patient_hos pt
LEFT JOIN user u on pt.send_to_amp = u.amp
LEFT JOIN user uu on pt.office_own = uu.pcucode
LEFT JOIN (select r.pcu_receive,uuu.off_name,r.pid from receive r LEFT JOIN user uuu on r.pcu_receive=uuu.pcucode)
as rp on pt.pid = rp.pid
LEFT JOIN patient_home ph on pt.pid = ph.pid
where pt.send_to_amp=u.amp and u.pcucode='$pcucode'
GROUP BY pt.pid
order by pt.datetime_send DESC";
        $result_all = mysql_query($sql);
        $num_all_case = mysql_num_rows($result_all);

        $sql = "select pid from patient_hos pt
LEFT JOIN user u on pt.send_to_amp = u.amp
where pt.send_to_amp = u.amp
and u.pcucode = '$pcucode'
and date(pt.datetime_send) = CURDATE()";
        $result_today = mysql_query($sql);
        $num_today_case = mysql_num_rows($result_today);
        ?>

        <div data-role="page">
            <div data-role="header" data-position="fixed" data-theme="f">
                <a href="#" data-icon="gear">Setting</a>
                <?php require 'txt_head.php'; ?>
                <a href="login.php" rel='external' data-icon="arrow-r">Sign out</a>

            </div><!-- /header -->
            <div data-role="content" data-theme="f">
                <?php require 'office_title.php'; ?>

                <div class="ui-body ui-body-f" align="center">
                    <div class="title-text">
                        ผู้ป่วยรายใหม่ในพื้นที่วันนี้  <?= $num_today_case ?> ราย สะสมทั้งหมด <?= $num_all_case ?> ราย 
                    </div>  
                </div>


                <div class="foo-container">
                    <fieldset class="ui-grid-a">
                        <div class="ui-block-a">
                            <input id="filter" type="text" placeholder="ค้นหาผู้ป่วย..."/>
                        </div>
                        <div class="ui-block-b">
                            <select class="filter-status">
                                <option></option>      
                                <option value="0">รับแล้ว</option>
                                <option value="1">ยังไม่รับ</option>
                            </select>
                        </div>
                    </fieldset>

                    <table class="table demo" 
                           data-filter="#filter" 
                           data-filter-text-only="true" 
                           data-page-size="6">
                        <thead>
                            <tr>
                                <th >
                                    สถานะ
                                </th>
                                <th data-hide="phone,tablet">
                                    ผู้รับ
                                </th>
                                <th data-hide="phone,tablet">
                                    สอบสวน
                                </th>
                                <th data-toggle="true">
                                    ชื่อ-นามสกุล,อายุ
                                </th>
                                <th data-hide="phone,tablet">
                                    อายุ
                                </th>
                                <th data-hide="phone,tablet">
                                    ที่อยู่
                                </th>
                                <th data-hide="phone,tablet">
                                    วันรับรักษา
                                </th>
                                <th data-hide="phone,tablet">
                                    ส่งจาก
                                </th>
                                <th data-hide="phone,tablet">
                                    เวลาส่ง
                                </th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            while ($row = mysql_fetch_array($result_all)) {
                                ?>
                                <tr>
                                    <td>
                                        <?php
                                        if (!empty($row[pcu_receive])) {
                                            echo '<span class="status-metro status-active">รับแล้ว</span>';
                                        } else {
                                            echo '<span class="status-metro status-suspended">ยังไม่รับ</span>';
                                        }
                                        ?>
                                    </td>
                                    <td><?= $row[off_name_receive] ?></td>
                                    <td><?= $row[sob] ?></td>
                                    <td>
                                        <a href="pt_info.php?pid=<?= $row[pid] ?>" rel="external"><?= $row[prename] . $row[name] . " " . $row[lname] ?></a>
                                    </td>
                                    <td><?= $row[agey] ?></td>
                                    <td><?= $row[addr_ill] ?></td>
                                    <td><?= $row[date_found] ?></td>
                                    <td><?= $row[hos_sender] ?></td>
                                    <td><?= $row[datetime_send] ?></td>
                                </tr>

                                <?php
                            }
                            ?>


                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="9">
                                    <div class="pagination"></div>
                                </td>
                            </tr>
                        </tfoot>
                    </table>

                </div>

                <script type="text/javascript">
                    $(function() {
                        $('table').footable().bind('footable_filtering', function(e) {
                            var selected = $('.filter-status').find(':selected').text();
                            if (selected && selected.length > 0) {
                                e.filter += (e.filter && e.filter.length > 0) ? ' ' + selected : selected;
                                e.clear = !e.filter;
                            }
                        });

                        $('.clear-filter').click(function(e) {
                            e.preventDefault();
                            $('.filter-status').val('');
                            $('table.demo').trigger('footable_clear_filter');
                        });

                        $('.filter-status').change(function(e) {
                            e.preventDefault();
                            $('table.demo').trigger('footable_filter', {filter: $('#filter').val()});
                        });


                    });
                </script>

            </div> <!-- end content -->
            <div data-role="footer" data-position="fixed" data-theme="f"  class="ui-bar">
                <?php
                require 'menu_foot.php';
                require 'txt_foot.php';
                ?>
            </div>
        </div>  <!-- end page -->


    </body>
</html>

