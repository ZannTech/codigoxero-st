<div class="row pt-4">
    <div class="col-lg-12">
        <div class="card shadow-2xl">
            <div class="card-body">
                <div class="row text-center m-t-0 p-l-10 p-r-10 mb-4">
                    <div class="col-12 m-t-20">
                        <h3 class="m-b-0 font-normal manzanas-count" style="font-size: 30px;"></h3>
                        <h6 class="font-bold m-b-10">Manzanas Registradas</h6>
                    </div>
                </div>
                <h4 class="card-title text-center">Gestión de Manzanas</h4>
                <p class="card-text text-center">Gestiona los Manzanas agregadas o agrega nuevas manzanas para su uso práctico.</p>
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
                        <button type="button" onclick="crud_manzana()" class="btn btn-info btn-rounded col-auto mr-4" data-mdb-ripple-color="dark" title="Agrega Nuevo Distrito"><i class="mdi mdi-plus"></i></button>
                        <span id="pdf_btn"></span>
                        <span id="excel_btn"></span>
                        <button type="button" class="btn btn-success btn-rounded col-auto mr-4 mt-sm-2 excel_btn" data-mdb-ripple-color="dark" title="Agrega Nuevo Distrito"><i class="mdi mdi-file-excel-outline"></i> Importar</button>

                    </div>

                </div>
                <div class="table-responsive m-b-10">
                    <table id="table" class="table table-condensed table-hover stylish-table" cellspacing="0" width="100%">
                        <thead class="table-head">
                            <th style="width: 10%;">Fecha Registro</th>
                            <th style="width: 10%;">Ultima Actualización</th>
                            <th style="width: 15%;">Nombre</th>
                            <th style="width: 15%;">Distrito</th>
                            <th style="width: 15%;">Zona</th>
                            <th style="width: 10%;">Coordinador</th>
                            <th style="width: 5%;">Estado</th>
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


<div class="modal inmodal" id="modal" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <h4 class="modal-title title_street lead text-center"></h4>
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
            </div>
            <div class="modal-body">
                <div class="row floating-labels m-t-40">
                    <input type="hidden" id="street_id" value="">
                    <div class="col-lg-12 pb-2">
                        <label for="id_district">Distrito</label>
                        <select aria-describedby="help_customer" id="id_district" class="form-control selectpicker border" data-live-search="true">
                            <option value="">Selecciona una opción</option>
                            <?php foreach ($this->distritos as $k => $d) : ?>
                                <option value="<?php echo $d->id_district ?>"> <?php echo strtoupper($d->description) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-lg-12 pb-2">
                        <label for="id_zone">Zona</label>
                        <select aria-describedby="id_zone" id="id_zone" class="form-control selectpicker border" data-live-search="true">
                            <option value="">Selecciona una opción</option>

                        </select>
                    </div>
                    <div class="col-lg-12 pb-2">
                        <div class="form-group">
                            <label for="street_name">Nombre</label>
                            <input type="text" id="street_name" class="form-control" placeholder="Nombre de distrito" aria-describedby="help_name">
                        </div>
                    </div>
                    <div class="col-lg-12 pb-2">
                        <label for="street_state">Estado</label>
                        <select aria-describedby="help_state" id="street_state" class="form-control selectpicker border" data-live-search="true">
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