@extends('back.layout.app')

@section('content')
<style>
    /* Always set the map height explicitly to define the size of the div
        * element that contains the map. */
    #map {
        height: 100%;
    }

    /* Optional: Makes the sample page fill the window. */
    html,
    body {
        height: 100%;
        margin: 0;
        padding: 0;
    }

    #map {
        height: 500px;
        width: 100%;
    }

</style>
<h4 class="page-title"><span class="la la-clipboard"></span> จัดการข้อมูลร้านค้า</h4>
<div class="row">
    <div class="col-md-12 bg-light border border-primary rounded p-2">

        <hr>

        <div class="row">
            <div class="col-md-11 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">สาขา</div>
                    </div>
                    <div class="card-body">
                        <div id="map"></div>
                        <script>
                            var map;

                            function initMap() {
                                var mapOptions = {
                                    center: {
                                        lat: 13.847860,
                                        lng: 100.604274
                                    },
                                    zoom: 15,
                                }

                                var maps = new google.maps.Map(document.getElementById("map"), mapOptions);

                                var marker = [];

                                var tempMarker = new google.maps.Marker({
                                    position: new google.maps.LatLng(13.847616, 100.604736),
                                    map: maps,
                                    title: 'ถนน ลาดปลาเค้า'
                                });

                                var tempMarker2 = new google.maps.Marker({
                                    position: new google.maps.LatLng(13.847614, 100.604732),
                                    map: maps,
                                    title: 'ถนน ลาดปลาเค้า'
                                });

                                marker.push(tempMarker);
                                marker.push(tempMarker2);
                            }

                        </script>
                        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCSl3eJlws9EJkD8OlbA5iixSAdpx_Gr6M&callback=initMap"
                            async defer></script>
                        <p>เจ้าโบ้ะ</p>
                    </div>
                    <div class="card-header">
                        <div class="card-title">ข้อมูลโดยรวม</div>
                    </div>
                    <div class="card-body">
                        <p>เจ้าโบ้ะ</p>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>



@endsection
