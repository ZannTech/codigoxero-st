<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <form action="<?php echo "https://api.ultramsg.com/{$_SESSION['instance_id']}/instance/qr?token={$_SESSION['token_instance']}" ?>" id="send_test_request_form" method="get">
                <div class="card-body">
                    <h4 class="card-title">Configuración Whatsapp</h4>
                    <p class="card-text">Rellena toda la configuración</p>
                    <div class="row">
                        <div class="col-12">
                            <div class="alert alert-success" role="alert">
                                <strong>Para poder configurar perfectamente la aplicación, se requiere que completes todos los campos del siguiente formulario.
                                    Los consigues en: <a target="_blank" href="https://ultramsg.com/es/">https://ultramsg.com/es/</a>
                                </strong>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-3">
                            <div class="form-group">
                                <label for="">ID Instancia</label>
                                <input type="text" name="" value="<?php echo $_SESSION['instance_id']; ?>" id="instance" class="form-control" aria-describedby="helpId">
                                <small id="helpId" class="text-muted">Instancia ID</small>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-3">
                            <div class="form-group">
                                <label for="">Token</label>
                                <input type="text" name="" value="<?php echo $_SESSION['token_instance']; ?>" id="token" class="form-control" aria-describedby="helpId">
                                <small id="helpId" class="text-muted">Token Instancia</small>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="alert alert-warning" role="alert">
                                <strong>Puedes guardar la configuración cuando testees toda la mensajería.</strong>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="alert alert-info" role="alert">
                                <strong>Tienes la alternativa de probar la configuración de la API, en caso de que ya hayas iniciado sesión con el Qr, no mostrará nada, al contrario mostrará un Qr, (FAVOR DE ESCANEAR EN LA APLICACIÓN DE WHATSAPP)</strong>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-3">
                            <button  type="button" class="btn btn-info col-12 save"><i class="fa-solid fa-floppy-disk fa-bounce"></i> Guardar</button>
                        </div>
                        <div class="col-lg-6 mb-3">
                            <button type="button" class="btn btn-success col-12 check"><i class="fa-brands fa-whatsapp"></i> Verificar Conexión Whatsapp</button>
                        </div>
                        <div class="col-lg-12 mt-2 text-center qr-" style="display: none;">
                            <h3>Código QR</h3>
                            <div class="qr">
                                
                            </div>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>