<div class="row pt-4">
    <div class="col-lg-12">
        <div class="card">
            <img class="card-img-top" src="<?php echo IMG_PATH ?>card-img/head-img/files.jpeg" alt="Archivos" style="filter: blur(8px);   -webkit-filter: blur(8px); height: 200px; object-fit: cover;" />
            <div class="card-body">
                <div class="row text-center m-t-0 p-l-10 p-r-10 mb-4">
                    <div class="col-12 m-t-20">
                        <h3 class="m-b-0 font-normal msj-c"></h3>
                        <h6 class="font-bold m-b-10">Archivos Registrados</h6>
                    </div>
                </div>
                <h4 class="card-title text-center">Archivos</h4>
                <p class="card-text text-center">Administra los archivos para envio de mensajes</p>
                <div class="row">
                    <div class="col-lg-10">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-search-web"></i></span>
                            </div>
                            <input  class="form-control global_filter" placeholder="Buscar..." aria-label="Busqueda" aria-describedby="Busqueda">
                        </div>
                    </div>
                    <div class="col-sm-12 col-lg-2 mb-4 text-center">
                        <button  title="Subir Archivo" class="btn btn-outline-success col-12 p-3 btn-rounded upload_btn"><i class="mdi mdi-upload"></i></button>
                    </div>
                </div>
                <div class="table-responsive m-b-10">
                    <table id="table" class="table table-condensed table-hover stylish-table" cellspacing="0" width="100%">
                        <thead class="table-head">
                            <th style="width: 15%;">Fecha Subida</th>
                            <th style="width: 15%;">Nombre Archivo</th>
                            <th style="width: 5%;">Tipo Archivo</th>
                            <th style="width: 15%;">Ruta</th>
                            <th style="width: 5%;">Ver</th>
                            <th style="width: 5%;">Opciones</th>
                        </thead>
                        <tbody class="tb-st">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="modal inmodal" id="modal_files" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content animated bounceInRight">
                <div class="modal-header">
                    <h4 class="modal-title lead">Subir Archivos</h4>
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="card bg-white">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-8 offset-2 text-center">
                                            <img class="img-fluid text-center" src="<?php echo IMG_PATH ?>icon/apps/security.png" alt="excel icon" style="max-width: 50%; text-align: center;">
                                        </div>
                                        <div class="col-12 text-center mt-2 mb-2">
                                            <p class="lead">Selecciona un archivo para subir.</p>
                                        </div>
                                        <div class="col-12 text-center mt-2 mb-2">
                                            <form class="dropzone" id="frm_file">
                                                <div class="fallback" style="width: 100%;">
                                                    <input name="file" type="file"/>
                                                </div>
                                            </form>
                                        </div>
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