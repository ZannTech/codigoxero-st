<div class="row pt-4">
    <div class="col-lg-9">
        <div class="card shadow-2xl">
            <div class="card-body">
                <div class="row text-center m-t-0 p-l-10 p-r-10 mb-4">
                    <div class="col-12 m-t-20">
                        <h3 class="m-b-0 font-normal distritos-count" style="font-size: 30px;"></h3>
                        <h6 class="font-bold m-b-10">Distritos Agregados</h6>
                    </div>
                </div>
                <h4 class="card-title text-center">Gestión de Distritos</h4>
                <p class="card-text text-center">Gestiona los distritos agregados o agrega nuevos distritos para su uso práctico.</p>
                <div class="row">
                    <div class="col-lg-9">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-search-web"></i></span>
                            </div>
                            <input type="text" class="form-control global_filter" placeholder="Buscar..." aria-label="Busqueda" aria-describedby="Busqueda">
                        </div>
                    </div>
                    <div class="col-sm-12 col-lg-3 mb-4 text-center">
                        <button type="button" onclick="crud_district()" class="btn btn-info btn-rounded col-auto mr-4" data-mdb-ripple-color="dark" title="Agrega Nuevo Distrito"><i class="mdi mdi-plus"></i></button>
                        <span id="pdf_btn"></span>
                        <span id="excel_btn"></span>

                        <button type="button" class="btn btn-success btn-rounded col-auto mr-4 mt-sm-2 excel_btn" data-mdb-ripple-color="dark" title="Agrega Nuevo Distrito"><i class="mdi mdi-file-excel-outline"></i> Importar</button>

                    </div>

                    <div class="table-responsive m-b-10">
                        <table id="table" class="table table-condensed table-hover stylish-table" cellspacing="0" width="100%">
                            <thead class="table-head">
                                <th style="width: 20%;">Fecha Registro</th>
                                <th style="width: 20%;">Ultima Actualización</th>
                                <th style="width: 25%;">Nombre</th>
                                <th style="width: 20%;">Coordinador</th>
                                <th style="width: 10%;">Estado</th>
                                <th style="width: 5%; text-align: right;">Opciones</th>
                            </thead>
                            <tbody class="tb-st">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title h1 text-center">¿Qué es?</h4>
                <div class="alert alert-success" role="alert">
                    <strong>La gestión de distritos se basa en que puedas registrar a tus usuarios en un distrito, el app movil pueda categorizar dependiendo de la localidad del usuario, es necesario tener registrado un distrito ya que en cierta parte es la rama padre de la gestión.</strong>
                </div>
                <h4 class="card-title h1 text-center">¿Qué hacer?</h4>
                <div class="alert alert-warning" role="alert">
                    <strong>Para registrar un distrito necesitas el nombre y el estado en el que lo necesitas.<br/>Un ejemplo registras el Distrito aguirre y le asignas el estado inactivo; este no se mostrará como disponible.</strong>
                </div>
                <h4 class="card-title h1 text-center">¿Y esos botones?</h4>
                <div class="alert alert-info" role="alert">
                    <strong>Los botones en cierta parten hace alguna operación en especifico, agregan, exportan, importan, etc. <br/>Anda!, navega sobre ellos.</strong>
                </div>
            </div>
        </div>
    </div>
    <div class="modal inmodal" id="modal" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content animated bounceInRight">
                <form id="form" method="post">
                    <div class="modal-header">
                        <h4 class="modal-title title_district lead text-center"></h4>
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row floating-labels m-t-40">
                            <input type="hidden" id="id_distrito" value="">
                            <div class="col-lg-12 pb-2">
                                <div class="form-group">
                                    <label for="district_name">Nombre</label>
                                    <input type="text" id="district_name" class="form-control" placeholder="Nombre de distrito" aria-describedby="help_name">
                                </div>
                            </div>
                            <div class="col-lg-12 pb-2">
                                <label for="district_state">Estado</label>
                                <select aria-describedby="help_state" id="district_state" class="form-control selectpicker border" data-live-search="true">
                                    <option value="">Selecciona una opción</option>
                                    <option value="01">Activo</option>
                                    <option value="02">Desactivado</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-success btn-guardar">Aceptar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal inmodal" id="modal_excel" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content animated bounceInRight">
                <div class="modal-header">
                    <h4 class="modal-title lead">Importar desde excel</h4>
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="card bg-white">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-8 offset-2 text-center">
                                            <img class="img-fluid text-center" src="<?php echo IMG_PATH ?>icon/apps/excel.png" alt="excel icon" style="max-width: 50%; text-align: center;">
                                        </div>
                                        <div class="col-12 text-center mt-2 mb-2">
                                            <p class="lead">Selecciona un archivo, ya sea .xlsx o .csv</p>
                                        </div>

                                        <div class="col-12 text-center mt-2 mb-2">
                                            <form class="dropzone" id="frm_excel">
                                                <div class="fallback" style="width: 100%;">
                                                    <input name="file" type="file" multiple />
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
                    <button type="button" class="btn btn-secondary btn-rounded" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success check_excel btn-rounded import" disabled>Importar</button>
                </div>
            </div>
        </div>
    </div>