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

if ($login_level <> 'pro') {
    exit("You don't have permission.Level cause.");
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
        require 'condb.php';
        $sql = "select * from patient_hos where date(datetime_send)=CURDATE() and send_to_amp=6500";
        $result_today = mysql_query($sql);
        $num_today_case = mysql_num_rows($result_today);

        $sql = "select amp_ill.`name` as ill_at,if(rp.off_name is null or rp.off_name='','n','y') as isreceive,
rp.off_name as receiver,CONCAT(pt.prename,pt.`name`,' ',pt.lname) as fullname,
TIMESTAMPDIFF(YEAR,pt.bdate,pt.date_found) AS agey,
concat(pt.addr,' ม.',SUBSTR(pt.moo,7,2),' บ.',moo.`name`,' ต.',tmb.`name`,' อ.',amp.`name`) as address,
pt.date_found,u_off.off_name as send_from,pt.datetime_send,uu.off_name as sendback_by
from patient_hos pt 
LEFT JOIN user u_off on pt.office_own = u_off.pcucode
LEFT JOIN user uu on uu.pcucode = pt.send_back_by
LEFT JOIN amp amp_ill on pt.send_to_amp = amp_ill.`code`
LEFT JOIN (select r.pid,r.pcu_receive,u.pcucode,u.off_name from receive r LEFT JOIN user u on u.pcucode=r.pcu_receive ) rp on rp.pid = pt.pid
LEFT JOIN moo moo on moo.`code` = pt.moo
LEFT JOIN tmb tmb on tmb.`code` = pt.tmb
LEFT JOIN amp amp on amp.`code` = pt.amp
where pt.send_to_amp=6500
order by pt.datetime_send DESC";
        $result_all = mysql_query($sql);
        $num_all_case = mysql_num_rows($result_all);
        ?>

        <div data-role="page">
            <div data-role="header" data-position="fixed" data-theme="f">
                <a href="main_screen.php" rel="external" data-icon="home">Back</a>
                <?php require 'txt_head.php'; ?>
                <a href="login.php" rel='external' data-icon="arrow-r">Sign out</a>

            </div><!-- /header -->
            <div data-role="content" data-theme="f">



                <div class="ui-body ui-body-f" align="center">
                    <div class="title-text">
                        รายชื่อผู้ป่วยส่งกลับ
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

                    <table class="table demo metro-green" 
                           data-filter="#filter" 
                           data-filter-text-only="true" 
                           data-page-size="6">
                        <thead>
                            <tr>
                                <th>รพ.ส่งให้</th>
                                <th >
                                    ส่งกลับโดย
                                </th>

                                <th data-toggle="true">
                                    ชื่อ-นามสกุล
                                </th>
                                <th data-hide="phone,tablet">
                                    อายุ(ปี)
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
                                    <td><?= $row[ill_at] ?></td>
                                    <td><?=$row[sendback_by]?></td>                               
                                    <td><a href="#"><?= $row[fullname] ?><a></td>
                                    <td><?= $row[agey] ?></td>
                                    <td><?= $row[address] ?></td>
                                    <td><?= $row[date_found] ?></td>
                                    <td><?= $row[send_from] ?></td>
                                    <td><?= $row[datetime_send] ?></td>
                                </tr>

                                <?php
                            }
                            ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="8">
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

                        $('.filter-api').click(function(e) {
                            e.preventDefault();

                            //get the footable filter object
                            var footableFilter = $('table').data('footable-filter');

                            alert('about to filter table by "tech"');
                            //filter by 'tech'
                            footableFilter.filter('tech');

                            //clear the filter
                            if (confirm('clear filter now?')) {
                                footableFilter.clearFilter();
                            }
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