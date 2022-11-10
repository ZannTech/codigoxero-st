<?php
$data = $this->data;
$fecha = $_GET['url'];
$fecha = str_replace('informe/general/', '', $fecha);
$fecha = trim($fecha, '/');
$in_fsfecha = strpos($fecha, '/');
$fecha_i = substr($fecha, 0, $in_fsfecha);
$fecha_f = substr($fecha, $in_fsfecha + 1, strlen($fecha));
?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link rel="stylesheet" href="<?php echo ASSETS_PATH ?>css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo ASSETS_PATH ?>css/animate.css">
    <link href="<?php echo ASSETS_PATH; ?>plugins/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="<?php echo ASSETS_PATH ?>css/styles.css">
    <link rel="stylesheet" href="<?php echo ASSETS_PATH ?>css/typography.css">
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
    <link rel="stylesheet" href="<?php echo ASSETS_PATH ?>css/print.min.css">
    <link rel="stylesheet" href="<?php echo ASSETS_PATH ?>css/default-css.css">
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>


</head>
<style>
    .highcharts-figure,
    .highcharts-data-table table {
        min-width: 320px;
        max-width: 660px;
        margin: 1em auto;
    }

    @media print {
        body {
            column-count: 1;
            -webkit-column-count: 1;
            -moz-column-count: 1;
        }
    }

    .highcharts-data-table table {
        font-family: Verdana, sans-serif;
        border-collapse: collapse;
        border: 1px solid #ebebeb;
        margin: 10px auto;
        text-align: center;
        width: 100%;
        max-width: 500px;
    }

    .highcharts-data-table caption {
        padding: 1em 0;
        font-size: 1.2em;
        color: #555;
    }

    .highcharts-data-table th {
        font-weight: 600;
        padding: 0.5em;
    }

    .highcharts-data-table td,
    .highcharts-data-table th,
    .highcharts-data-table caption {
        padding: 0.5em;
    }

    .highcharts-data-table thead tr,
    .highcharts-data-table tr:nth-child(even) {
        background: #f8f8f8;
    }

    .highcharts-data-table tr:hover {
        background: #f1f7ff;
    }


    .container_zonas,
    .container_distritos,
    container_manzanas {
        height: 1000px !important;
    }
</style>

<body id="app">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card text-left shadow-xl">
                    <div class="card-body">
                        <h1 class="card-title text-center">Reporte Autogenerado</h1>
                        <h2 class="card-text text-center"><?php echo APP_NAME ?> &copy;</h2>
                        <h5 class="card-text text-center"><?php echo 'DE : ' . quitar_acentos(strtoupper(fechaEs($fecha_i))) . ' A '  . quitar_acentos(strtoupper(fechaEs($fecha_f)))  ?></h5>
                        <button id="generate" onclick="window.print()" class="btn btn-primary col-12 mt-5"><i class="mdi mdi-printer"></i> Imprimir</button>

                    </div>
                </div>
            </div>
            <div class="app">

                <div class=" col-xl-12 row">
                    <div class="col-lg-12 mt-5">
                        <div class="card shadow-xl">
                            <div class="card-body">
                                <h4 class="card-title text-center">Gráfica de Distritos</h4>
                                <div id="container_distritos"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-5">
                        <div class="card shadow-xl">
                            <div class="card-body">
                                <h4 class="card-title text-center">Registrados a Distritos</h4>
                                <div class="row">
                                    <div class="table-responsive m-b-10">
                                        <table id="table" class="table table-condensed table-hover stylish-table" cellspacing="0" width="100%">
                                            <thead class="table-head">
                                                <th style="width: 20%;">Nombre</th>
                                                <th style="width: 20%;">No</th>
                                            </thead>
                                            <tbody class="tb-st">
                                                <?php
                                                foreach ($data->distritos as $k => $d) {

                                                ?>
                                                    <tr>
                                                        <td><?php echo $d->description; ?></td>
                                                        <td><?php echo $d->count->reg_c; ?></td>
                                                    </tr>
                                                <?php

                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class=" col-xl-12 row">
                    <div class="col-lg-12 mt-5">
                        <div class="card shadow-xl">
                            <div class="card-body">
                                <h4 class="card-title text-center">Gráfica de Zonas</h4>
                                <div id="container_zonas"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 mt-5 pt-5 ">
                        <div class="card shadow-xl">
                            <div class="card-body">
                                <h4 class="card-title text-center">Registrados a Zonas</h4>
                                <div class="row">
                                    <div class="table-responsive m-b-10">
                                        <table id="table" class="table table-condensed table-hover stylish-table" cellspacing="0" width="100%">
                                            <thead class="table-head">
                                                <th style="width: 20%;">Nombre</th>
                                                <th style="width: 20%;">No</th>
                                            </thead>
                                            <tbody class="tb-st">
                                                <?php
                                                foreach ($data->zonas as $k => $d) {

                                                ?>
                                                    <tr>
                                                        <td><?php echo $d->description; ?></td>
                                                        <td><?php echo $d->count->reg_c; ?></td>
                                                    </tr>
                                                <?php
                                                }

                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="col-xl-12 row">
                    <div class="col-12 mt-5 ">
                        <div class="card shadow-xl">
                            <div class="card-body">
                                <h4 class="card-title text-center">Gráfica de Manzanas</h4>
                                <div id="container_manzanas"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-xl-12 mt-5 pt-5">
                        <div class="card shadow-xl">
                            <div class="card-body">
                                <h4 class="card-title text-center">Registrados a Manzanas</h4>
                                <div class="row">
                                    <div class="table-responsive m-b-10">
                                        <table id="table" class="table table-condensed table-hover stylish-table" cellspacing="0" width="100%">
                                            <thead class="table-head">
                                                <th style="width: 20%;">Nombre</th>
                                                <th style="width: 20%;">No</th>
                                            </thead>
                                            <tbody class="tb-st">
                                                <?php
                                                foreach ($data->manzanas as $k => $d) {

                                                ?>
                                                    <tr>
                                                        <td><?php echo $d->description; ?></td>
                                                        <td><?php echo $d->count->reg_c; ?></td>
                                                    </tr>
                                                <?php
                                                }

                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-top: 50px;">
                    <div class="col-lg-12 mt-5">
                        <div class="card shadow-xl">
                            <div class="card-body">
                                <h4 class="card-title text-center">Simpatizantes Registrados</h4>
                                <div class="row">
                                    <div class="table-responsive m-b-10">
                                        <table id="table" class="table table-condensed table-hover stylish-table" cellspacing="0" width="100%">
                                            <thead class="table-head">
                                                <th style="width: 20%;">Fecha Registro</th>
                                                <th style="width: 20%;">Ultima Actualización</th>
                                                <th style="width: 25%;">Nombre</th>
                                                <th style="width: 20%;">Distrito</th>
                                                <th style="width: 20%;">Zona</th>
                                                <th style="width: 20%;">Manzana</th>
                                            </thead>
                                            <tbody class="tb-st">
                                                <?php
                                                foreach ($data->simpatizantes as $k => $d) {
                                                    if ($d->dni != null) {
                                                ?>
                                                        <tr>
                                                            <td><?php echo tiempo_transcurrido($d->date_create); ?></td>
                                                            <td><?php echo $d->date_update != null ? tiempo_transcurrido($d->date_create) : '-'; ?></td>
                                                            <td><?php echo $d->first_name . ' ' . $d->last_name; ?></td>
                                                            <td><?php echo $d->distrito->description; ?></td>
                                                            <td><?php echo $d->zona->description; ?></td>
                                                            <td><?php echo $d->manzana->description; ?></td>
                                                        </tr>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 mt-5">
                        <div class="card shadow-xl">
                            <div class="card-body">
                                <h4 class="card-title text-center">Coordinadores Registrados</h4>
                                <div class="row">
                                    <div class="table-responsive m-b-10">
                                        <table id="table" class="table table-condensed table-hover stylish-table" cellspacing="0" width="100%">
                                            <thead class="table-head">
                                                <th style="width: 20%;">Fecha Registro</th>
                                                <th style="width: 20%;">Ultima Actualización</th>
                                                <th style="width: 25%;">Nombre</th>
                                                <th style="width: 20%;">Distrito</th>
                                                <th style="width: 20%;">Zona</th>
                                                <th style="width: 20%;">Manzana</th>
                                            </thead>
                                            <tbody class="tb-st">
                                                <?php
                                                foreach ($data->coordinadores as $k => $d) {
                                                    if ($d->dni != null) {
                                                ?>
                                                        <tr>
                                                            <td><?php echo tiempo_transcurrido($d->date_create); ?></td>
                                                            <td><?php echo $d->date_update != null ? tiempo_transcurrido($d->date_create) : '-'; ?></td>
                                                            <td><?php echo $d->first_name . ' ' . $d->last_name; ?></td>
                                                            <td><?php echo $d->distrito->description; ?></td>
                                                            <td><?php echo $d->zona->description; ?></td>
                                                            <td><?php echo $d->manzana->description; ?></td>
                                                        </tr>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 mt-5">
                        <div class="card shadow-xl">
                            <div class="card-body">
                                <h4 class="card-title text-center">Voluntarios Registrados</h4>
                                <div class="row">
                                    <div class="table-responsive m-b-10">
                                        <table id="table" class="table table-condensed table-hover stylish-table" cellspacing="0" width="100%">
                                            <thead class="table-head">
                                                <th style="width: 20%;">Fecha Registro</th>
                                                <th style="width: 20%;">Ultima Actualización</th>
                                                <th style="width: 25%;">Nombre</th>
                                                <th style="width: 20%;">Distrito</th>
                                                <th style="width: 20%;">Zona</th>
                                                <th style="width: 20%;">Manzana</th>
                                            </thead>
                                            <tbody class="tb-st">
                                                <?php
                                                foreach ($data->voluntarios as $k => $d) {
                                                    if ($d->dni != null) {
                                                ?>
                                                        <tr>
                                                            <td><?php echo tiempo_transcurrido($d->date_create); ?></td>
                                                            <td><?php echo $d->date_update != null ? tiempo_transcurrido($d->date_create) : '-'; ?></td>
                                                            <td><?php echo $d->first_name . ' ' . $d->last_name; ?></td>
                                                            <td><?php echo $d->distrito->description; ?></td>
                                                            <td><?php echo $d->zona->description; ?></td>
                                                            <td><?php echo $d->manzana->description; ?></td>
                                                        </tr>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
    </div>
</body>
<!-- start chart js -->


<script src="<?php echo ASSETS_PATH ?>js/print.min.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/0.9.0rc1/jspdf.min.js"></script>

<script src="<?php echo URL ?>views/informe/js/all_general.js"></script>
<script>
    // new script
    var pieColors = (function() {
        var colors = [],
            base = Highcharts.getOptions().colors[0],
            i;

        for (i = 0; i < 10; i += 1) {
            // Start out with a darkened base color (negative brighten), and end
            // up with a much brighter color
            colors.push(Highcharts.color(base).brighten((i - 3) / 7).get());
        }
        return colors;
    }());

    function random_rgba() {
        var num = Math.round(0xffffff * Math.random());
        var r = num >> 16;
        var g = num >> 8 & 255;
        var b = num & 255;
        return 'rgb(' + r + ', ' + g + ', ' + b + ')';
    }
    const colors = [];
    const charts = {
        distrito: 'container_distritos',
        manzanas: 'container_manzanas',
        zonas: 'container_zonas'
    };
    Highcharts.chart(charts.distrito, {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Reportes de distritos en gráfica.'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        accessibility: {
            point: {
                valueSuffix: '%'
            }
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                colors: pieColors,
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b><br>{point.percentage:.1f} %',
                    distance: -50,
                    filter: {
                        property: 'percentage',
                        operator: '>',
                        value: 4
                    }
                }
            }
        },
        series: [{
            name: 'Personas',
            data: [
                <?php
                foreach ($data->distritos as $k => $d) {
                ?> {
                        name: '<?php echo trim($d->description) ?>',
                        y: <?php echo $d->count->reg_c ?>
                    },
                <?php
                }
                ?>
            ]
        }]
    });
    Highcharts.chart(charts.manzanas, {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Reportes de distritos en gráfica.'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        accessibility: {
            point: {
                valueSuffix: '%'
            }
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                colors: pieColors,
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b><br>{point.percentage:.1f} %',
                    distance: -50,
                    filter: {
                        property: 'percentage',
                        operator: '>',
                        value: 4
                    }
                }
            }
        },
        series: [{
            name: 'Personas',
            data: [
                <?php
                foreach ($data->manzanas as $k => $d) {
                ?> {
                        name: '<?php echo trim($d->description) ?>',
                        y: <?php echo $d->count->reg_c ?>
                    },
                <?php
                }
                ?>
            ]
        }]
    });
    Highcharts.chart(charts.zonas, {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Reportes de distritos en gráfica.'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        accessibility: {
            point: {
                valueSuffix: '%'
            }
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                colors: pieColors,
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b><br>{point.percentage:.1f} %',
                    distance: -50,
                    filter: {
                        property: 'percentage',
                        operator: '>',
                        value: 4
                    }
                }
            }
        },
        series: [{
            name: 'Personas',
            data: [
                <?php
                foreach ($data->zonas as $k => $d) {
                ?> {
                        name: '<?php echo trim($d->description) ?>',
                        y: <?php echo $d->count->reg_c ?>
                    },
                <?php
                }
                ?>
            ]
        }]
    });
</script>