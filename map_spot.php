<!DOCTYPE html> 
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0"/>
        <link rel="stylesheet" href="lib/jquery.mobile-1.3.2.min.css" />
        <link rel="stylesheet" href="themes/theme.css" />
        <script src="lib/jquery-1.9.1.min.js" ></script>
        <script src="lib/jquery.mobile-1.3.2.min.js" ></script>

        <script src="http://maps.google.com/maps/api/js?sensor=false&libraries=geometry&v=3.7&language=TH"></script>
        <script src="mapplace.min.js"></script>
        <script>
           
            var LocsA = [
               
                    
            ];
        </script>



        <style>
            .map-div{
                height: 500px;
                width: 100%;
                padding: 3px;
                border: 5px solid #ddd;
                font-size: 90%;

            }
        </style>

        <script>
            //dropdown example
            $(document).on('pageshow', '#page-map', function(e, data) {
                new Maplace({
                    locations: LocsA,
                    map_div: '#gmap1',
                    controls_on_map: false,
                    controls_title: 'Choose a location:',
                }).Load();
               
            });

        </script>
    </head> 
    <body> 

        <div data-role="page" id="page-map">
            <div data-role="header" data-position="fixed" data-theme="f">
                <a href="#" data-rel='back' data-icon="back">Back</a>
                <h1>แผนที่แสดงพิกัดบ้านผู้ป่วย</h1>
                <a href="#" rel="external" data-icon="bars">อำเภอ</a>
            </div>
            <div data-role="content" data-theme="f">	

                <div id="gmap1" class="map-div"></div>
                              

            </div> <!-- end content -->
            <div data-role="footer" data-position="fixed" data-theme="f" >                
                <?php require 'txt_foot.php'; ?>
            </div>
        </div>  <!-- end page-map -->






    </body>
</html>
