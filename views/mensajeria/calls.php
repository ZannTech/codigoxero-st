<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<div class="row pt-4">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Crear Llamada</h4>
                <p class="card-text">Busca una persona para llamar</p>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for=""></label>
                            <select class="form-control" name="" id="select-clients">

                            </select>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="">Texto de la llamada</label>
                            <textarea class="form-control" id="saythis" rows="4" maxlength="500"></textarea>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <button type="button" class="btn btn-primary" id="call">Crear llamada</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const users = [{
            id: "",
            text: "Seleccione un usuario para llamar"
        },
        <?php
        foreach ($this->persons as $k => $d) {
            $lada_index = strpos($d->phone, ' ');
            $phone = substr($d->phone, $lada_index + 1);
            $lada = substr($d->phone, 0, $lada_index);
            if ($lada == "+521") {
                $lada = "+52";
            }
        ?> {
                id: "<?php echo  $lada . $phone; ?>",
                text: "<?php echo $d->first_name . ' ' . $d->last_name  . ' / ' .  $lada . $phone ?> "
            },
        <?php
        }
        ?>
    ]
</script>