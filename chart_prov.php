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

                $('#container1').highcharts({
                    credits: {
                        enabled: false
                    },
                    title: {
                        text: 'จำนวนผู้ป่วยด้วยโรคไข้เลือดออกรวม(26,27,66)จำแนกรายเดือน',
                        x: -20 //center
                    },
                    subtitle: {
                        text: 'จ.พิษณุโลก เปรียบเทียบข้อมูลปี 2557 กับค่ามัธยฐาน 5 ปี ย้อนหลัง ',
                        x: -20
                    },
                    xAxis: {
                        categories: ['ม.ค.', 'ก.พ.', 'มี.ค.', 'เม.ย.', 'พ.ค.', 'มิ.ย.',
                            'ก.ค.', 'ส.ค.', 'ก.ย.', 'ต.ค.', 'ก.ย.', 'ธ.ค.']
                    },
                    yAxis: {
                        title: {
                            text: 'จำนวนผู้ป่วย (ราย)'
                        },
                        plotLines: [{
                                value: 0,
                                width: 1,
                                color: '#808080'
                            }]
                    },
                    tooltip: {
                        valueSuffix: 'ราย'
                    },
                    legend: {
                        layout: 'vertical',
                        align: 'right',
                        verticalAlign: 'middle',
                        borderWidth: 0
                    },
                    series: [
                        {
                            name: '2552',
                            data: [36, 23, 30, 35, 93, 113, 102, 126, 66, 102, 126, 66, ]
                        },
                        {
                            name: '2553',
                            data: [24, 32, 35, 37, 52, 70, 85, 167, 167, 102, 126, 66, ]
                        },
                        {
                            name: '2554',
                            data: [27, 31, 30, 68, 176, 300, 293, 147, 73, 102, 126, 66, ]
                        },
                        {
                            name: '2555',
                            data: [16, 11, 36, 80, 84, 187, 175, 202, 148, 102, 126, 66, ]
                        },
                        {
                            name: '2556',
                            data: [69, 68, 56, 96, 119, 205, 246, 173, 112, 102, 126, 66, ]
                        },
                        {
                            name: 'median',
                            data: [27, 31, 35, 68, 93, 187, 175, 167, 112, 102, 126, 66]
                        }
                        ,
                        {
                            name: '2557',
                            color: '#FF0000',
                            lineWidth: 3,
                            data: [3, 6]
                        }
                    ]
                });

                ///
                $('#container2').highcharts({
                    chart: {
                        type: 'column'
                    },
                    credits: {
                        enabled: false
                    },
                    title: {
                        text: 'จำนวนผู้ป่วยด้วยโรคไข้เลือดออกรวม(26,27,66)จำแนกรายอำเภอ'
                    },
                    xAxis: {
                        categories: [<?php echo implode(",", $amp); ?>]
                    },
                    yAxis: {
                        min: 0,
                        title: {
                            text: 'จำนวนผู้ป่วย (ราย)'
                        },
                        stackLabels: {
                            enabled: true,
                            style: {
                                fontWeight: 'bold',
                                color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
                            }
                        }
                    },
                    legend: {
                        align: 'right',
                        x: -70,
                        verticalAlign: 'top',
                        y: 20,
                        floating: true,
                        backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColorSolid) || 'white',
                        borderColor: '#CCC',
                        borderWidth: 1,
                        shadow: false
                    },
                    tooltip: {
                        formatter: function() {
                            return '<b>' + this.x + '</b><br/>' +
                                    this.series.name + ': ' + this.y + '<br/>' +
                                    'รวม: ' + this.point.stackTotal;
                        }
                    },
                    plotOptions: {
                        column: {
                            stacking: 'normal',
                            dataLabels: {
                                enabled: true,
                                color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white'
                            }
                        }
                    },
                    series: [{
                            name: 'ชาย',
                            data: [<?php echo implode(",", $male); ?>]
                        }, {
                            name: 'หญิง',
                            data: [<?php echo implode(",", $female); ?>]
                        }]
                });

                ///
                $('#container3').highcharts({
                    chart: {
                        plotBackgroundColor: null,
                        plotBorderWidth: null,
                        plotShadow: false
                    },
                    credits: {
                        enabled: false
                    },
                    title: {
                        text: 'จำนวนผู้ป่วยด้วยโรคไข้เลือดออกรวม(26,27,66)จำแนกตามกลุ่มอายุ'
                    },
                    tooltip: {
                        pointFormat: '<b>จำนวน {point.y} ราย คิดเป็น {point.percentage:.1f}%</b>'
                    },
                    plotOptions: {
                        pie: {
                            allowPointSelect: true,
                            cursor: 'pointer',
                            dataLabels: {
                                enabled: true,
                                color: '#000000',
                                connectorColor: '#000000',
                                format: '{point.name}'
                            }
                        }
                    },
                    series: [{
                            type: 'pie',
                            data: [
                                ['1-5', 1],
                                ['11-15', 3],
                                ['16-20', 2],
                            ]
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


                <div id="container1"   class="ui-body ui-body-f ui-corner-all"></div>
                <br>
                <div id="container2"  class="ui-body ui-body-f ui-corner-all"></div>
                <br>
                <div id="container3"  class="ui-body ui-body-f ui-corner-all"></div>


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
