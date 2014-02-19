<?php
$amp = array("'เมือง'", "'นครไทย'", "'ชาติตระการ'", "'บางระกำ'", "'บางกระทุ่ม'", "'พรหมพิราม'", "'วัดโบสถ์'", "'วังทอง'", "'เนินมะปราง'");
$male = array(0, 0, 1, 0, 0, 0, 0, 0, 0);
$female = array(2, 0, 1, 0, 0, 0, 0, 0, 1);
?>
<!DOCTYPE html> 
<html>
    <head>
        <?php require 'lib.php'; ?>
        <script src="http://code.highcharts.com/highcharts.js"></script>
        <script src="http://code.highcharts.com/highcharts-more.js"></script>
        <script src="http://code.highcharts.com/modules/exporting.js"></script>
        <script>
            $(document).on('pageshow', '#page-1', function() {

                ///

                $('#container1').highcharts({
                    credits: {
                        enabled: false
                    },
                    chart: {
                        type: 'column'
                    },
                    title: {
                        text: 'ความครบถ้วนทันเวลา'
                    },
                    subtitle: {
                        text: 'แยกรายอำเภอ'
                    },
                    xAxis: {
                        categories: [<?php echo implode(",", $amp); ?>]

                    },
                    yAxis: {
                        min: 0,
                        title: {
                            text: 'ร้อยละ'
                        }
                    },
                    tooltip: {
                        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                                '<td style="padding:0"><b>{point.y}</b></td></tr>',
                        footerFormat: '</table>',
                        shared: true,
                        useHTML: true
                    },
                    plotOptions: {
                        column: {
                            pointPadding: 0.2,
                            borderWidth: 0
                        }
                    },
                    series: [{
                            name: 'ครบถ้วน',
                            color: 'green',
                            data: [49.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, ]

                        }, {
                            name: 'ทันเวลา',
                            data: [83.6, 78.8, 98.5, 93.4, 106.0, 84.5, 105.0, 104.3, 91.2, ]

                        }]
                });

            });//end pageshow
        </script>
    </head> 
    <body> 
        <div data-role="page" id="page-1">          

            <div data-role="header" data-position="fixed" data-theme="f">
                <a href="#" data-rel="back" data-icon="back">Back</a>
                <?php require 'txt_head.php'; ?>
                <a href="#dlg-mnu" data-icon="bars" data-rel="dialog">อำเภอ</a>
            </div>
            <div data-role="content" data-theme="f">	

                <div id="container1"  class="ui-body ui-body-f ui-corner-all"></div>



            </div> <!-- end content -->


            <div data-role="footer" data-position="fixed" data-theme="f" >                
                <?php require 'txt_foot.php'; ?>
            </div>
        </div>  <!-- end page-1 -->

        <div data-role="page" id="dlg-mnu">
            <div data-role="header" data-position="fixed" data-theme="f">
                <h1>เลือกอำเภอ</h1>
            </div>
            <div data-role="content" data-theme="f" align="center">
                <table>
                    <tr>
                        <td> <a href="#page-1" data-role="button" >เมือง</a></td>
                        <td> <a href="#" data-role="button" >นครไทย</a></td>
                        <td> <a href="#" data-role="button" >ชาติตระการ</a></td>
                    </tr>
                    <tr>
                        <td> <a href="#" data-role="button" >วัดโบสถ์</a></td>
                        <td> <a href="#" data-role="button" >เมือง</a></td>
                        <td> <a href="#" data-role="button" >เมือง</a></td>
                    </tr>
                    <tr>
                        <td> <a href="#" data-role="button" >เมือง</a></td>
                        <td> <a href="#" data-role="button" >เมือง</a></td>
                        <td> <a href="#" data-role="button" >เมือง</a></td>
                    </tr>
                </table>


            </div>

        </div><!-- /dlg-mnu -->


    </body>
</html>
