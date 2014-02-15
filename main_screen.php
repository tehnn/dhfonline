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
                         ผู้ป่วยรวมทั้งหมด จำนวน  5 ราย วันนี้  2 ราย
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

                            <tr>
                                <td><span class="status-metro status-active">รับแล้ว</span></td>
                                <td>2</td>
                                <td> <a href="pt_info.php?pid=111" rel="external">ด.ช.วัฒนศักดิ์ เล็กแจ้ง</a></td>
                                <td>33ป,2ด</td>
                                <td>100/23 ม.12 ถ.นิมานเหมินต์ ต.อรัญญิก อ.เมือง จ.พิษณุโลก</td>
                                <td>2013-02-11</td>
                                <td>รพ.สมเด็จพระยุพราชนครไทย</td>
                                <td>2013-02-12 23:09:09</td>
                            </tr>
                          
                            <tr>
                                <td><span class="status-metro status-suspended">ยังไม่รับ</span></td>
                                <td>1</td>
                                <td> <a href="pt_info.php?pid=111" rel="external">ด.ช.อลงกรณ์ เล็กแจ้ง</a></td>
                                <td>13ป,11ด</td>
                                <td>100/23 ม.12 ถ.นิมานเหมินต์ ต.อรัญญิก อ.เมือง จ.พิษณุโลก</td>
                                <td>2013-02-10</td>
                                <td>รพ.สมเด็จพระยุพราชนครไทย</td>
                                <td>2013-02-12 23:19:09</td>
                            </tr>
                           

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

