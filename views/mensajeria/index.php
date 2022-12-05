<?php
if ($this->type == 'internal') {
    //internal
?>
    <input type="hidden" class="hidden" id="input_imp">
    <input type="hidden" class="hidden" id="url_file">

    <div class="row mt-4">

        <div class="col-lg-12">
            <div class="card shadow-xl">
                <div class="card-body">

                    <h4 class="card-title mt-3">Envio de mensajería masiva.</h4>
                    <p class="card-text">¡Personaliza tu mensaje a tu gusto!.</p>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="id_zone">Zona o distrito destinada</label>
                                <select class="form-control selectpicker border" id="id_zone" data-live-search="true">
                                    <option value="">Selecciona una zona para enviar el mensaje</option>
                                    <?php
                                    foreach ($this->zonas as $k => $d) {
                                    ?>
                                        <option value="<?php echo 'Z-' . $d->id_zone ?>">
                                            <?php echo 'ZONA ' . $d->description ?>
                                        </option>
                                    <?php
                                    }
                                    ?>
                                    <?php
                                    foreach ($this->distritos as $k => $d) {
                                    ?>
                                        <option value="<?php echo 'D-' . $d->id_district ?>">
                                            <?php echo 'DISTRITO ' . $d->description ?>
                                        </option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="id_zone">Plantilla</label>
                                <select class="form-control selectpicker border" id="plantilla" data-live-search="true">
                                    <option value="">Selecciona una plantilla</option>
                                    <?php
                                    foreach ($this->plantillas as $k => $d) {
                                    ?>
                                        <option value="<?php echo $d->body ?>">
                                            <?php echo $d->nombre ?>
                                        </option>
                                    <?php
                                    }
                                    ?>

                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 mt-2">
                            <label for="id_zone">Selecciona un archivo, si deseas enviar multimedia.</label>
                            <button class="btn btn-primary  col-12 btn-rounded select-file"><i class="mdi mdi-upload"></i> Seleccionar Archivo</button>
                        </div>
                        <!-- <div class="col-lg-4 mt-2">
                            <label for="id_zone">Selecciona un archivo <b>.csv, xlsx, xls</b> para enviar a
                                contactos.</label>
                            <button class="btn btn-outline-success col-12 btn-rounded select-imp"><i class="mdi mdi-upload"></i> Importar CSV</button>
                        </div> -->
                        <!-- <div class="col-lg-4 mt-2">
                            <label for="short_phone">Código País</label>
                            <div class="form-group">
                                <div class="form-group mb-2">
                                    <select id="lada_phone" class="form-control selectpicker border" data-live-search="true">
                                        <?php
                                        foreach ($this->countries as $c => $d) {
                                        ?>
                                            <option value="<?php echo '+' . $d->phonecode; ?>" <?php echo $d->phonecode == '51' ?
                                                                                                    'selected' : '' ?>>
                                                <?php echo '+' . $d->phonecode . ' ' . $d->name; ?>
                                            </option>
                                        <?php
                                        }

                                        ?>
                                    </select>
                                </div>

                            </div>
                        </div> -->
                        <div class="col-lg-6">
                            <label for="id_zone" class="pt-2">Delay</label>

                            <div class="input-group mb-3">
                                <input type="number" min="0" max="10" id="delay" class="form-control" placeholder="x" aria-label="Segundos" aria-describedby="basic-addon1">
                                <span class="input-group-text" id="basic-addon1">seg x cada</span>
                                <input type="number" min="0" max="10" id="msx" class="form-control" placeholder="x" aria-label="Segundos" aria-describedby="basic-addon1">
                                <span class="input-group-text" id="basic-addon1">mensajes</span>

                            </div>

                        </div>
                        <div class="col-lg-12 mt-3" id="message-container">
                            <div class="form-group">
                                <label for="frm_mensaje">Cuerpo del mensaje</label>
                                <textarea class="form-control" id="frm_mensaje" maxlength="500" rows="10"></textarea>
                                <small id="frm_help">0 - 350 Carácteres</small><br />
                            </div>
                        </div>
                        <div class="col-lg-12 mt-3">
                            <small id="selected_file" class="mt-2"></small>
                            <small id="info" class="mt-2"></small>
                        </div>
                        <div class="col-lg-6 mt-3 text-center mb-3">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="type_msj" id="" value="wsp">
                                    Whatsapp
                                </label>
                            </div>

                        </div>
                        <div class="col-lg-6 mt-3 mb-3 text-center mb-3">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="type_msj" id="" value="sms">
                                    SMS
                                </label>
                            </div>

                        </div>
                        <div class="col-lg-12 mt-3 text-center mb-3">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input" name="" id="default_message">
                                    Mensaje por default
                                </label>
                            </div>
                        </div>
                        <div class="col-12">
                            <button class="btn btn-success col-12 btn-rounded send-message"><i class="mdi mdi-send md-18"></i> Enviar mensaje</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>




    <div class="modal inmodal" id="modal_files" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content animated bounceInRight">
                <div class="modal-header">
                    <h4 class="modal-title lead">Selecciona un archivo</h4>
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
                </div>
                <div class="modal-body">
                    <div class="containter">
                        <div class="row">
                            <div class="col-12 scroll">
                                <div class="row">

                                    <div class="col-12 text-center mt-2 mb-2">
                                        <form class="dropzone" id="frm_file">
                                            <div class="fallback" style="width: 100%;">
                                                <input name="file" type="file" />
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-rounded" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal inmodal" id="modal_imp" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content animated bounceInRight">
                <div class="modal-header">
                    <h4 class="modal-title lead">Selecciona un archivo CSV</h4>
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
                </div>
                <div class="modal-body">
                    <div class="containter">
                        <div class="row">
                            <div class="col-12 scroll">
                                <div class="row">

                                    <div class="col-12 text-center mt-2 mb-2">
                                        <form class="dropzone dimp" id="frm_file">
                                            <div class="fallback" style="width: 100%;">
                                                <input name="file" type="file" />
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-rounded" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
<?php
} else {
    //external
?>
    <input type="hidden" class="hidden" id="input_imp">
    <input type="hidden" class="hidden" id="url_file">

    <div class="row mt-4">

        <div class="col-lg-12">
            <div class="card shadow-xl">
                <div class="card-body">

                    <h4 class="card-title mt-3">Envio de mensajería masiva.</h4>
                    <p class="card-text">¡Personaliza tu mensaje a tu gusto!.</p>
                    <div class="row">
                        <!-- <div class="col-lg-4">
                            <div class="form-group">
                                <label for="id_zone">Zona o distrito destinada</label>
                                <select class="form-control selectpicker border" id="id_zone" data-live-search="true">
                                    <option value="">Selecciona una zona para enviar el mensaje</option>
                                    <?php
                                    foreach ($this->zonas as $k => $d) {
                                    ?>
                                        <option value="<?php echo 'Z-' . $d->id_zone ?>">
                                            <?php echo 'ZONA ' . $d->description ?>
                                        </option>
                                    <?php
                                    }
                                    ?>
                                    <?php
                                    foreach ($this->distritos as $k => $d) {
                                    ?>
                                        <option value="<?php echo 'D-' . $d->id_district ?>">
                                            <?php echo 'DISTRITO ' . $d->description ?>
                                        </option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div> -->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="id_zone">Plantilla</label>
                                <select class="form-control selectpicker border" id="plantilla" data-live-search="true">
                                    <option value="">Selecciona una plantilla</option>
                                    <?php
                                    foreach ($this->plantillas as $k => $d) {
                                    ?>
                                        <option value="<?php echo $d->body ?>">
                                            <?php echo $d->nombre ?>
                                        </option>
                                    <?php
                                    }
                                    ?>

                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 mt-2">
                            <label for="id_zone">Selecciona un archivo, si deseas enviar multimedia.</label>
                            <button class="btn btn-primary  col-12 btn-rounded select-file"><i class="mdi mdi-upload"></i> Seleccionar Archivo</button>
                        </div>
                        <div class="col-lg-4 mt-2">
                            <label for="id_zone">Selecciona un archivo <b>.csv, xlsx, xls</b> para enviar a
                                contactos.</label>
                            <button class="btn btn-success col-12 btn-rounded select-imp"><i class="mdi mdi-upload"></i> Importar CSV</button>
                        </div>
                        <div class="col-lg-4 mt-2">
                            <label for="short_phone">Código País</label>
                            <div class="form-group">
                                <div class="form-group mb-2">
                                    <select id="lada_phone" class="form-control selectpicker border" data-live-search="true">
                                        <?php
                                        foreach ($this->countries as $c => $d) {
                                        ?>
                                            <option value="<?php echo '+' . $d->phonecode; ?>" <?php echo $d->phonecode == '51' ?
                                                                                                    'selected' : '' ?>>
                                                <?php echo '+' . $d->phonecode . ' ' . $d->name; ?>
                                            </option>
                                        <?php
                                        }

                                        ?>
                                    </select>
                                </div>

                            </div>
                        </div>
                        <div class="col-lg-4">
                            <label for="id_zone" class="pt-2">Delay</label>

                            <div class="input-group mb-3">
                                <input type="number" min="0" max="10" id="delay" class="form-control" placeholder="x" aria-label="Segundos" aria-describedby="basic-addon1">
                                <span class="input-group-text" id="basic-addon1">seg x cada</span>
                                <input type="number" min="0" max="10" id="msx" class="form-control" placeholder="x" aria-label="Segundos" aria-describedby="basic-addon1">
                                <span class="input-group-text" id="basic-addon1">mensajes</span>

                            </div>

                        </div>
                        <div class="col-lg-12 mt-3" id="message-container">
                            <div class="form-group">
                                <label for="frm_mensaje">Cuerpo del mensaje</label>
                                <textarea class="form-control" id="frm_mensaje" maxlength="500" rows="10"></textarea>
                                <small id="frm_help">0 - 350 Carácteres</small><br />
                            </div>
                        </div>
                        <div class="col-lg-12 mt-3">
                            <small id="selected_file" class="mt-2"></small>
                            <small id="info" class="mt-2"></small>
                        </div>
                        <div class="col-lg-6 mt-3 text-center mb-3">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="type_msj" id="" value="wsp">
                                    Whatsapp
                                </label>
                            </div>

                        </div>
                        <div class="col-lg-6 mt-3 mb-3 text-center mb-3">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="type_msj" id="" value="sms">
                                    SMS
                                </label>
                            </div>

                        </div>
                        <div class="col-lg-12 mt-3 text-center mb-3">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input" name="" id="default_message">
                                    Mensaje por default
                                </label>
                            </div>
                        </div>
                        <div class="col-12">
                            <button class="btn btn-success col-12 btn-rounded send-message"><i class="mdi mdi-send md-18"></i> Enviar mensaje</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>




    <div class="modal inmodal" id="modal_files" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content animated bounceInRight">
                <div class="modal-header">
                    <h4 class="modal-title lead">Selecciona un archivo</h4>
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
                </div>
                <div class="modal-body">
                    <div class="containter">
                        <div class="row">
                            <div class="col-12 scroll">
                                <div class="row">

                                    <div class="col-12 text-center mt-2 mb-2">
                                        <form class="dropzone" id="frm_file">
                                            <div class="fallback" style="width: 100%;">
                                                <input name="file" type="file" />
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-rounded" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal inmodal" id="modal_imp" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content animated bounceInRight">
                <div class="modal-header">
                    <h4 class="modal-title lead">Selecciona un archivo CSV</h4>
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
                </div>
                <div class="modal-body">
                    <div class="containter">
                        <div class="row">
                            <div class="col-12 scroll">
                                <div class="row">

                                    <div class="col-12 text-center mt-2 mb-2">
                                        <form class="dropzone dimp" id="frm_file">
                                            <div class="fallback" style="width: 100%;">
                                                <input name="file" type="file" />
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-rounded" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
<?php
}
?>