<?php

/* @var $this yii\web\View */

$this->title = 'Mesh Diagnose';
?>
<style>
    #map {
        height: 100vh;
        width: 100%;
    }
    .container {
        margin: 0 auto !important;
        padding: 0 !important;
        width: 100% !important;
    }
</style>
<div id="map"></div>

<script>
    var map;
    function initMap() {

        // Neues Map Element
        map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: -34.397, lng: 150.644},
            scrollwheel: false,
            zoom: 16,
            disableDefaultUI: true,
            streetViewControl: false
        });
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBiI6HJSMOEJ9_uAIDfYJRqokSqI1FT3RM&libraries=drawing&callback=initMap"
        async defer></script>
