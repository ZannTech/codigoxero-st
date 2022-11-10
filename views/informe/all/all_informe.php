<?php

ob_start();
use Dompdf\Dompdf;
$data = $this->data;
$distrito = $data[0]->distrito;
$fecha = $_GET['url'];
$id_district = $data[0]->id_district;
$fecha = str_replace('informe/generar/', '', $fecha);
$fecha = str_replace($id_district . '/', '', $fecha);
$fecha = trim($fecha, '/');
$t = count($data);
?>
 <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <link rel="stylesheet" href="<?php echo ASSETS_PATH ?>css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo ASSETS_PATH ?>css/animate.css">
        <link href="<?php echo ASSETS_PATH; ?>plugins/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="<?php echo ASSETS_PATH ?>css/styles.css">
        <link rel="stylesheet" href="<?php echo ASSETS_PATH ?>css/typography.css">
   
        <link rel="stylesheet" href="<?php echo ASSETS_PATH ?>css/default-css.css">
 </head>
<body>
    <div class="table-responsive">
        <table class="table table-bordered table-condensed text-center" width="100%" border="1" style="margin: 0px;">
            <thead>
                <tr>
                    <th style="width:100%;" colspan="7">DISTRITO:<?php echo  $distrito->description ?> </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                </tr>
                <tr>
                    <th>REGISTRADO POR</th>
                    <th>NOMBRE REGISTRADO</th>
                    <th>ZONA</th>
                    <th>MANZANA</th>
                    <th>WHATSAPP</th>
                    <th>EMAIL</th>
                    <th>TELEFONO</th>
                </tr>
                <?php
                foreach ($data as $k => $d) {
                    $w = $d->registrados[$k]->whatsApp != '' ? $d->registrados[$k]->whatsApp : '-';
                    $e = $d->registrados[$k]->email != '' ? $d->registrados[$k]->email : '-';
                    $p = $d->registrados[$k]->phone != '' ? $d->registrados[$k]->phone : '-';
                ?>
                    <tr>
                        <td scope="row"><?php echo $d->coordinador->nombre ?></td>
                        <td><?php echo $d->registrados[$k]->nombre . $d->registrados[$k]->last_name ?></td>
                        <td><?php echo $d->registrados[$k]->zona->description ?> </td>
                        <td><?php echo $d->registrados[$k]->manzana->description ?></td>
                        <td><?php echo $w ?></td>
                        <td><?php echo $e ?></td>
                        <td><?php echo $p ?></td>
                    </tr>
                <?php
                }
                ?>
                <tr>
                    <th style="width:100%;" colspan="7">TOTAL PERSONAS REGISTRADAS: <?php echo $t?> </th>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>

<?php 
    $html = ob_get_clean();
    $dompdf = new Dompdf();
    $opt = $dompdf->getOptions();
    $opt->set(array('isRemoteEnabled'=>true));
    $dompdf->setOptions($opt);
    $dompdf->loadHtml($html);
    $dompdf->setPaper('landscape');
    $dompdf->render();
    $dompdf->stream(time().".pdf", array("Attachment" => false))?>