<meta charset="UTF-8">
<style>  
    body{
        height: 100%
    }
    .map-div{
        height: 90%;
        width: 100%;

    }

</style>
<script src="http://maps.google.com/maps/api/js?sensor=false&libraries=geometry&v=3.7&language=TH"></script>
<script src="//code.jquery.com/jquery-1.9.1.js"></script>

<script>
    $(document).ready(function() {
        getGeo();
    });

    function getGeo() {
        if (navigator.geolocation) { // ตรวจสอบว่า support geolocation หรือไม่
            navigator.geolocation.getCurrentPosition(function(position) {
                lat = position.coords.latitude;
                lng = position.coords.longitude;
                initMap(lat, lng, 16)
                $('#lat').val(lat);
                $('#lng').val(lng);
            });
        } else {
            //alert("อุปกรณ์นี้ไม่สนับสนุน Geo-Location");
            initMap(16.822003, 100.264948, 8)
            $('#lat').val('16.822003');
            $('#lng').val('100.264948');
        }
    }// end getGeo

</script>
<script>
    function initMap(lat, lng, zoom) {
        var mapOptions = {
            zoom: zoom,
            center: new google.maps.LatLng(lat, lng),
            mapTypeId: google.maps.MapTypeId.HYBRID
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

            $('#lat').val(marker.getPosition().lat());
            $('#lng').val(marker.getPosition().lng());



        });//drag

        google.maps.event.addListener(marker, 'dragend', function() {

            //$('#latlng').html(marker.getPosition().lat() + "," + marker.getPosition().lng());
            $('#lat').val(marker.getPosition().lat());
            $('#lng').val(marker.getPosition().lng());


            map.panTo(marker.getPosition());


        });// drag-end

    }
</script>
<body>
    <script>
        function btn_ok_click() {
            var lt=$("#lat").val();
            var ln=$('#lng').val()
            $("#lat", window.opener.document).val(lt);
            $("#lng", window.opener.document).val(ln);

            window.close();
        }
    </script>
    <div id="map-canvas" class="map-div"></div>
    <div align="right">
       
        <input type="text" id="lat"> , <input type="text" id="lng">  
        <button onclick="window.close()">ยกเลิก</button>
        <button onclick="btn_ok_click()">ตกลง</button>
    </div>
</body>
