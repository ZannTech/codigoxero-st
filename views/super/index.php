<div class="row pt-4">
    <div class="col-lg-12">
        <div class="card">
            <img class="card-img-top" src="<?php echo IMG_PATH ?>card-img/head-img/header.jpg" alt="Header" style="filter: blur(8px);   -webkit-filter: blur(8px); height: 200px; object-fit: cover;" />
            <div class="card-body">
                <div class="row text-center m-t-0 p-l-10 p-r-10 mb-4">
                    <div class="col-12 m-t-20">
                        <h3 class="m-b-0 font-normal metas-count"></h3>
                        <h6 class="font-bold m-b-10">Usuarios Registrados</h6>
                    </div>
                </div>
                <h4 class="card-title text-center">Gestión de Super Usuarios</h4>
                <p class="card-text text-center">Agrega, modifica los usuarios que puedan administrar el sistema.</p>
                <div class="row">
                    <div class="col-lg-10">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-search-web"></i></span>
                            </div>
                            <input class="form-control global_filter" placeholder="Buscar..." aria-label="Busqueda" aria-describedby="Busqueda">
                        </div>
                    </div>
                    <div class="col-sm-12 col-lg-2 mb-4 text-center">
                        <button type="button" onclick="crud_super()" class="btn btn-info btn-rounded col-auto mr-4" data-mdb-ripple-color="dark" title="Agrega Nuevo Distrito"><i class="mdi mdi-plus"></i></button>
                        <span id="pdf_btn"></span>
                        <span id="excel_btn"></span>
                    </div>
                </div>
                <div class="table-responsive m-b-10">
                    <table id="table" class="table table-condensed table-hover stylish-table" cellspacing="0" width="100%">
                        <thead class="table-head">
                            <th style="width: 7%;">Fecha Registro</th>
                            <th style="width: 7%;">Fecha Actualizado</th>
                            <th style="width: 10%;">Nombre</th>
                            <th style="width: 10%;">Usuario</th>
                            <th style="width: 10%;">Estado</th>
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


<div class="modal inmodal" id="modal" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <h4 class="modal-title title_modal lead text-center"></h4>
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
            </div>
            <div class="modal-body">
                <div class="row floating-labels m-t-40">
                    <input type="hidden" name="" id="id_super">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="desc">Descripción</label>
                            <input type="text" id="desc" class="form-control" placeholder="Descripción">
                        </div>
                        <div class="form-group">
                            <label for="coordinador">Usuario</label>
                            <input type="text" class="form-control" id="usuario" placeholder="Usuario">
                        </div>
                        <div class="form-group">
                            <label for="coordinador">Contraseña</label>
                            <input type="password" class="form-control" id="pwd" placeholder="*********">
                        </div>
                        <div class="col-lg-12 pb-2">
                            <label for="user_state">Estado</label>
                            <select aria-describedby="help_state" id="user_state" class="form-control selectpicker border" data-live-search="true">
                                <option value="">Selecciona una opción</option>
                                <option value="01">Activo</option>
                                <option value="02">Desactivado</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-success btn-guardar">Aceptar</button>
            </div>
        </div>
    </div>
</div>