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
                <a href="main_screen.php" rel="external" data-icon="back">Back</a>
                <?php require 'txt_head.php'; ?>
                <a href="login.php" rel='external' data-icon="arrow-r">Sign out</a>

            </div><!-- /header -->
            <div data-role="content" data-theme="f">
                <?php require 'office_title.php'; ?>
                <div class="ui-body ui-body-f" align="center">
                    <div class="title-text">
                        สำรวจพบลูกน้ำ  5 ครั้ง
                    </div>  
                </div>


                <div class="foo-container">
                    
                        <div>
                            <input id="filter" type="text" placeholder="ค้นหาผู้..."/>
                        </div>                       
                  

                    <table class="table demo metro-purple" 
                           data-filter="#filter" 
                           data-filter-text-only="true" 
                           data-page-size="6">
                        <thead>
                            <tr>
                                 <th>
                                    พบลูกน้ำ
                                </th>
                                <th >
                                    วันที่
                                </th>
                                <th data-hide="phone,tablet">
                                    ชื่อ-สกุล
                                </th>
                                <th data-toggle="true">
                                    เลขที่
                                </th>
                                <th data-hide="phone,tablet">
                                    หมู่
                                </th>
                                <th data-hide="phone,tablet">
                                    ตำบล
                                </th>
                                <th data-hide="phone,tablet">
                                    อำเภอ
                                </th>
                                <th data-hide="phone,tablet">
                                    จังหวัด
                                </th>
                                <th data-hide="phone,tablet">
                                    แผนที่
                                </th>
                            </tr>
                        </thead>
                        <tbody>  
                            <!-- select from patient_hos -->
                            <tr>
                                <td><span class="status-metro status-suspended">พบ</span></td>
                                <td>2</td>
                                <td>2</td>
                                <td> ด.ช.วัฒนศักดิ์ เล็กแจ้ง</td>
                                <td>33ป,2ด</td>
                                <td>100/23 ม.12 ถ.นิมานเหมินต์ ต.อรัญญิก อ.เมือง จ.พิษณุโลก</td>
                                <td>2013-02-11</td>
                                <td>รพ.สมเด็จพระยุพราชนครไทย</td>
                                <td>2013-02-12 23:09:09</td>
                            </tr>
                            <tr>
                                <td><span class="status-metro status-disabled">ไม่พบ</span></td>
                                <td>2</td>
                                <td>0</td>
                                <td>ด.ช.คมกฤษ เล็กแจ้ง</td>
                                <td>3ป,11ด</td>
                                <td>100/23 ม.12 ถ.นิมานเหมินต์ ต.อรัญญิก อ.เมือง จ.พิษณุโลก</td>
                                <td>2013-02-12</td>
                                <td>รพ.สมเด็จพระยุพราชนครไทย</td>
                                <td>2013-02-11 22:09:09</td>
                            </tr>


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
                    <a href="frm_add_larva.php" rel="external" data-icon="edit">เพิ่มสำรวจลูกน้ำ</a> 
                      <a href="map_larva_all.php" rel="external" data-icon="info">แผนที่</a>     

                </div>
                <?php require 'txt_foot.php'; ?>
            </div>
        </div>  <!-- end page -->


    </body>
</html>


