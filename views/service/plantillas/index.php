<div class="row pt-4">
    <div class="col-lg-3 pt-3">
        <a href="javascript: $('#modal_help').modal('show');">
            <div class="card shadow-md">
                <div class="contact-box">
                    <div class="card-body text-center">
                        <h4 class="card-title">¿Como importar?</h4>
                        <h6 class="card-subtitle text-muted">Ver información</h6>
                        <div class="">
                            <i class="mdi mdi-information-variant md-48"></i>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-lg-3 pt-3">
        <a href="<?php echo TEMPLATES_PATH; ?>templates_dist.zip">
            <div class="card shadow-md">
                <div class="contact-box">
                    <div class="card-body text-center">
                        <h4 class="card-title">Plantilla</h4>
                        <h6 class="card-subtitle text-muted">Distritos</h6>
                        <div class="">
                            <i class="mdi mdi-cloud-download-outline md-48"></i>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-lg-3 pt-3">
        <a href="<?php echo TEMPLATES_PATH; ?>templates_zones.zip">
            <div class="card shadow-md">
                <div class="contact-box">
                    <div class="card-body text-center">
                        <h4 class="card-title">Plantilla</h4>
                        <h6 class="card-subtitle text-muted">Zonas</h6>
                        <div class="">
                            <i class="mdi mdi-cloud-download-outline md-48"></i>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-lg-3 pt-3">
    <a href="<?php echo TEMPLATES_PATH; ?>templates_streets.zip">
            <div class="card shadow-md">
                <div class="contact-box">
                    <div class="card-body text-center">
                        <h4 class="card-title">Plantilla</h4>
                        <h6 class="card-subtitle text-muted">Manzanas</h6>
                        <div class="">
                            <i class="mdi mdi-cloud-download-outline md-48"></i>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modal_help" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="exampleModalCenterTitle">¿Como importar?</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>El sistema tiene una función de importar en xlsx, xls y csv.</p>
                <p>Para poder importar desde excel, necesitas descargar las plantillas que se adjuntan en está página.</p>
                <p>Los datos a importar necesitan estar bien alineados, tal y como están definidos en la plantilla.</p>
                <img src="<?php echo IMG_PATH ?>media/help_imp.png" class="img-fluid ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|}" alt="">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-rounded" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>