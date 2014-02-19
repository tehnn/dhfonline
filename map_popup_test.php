<?php
session_start();
?>
<!DOCTYPE html> 
<html>
    <head>
        <?php require 'lib.php'; ?>
        <script src="http://maps.google.com/maps/api/js?sensor=false&libraries=geometry&v=3.7&language=TH"></script>

        <style>   


            .map-div{
                height: 300px;
                width: 100%;

            }
            #latlng{
                position:absolute;
                top:300px;  /* adjust value accordingly */
                left:5px;  /* adjust value accordingly */
                z-index: 9999;
                background-color:#008c8c;
                color: white;

            }
        </style>
        <script>

            $(document).ready(function() {
                getGeo();
            });

            function getGeo() {
                if (navigator.geolocation) { // ตรวจสอบว่า support geolocation หรือไม่
                    navigator.geolocation.getCurrentPosition(function(position) {
                        lat = position.coords.latitude;
                        lng = position.coords.longitude;
                        $('#lat').val(lat);
                        $('#lng').val(lng);
                    });
                } else {
                    alert("อุปกรณ์นี้ไม่สนับสนุน Geo-Location");

                }
            }// end getGeo


            $(document).on('pageshow', '#page-map', function(e, data) {
                var map, lat, lng;



                if (navigator.geolocation) { // ตรวจสอบว่า support geolocation หรือไม่
                    navigator.geolocation.getCurrentPosition(function(position) {
                        lat = position.coords.latitude;
                        lng = position.coords.longitude;
                        $("#latlng").html(lat + "," + lng);


                        initMap(lat, lng, 15);
                    });
                } else {
                    $("#latlng").html("อุปกรณ์นี้ไม่สนับสนุน Geo-Location");
                    initMap(16.8175556, 100.2609311, 8);// พิษณุโลก                    

                }
                // map
                function initMap(lat, lng, zoom) {
                    var mapOptions = {
                        zoom: zoom,
                        center: new google.maps.LatLng(lat, lng),
                        mapTypeId: google.maps.MapTypeId.SATELLITE
                    };
                    map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

                    var marker = new google.maps.Marker({
                        map: map,
                        position: map.getCenter(),
                        clickable: true,
                        draggable: true,
                        title: 'ลากหมุดเพื่อเปลี่ยนค่าพิกัด'
                    });

                    google.maps.event.addListener(marker, 'drag', function() {

                        $('#latlng').html(marker.getPosition().lat() + "," + marker.getPosition().lng());


                    });//drag

                    google.maps.event.addListener(marker, 'dragend', function() {

                        $('#latlng').html(marker.getPosition().lat() + "," + marker.getPosition().lng());
                        $('#lat').val(marker.getPosition().lat());
                        $('#lng').val(marker.getPosition().lng());


                        map.panTo(marker.getPosition());

                    });// drag-end

                }

            });// end page-map show

        </script>
    </head> 
    <body> 
        <div data-role="page" id="page-1">
            <div data-role="header" data-position="fixed" data-theme="f">
                <a href="#" data-icon="back">Home</a>
                <?php require 'txt_head.php'; ?>
                <a href="#" data-icon="info">About</a>
            </div>
            <div data-role="content" data-theme="f" >	
                <form action="qry_add_home.php" method="POST" data-ajax="false"  class="ui-body ui-body-f ui-corner-all">
                    <table width ="100%">
                        <tr>
                            <td width="40%"><input  name="lat" id="lat" data-mini="true" type="text" placeholder="ละติจูด"></td>
                            <td width="40%"><input  name="lng" id="lng" data-mini="true" type="text" placeholder="ลองติจูด"></td>
                            <td width="20%">
                                <a href="#" onclick="getGeo()" data-role="button" data-inline="true" data-mini="true"> พิกัด </a>
                                <a href="#page-map" data-rel="dialog" data-position-to="window" data-role="button" data-inline="true" data-mini="true"> แผนที่ </a>

                            </td>
                        </tr>

                    </table>
                    <input type="submit" value="ตกลง"/>
                </form>




            </div> <!-- end content -->
            <div data-role="footer" data-position="fixed" data-theme="f" >                
                <?php require 'txt_foot.php'; ?>
            </div>
        </div>  <!-- end page-1 -->

        <div data-role="page" id="page-map">
            <div data-role="header" data-position="fixed" data-theme="f">
                <h1>Map</h1>
            </div>
            <div data-role="content" id="map-content">
                <div id="latlng"></div>
                <div id="map-canvas" class="map-div"></div>
            </div> <!-- end content -->

        </div>  <!-- end page -->



    </body>
</html>
