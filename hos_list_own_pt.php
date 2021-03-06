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

if ($login_level <> 'hos') {
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
        $sql = "select  if(rcp.receiver is NULL,'n','y') as isreceive,rcp.receiver,pt.pid,
CONCAT(pt.prename,pt.`name`,' ',pt.lname) as fullname,pt.agey,pt.agem,
concat(if(pt.addr is null,'-',pt.addr),'  ถ.',if(pt.road is NULL,'-',pt.road) ,'  ม.',SUBSTR(pt.moo,7,2),' บ.',moo.`name`,' ต.',tmb.`name`,' อ.',amp.`name`) as address,
pt.date_found,toamp.`name` as sendto,pt.datetime_send
from patient_hos pt
LEFT JOIN (select rc.pid as ppid,rc.datetime_receive,rc.pcu_receive,u.off_name as receiver from receive rc 
LEFT JOIN user u on u.pcucode=rc.pcu_receive) rcp on rcp.ppid = pt.pid
LEFT JOIN moo moo on moo.`code` = pt.moo
LEFT JOIN tmb tmb on tmb.`code` = pt.tmb
LEFT JOIN amp amp on amp.`code` = pt.amp
LEFT JOIN amp toamp on toamp.`code` = pt.send_to_amp
where pt.office_own='$login_pcucode' order by pt.datetime_send DESC";
        $result = mysql_query($sql);
        $num_all_case = mysql_num_rows($result);
        ?>
        <div data-role="page">
            <div data-role="header" data-position="fixed" data-theme="f">
                <a href="main_screen.php" rel="external" data-icon="back">Back</a>
                <?php require 'txt_head.php'; ?>
                <a href="login.php" rel='external' data-icon="arrow-r">Sign out</a>

            </div><!-- /header -->
            <div data-role="content" data-theme="f">
                <?php require 'office_title.php'; ?>
                <div class="ui-body ui-body-f" align="center">
                    <div class="title-text">
                        ส่ง case แล้ว  จำนวน  <?= $num_all_case ?> ราย
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

                    <table class="table demo metro-purple" 
                           data-filter="#filter" 
                           data-filter-text-only="true" 
                           data-page-size="6">
                        <thead>
                            <tr>
                                <th >
                                    สถานะ
                                </th>
                                <th >
                                    ผู้รับ
                                </th>
                                <th data-toggle="true">
                                    ชื่อ-นามสกุล
                                </th>
                                <th data-hide="phone,tablet">
                                    อายุ
                                </th>
                                <th data-hide="phone,tablet">
                                    ที่อยู่ขณะป่วย
                                </th>
                                <th data-hide="phone,tablet">
                                    วันรับรักษา
                                </th>
                                <th data-hide="phone,tablet">
                                    พื้นที่
                                </th>
                                <th data-hide="phone,tablet">
                                    เวลาส่ง
                                </th>
                            </tr>
                        </thead>
                        <tbody>  
                            <!-- select from patient_hos -->
                            <?php
                            while ($row = mysql_fetch_array($result)) {
                                ?>
                                <tr>
                                    <td>
                                        <?php
                                        if ($row[isreceive]=='y') {
                                            echo '<span class="status-metro status-active" >รับแล้ว</span>';
                                        } else {
                                            echo '<span class="status-metro status-suspended">ยังไม่รับ</span>';
                                        }
                                        ?>
                                    </td>
                                    <td><?= $row[receiver] ?></td>
                                    <td> 
                                        <a href="pt_info.php?pid=<?= $row[pid] ?>&hos_own=y" rel="external"><?= $row[fullname] ?></a>
                                    </td>
                                    <td><?= $row[agey]."ปี".$row[agem]."ด." ?></td>
                                    <td><?= $row[address] ?></td>
                                    <td><?= $row[date_found] ?></td>
                                    <td><?= $row[sendto] ?></td>
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

                <div data-role="controlgroup" data-type="horizontal" align='center'>
                    <a href="frm_add_pt_hos.php" rel="external" data-icon="edit">ส่ง case</a>                  

                </div>
                <?php require 'txt_foot.php'; ?>
            </div>
        </div>  <!-- end page -->


    </body>
</html>


