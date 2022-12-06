<div class="row mt-3">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Progreso de campo de distritos</h4>
                <div class="table-responsive">
                <table class="table table-striped table-inverse" style="width: 100%;">
                    <thead class="thead-inverse">
                        <tr>
                            <th>COORDINADOR</th>
                            <th>TIPO ASIGNACIÓN</th>
                            <th>NOMBRE AREA</th>
                            <th>REGISTRADOS</th>
                            <th>META</th>
                            <th>PROGRESO</th>

                        </tr>
                        </thead>
                        <tbody>
                           <?php
                                foreach ($this->inf as $k => $d) {
                                    $pct = (100 * $d->reporte->c) / $d->cant_proposal;
                                    $pct = $pct >= 100 ? 100.00 : $pct;
                                    if($d->asignacion){
                                ?>
                            <tr>
                                <td scope="row"><?= $d->coordinador->first_name . ' ' . $d->coordinador->last_name  ?></td>
                                <td><?= $d->asignacion->type ?></td>
                                <td><?= $d->detalle->description ?></td>
                                <td><?= $d->reporte->c ?></td>
                                <td><?= $d->cant_proposal ?></td>
                                <td>
                                <div class="progress_area p-4">
                                                <div class="progress text-white">
                                                <div class="progress-bar bg-success progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo number_format($pct, 2); ?>%"><?php echo number_format($pct, 2); ?>%</div>
                                                    
                                                </div>
                                            </div>
                                </td>

                            </tr>
                               
                                <?php
                                }
                            }
                                ?>
                           
                        </tbody>
                </table>
                </div>
                <div id="par_inf" class="according">
                   
                </div>
            </div>
        </div>
    </div>
</div>