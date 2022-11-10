<div id="map" class="mt-3" style="z-index: 1;width: 100%; height: 800px;"></div>



<script>
    var map = L.map('map').setView([-12.068867, -77.03064], 10);
    var tiles = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);
    let heathMapPoints = []
    <?php
    foreach ($this->coords as $k => $d) {
        if($d->latitude != null && $d->longitude != null):
    ?>
            heathMapPoints.push([<?php echo $d->latitude ?>, <?php echo $d->longitude ?>, 2.3])
    
L.marker([<?php echo $d->latitude ?>, <?php echo $d->longitude ?>]).addTo(map)
            .bindPopup(`
                <div class="row">
                    <div class="col-12">
                        <p>
                        <b>
                        <?php echo $d->type_user->type . ': ' . $d->nombre ?>
                        <?php echo '<br>DISTRITO: ' .  $d->distrito->description ?>
                        <?php echo '<br>ZONA: ' . $d->zona->description ?>
                        <?php echo '<br>MANZANA: ' . $d->manzana->description ?>
                        </b>
                        </p>
                    </div>
                </div>
            `).openPopup();

    <?php
    endif;
    }
    ?>
    var heat = L.heatLayer(heathMapPoints, {
        radius: 25,
        minOpacity: 0.6,
        gradient: {
            '0': 'Navy','0.25':'Navy',
            '0.26': 'Green',
            '0.5': 'Green',
            '0.51': 'Yellow',
            '0.75': 'Yellow',
            '0.76': 'Red',
            '1': 'Red'
        }
    }).addTo(map)
</script>