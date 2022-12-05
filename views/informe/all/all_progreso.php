<div class="row mt-3">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Progreso de campo de distritos</h4>
                <div id="par_inf" class="according">
                    <?php
                    foreach ($this->inf as $k => $d) {
                        $pct = (100 * $d->reporte->c) / $d->cant_proposal;
                        $pct = $pct >= 100 ? 100.00 : $pct;
                    ?>
                        <div class="card shadow-xl">
                            <div class="card-header">
                                <a class="card-link" data-toggle="collapse" href="#<?php echo 'coll_' . $k ?>"><?php echo 'INFORME DE PROGRESO DEL DISTRITO <b>' . $d->detalle->description . '</b>' ?></a>
                            </div>
                            <div id="<?php echo 'coll_' . $k ?>" class="collapse" data-parent="#par_inf">
                                <div class="card-body">
                                    <div class="progress_area p-4">
                                        <div class="progress text-white">
                                        <div class="progress-bar bg-success progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo number_format($pct, 2); ?>%"><?php echo number_format($pct, 2); ?>%</div>
                                            
                                        </div>
                                        <p>
                                        LA CUADRILLA DE TRABAJO DEL COORDINADOR <?php echo $d->coordinador->nombre ?> HA HECHO <?php echo $d->reporte->c ?> REGISTROS DE <?php echo $d->cant_proposal ?> QUE TIENE COMO META
                                            </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>