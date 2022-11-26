<input type="hidden" id="is_settings" value="true">
<div class="row">
    <div class="col-lg-4 mt-4">
        <div class="card shadow-xl">
            <div class="card-body">
                <h4 class="card-title text-center">Configuración de la App</h4>
                <div class="row">
                    <div class="col-lg-12">
                        <button class="btn btn-primary col-12" onclick='open_modal_app()'>Ajustes de App</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 mt-4">
        <div class="card shadow-xl">
            <div class="card-body">
                <h4 class="card-title">Configuración APIS</h4>
                <div class="row">
                    <div class="col-lg-12">
                        <button class="btn btn-primary col-12" onclick='open_modal_api()'>Ajustes de APIS</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card shadow-xl mt-4">
            <div class="card-body">
                <h4 class="card-title">Logo de la App</h4>
                <div class="row">
                    <div class="col-12 text-center mt-2 mb-2">
                        <form class="dropzone" id="frm_logo">
                            <div class="fallback" style="width: 100%;">
                                <input name="file" type="file" multiple />
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-12">
                        <button class="btn btn-primary col-12 import" disabled>Subir Logo</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal inmodal" id="modal_app" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <h4 class="modal-title lead text-center">Configuración App</h4>
                <button type="button" class="close" data-bs-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
            </div>
            <div class="modal-body">
                <div class="row floating-labels m-t-40">
                    <div class="col-lg-12 pb-2">
                        <div class="form-group">
                            <label for="app_name">Nombre App</label>
                            <input type="text" id="app_name" value="<?php echo APP_NAME ?>" class="form-control" placeholder="Nombre Aplicación" aria-describedby="help_name">
                        </div>
                    </div>
                    <div class="col-lg-12 pb-2">
                        <div class="form-group">
                            <label for="mensaje_bienvenida">Mensaje Bienvenida</label>
                            <textarea class="form-control" name="" id="mensaje_bienvenida" rows="3" maxlength="500"><?php echo MENSAJE_BIENVENIDA ?></textarea>
                            <small id="frm_help">0 - 500 Carácteres</small><br />
                        </div>
                    </div>
                    <div class="col-lg-12 pb-2">
                        <div class="form-group">
                            <label for="mensaje_bienvenida">Mensaje Default</label>
                            <textarea class="form-control" name="" id="mensaje_default" rows="3" maxlength="500"><?php echo MENSAJE_DEFAULT ?></textarea>
                            <small id="frm_help">0 - 500 Carácteres</small><br />
                        </div>
                    </div>

                    <div class="col-lg-12 pb-2">
                        <div class="form-group">
                            <label for="number_wsp">Número Whatsapp <a href="https://www.twilio.com/login" target="_blank">Twilio</a></label>
                            <input type="text" id="number_wsp" value="<?php echo NUMBER_WSP ?>" class="form-control" placeholder="Número Twilio Whatsapp" aria-describedby="help_name">
                        </div>
                    </div>
                    <div class="col-lg-12 pb-2">
                        <div class="form-group">
                            <label for="number_wsp">Número SMS <a href="https://www.twilio.com/login" target="_blank">Twilio</a></label>
                            <input type="text" id="number_sms" value="<?php echo NUMBER_SMS ?>" class="form-control" placeholder="Número Twilio SMS" aria-describedby="help_name">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-success btn-guardar-app">Aceptar</button>
            </div>
        </div>
    </div>
</div>
<div class="modal inmodal" id="modal_api" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <h4 class="modal-title lead text-center">Configuración API</h4>
                <button type="button" class="close" data-bs-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
            </div>
            <div class="modal-body">

                <div class="row floating-labels m-t-40">
                    <div class="col-lg-12 pb-2">
                        <div class="form-group">
                            <label for="wheather_key">API KEY <a href="https://www.weatherapi.com/" target="_blank">Weather App</a></label>
                            <input type="text" id="wheather_key" value="<?php echo WHEATHER_KEY ?>" class="form-control" placeholder="API KEY Weather" aria-describedby="help_name">
                        </div>
                    </div>
                    <div class="col-lg-12 pb-2">
                        <div class="form-group">
                            <label for="ssid_twilio">SSID <a href="https://www.twilio.com/login" target="_blank">Twilio</a></label>
                            <input type="text" id="ssid_twilio" value="<?php echo SSID ?>" class="form-control" placeholder="SSID Twilio" aria-describedby="help_name">
                        </div>
                    </div>
                    <div class="col-lg-12 pb-2">
                        <div class="form-group">
                            <label for="token_twilio">Auth Token <a href="https://www.twilio.com/login" target="_blank">Twilio</a></label>
                            <input type="text" id="token_twilio" value="<?php echo TOKEN ?>" class="form-control" placeholder="Auth Token Twilio" aria-describedby="help_name">
                        </div>
                    </div>
                    <div class="col-lg-12 pb-2">
                        <div class="form-group">
                            <label for="messaging_service">Messaging Service Key <a href="https://www.twilio.com/login" target="_blank">Twilio</a></label>
                            <input type="text" id="messaging_service" value="<?php echo MSN_SSID ?>" class="form-control" placeholder="Auth Token Twilio" aria-describedby="help_name">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-success btn-guardar-api">Aceptar</button>
            </div>
        </div>
    </div>
</div>