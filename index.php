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
        $sql = "select * from patient_hos where is_cut is null and date(datetime_send)=CURDATE()";
        $result_today = mysql_query($sql);
        $num_today_case = mysql_num_rows($result_today);

        $sql = "select amp.`name` as amp_name,u.off_name as hos_sender,pt.* ,rc.pcu_receive,
TIMESTAMPDIFF(YEAR,pt.bdate,pt.date_found) AS agey from patient_hos pt
LEFT JOIN amp amp on pt.send_to_amp = amp.`code`
LEFT JOIN user u on pt.office_own = u.pcucode
LEFT JOIN receive rc on pt.pid=rc.pid
where  pt.is_cut is null ORDER BY pt.datetime_send DESC";
        $result_all = mysql_query($sql);
        $num_all_case = mysql_num_rows($result_all);
        ?>

        <div data-role="page">
            <div data-role="header" data-position="fixed" data-theme="f">
                <a href="#" data-icon="home">Home</a>
                <?php require 'txt_head.php'; ?>
                <a href="login.php" rel='external' data-icon="arrow-r">Sign in</a>

            </div><!-- /header -->
            <div data-role="content" data-theme="f">



                <div class="ui-body ui-body-f" align="center">
                    <div class="title-text">
                        ผู้ป่วยรวมทั้งหมด จำนวน  <?= $num_all_case ?> ราย วันนี้  <?= $num_today_case ?> ราย
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
                                <th>ส่งให้</th>
                                <th >
                                    สถานะ
                                </th>

                                <th data-toggle="true">
                                    ชื่อ-นามสกุล
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
                                    <td><?= $row[amp_name] ?></td>
                                    <td>
                                        <?php
                                        if (!empty($row[pcu_receive])) {
                                            echo '<span class="status-metro status-active" title="' . $row[pcu_receive] . '">รับแล้ว</span>';
                                        } else {
                                            echo '<span class="status-metro status-suspended">ยังไม่รับ</span>';
                                        }
                                        ?>
                                    </td>                               
                                    <td><?= $row[prename] . $row[name] . " xxx" ?></td>
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