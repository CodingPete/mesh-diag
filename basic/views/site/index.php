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
    #create_testcase {
        position: absolute;
        left: 0;
        z-index: 1000;
        top: 50px;
        background-color: greenyellow;
        font-size: 2em;
    }
    #select_testcase {
        position: absolute;
        top: 50px;
        right: 0;
        z-index: 1000;
        font-size: 2em;
    }
    #select_testcase > * {
        background-color: grey;
    }
    #sampler {
        position:absolute;
        left:0;
        right: 0;
        bottom: 0;
        top: 90vh;
        background-color: #1a1a1a;
    }
</style>
<?php if($allow_create): ?>
    <button id="create_testcase">
        Testcase erstellen
    </button>
<?php endif; ?>
<div id="select_testcase">
    <select id="testcase">
        <?php foreach($testcases as $testcase): ?>
            <option value="<?=$testcase->id; ?>">Testcase : <?=$testcase->id; ?></option>
        <?php endforeach; ?>
    </select>
</div>
<div id="map">
</div>

<div id="sampler">
    <div id="slider">
        <input id="slider_input" value="<?=strtotime($testcase->start);?>" min="<?=strtotime($testcase->start);?>" max="<?=strtotime($testcase->end);?>" type="range" step="1">
    </div>
    <div id="controls">
        <button id="play">Play</button>
        Rewind, Play, Stop, Forward
    </div>
</div>

<script>
    var map;
    function initMap() {

        // Neues Map Element
        map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: -34.397, lng: 150.644},
            scrollwheel: true,
            zoom: 16,
            disableDefaultUI: false,
            streetViewControl: false
        });
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBiI6HJSMOEJ9_uAIDfYJRqokSqI1FT3RM&libraries=drawing&callback=initMap"
        async defer></script>
<script>
</script>
