
<div class="row pt-4">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="row text-center m-t-0 p-l-10 p-r-10 mb-4">
                    <div class="col-12 m-t-20">
                        <h3 class="m-b-0 font-normal metas-count" style="font-size: 30px;"></h3>
                        <h6 class="font-bold m-b-10">Metas Registradas</h6>
                    </div>
                </div>
                <h4 class="card-title text-center">Gestión de Metas</h4>
                <p class="card-text text-center">Asigna, modifica las metas que tiene cada coordinador.</p>
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
                        <button type="button" onclick="crud_meta()" class="btn btn-info btn-rounded col-auto mr-4" data-mdb-ripple-color="dark" title="Agrega Nuevo Distrito"><i class="mdi mdi-plus"></i></button>
                        <span id="pdf_btn"></span>
                        <span id="excel_btn"></span>
                    </div>
                </div>
                <div class="table-responsive m-b-10">
                    <table id="table" class="table table-condensed table-hover stylish-table" cellspacing="0" width="100%">
                        <thead class="table-head">
                            <th style="width: 15%;">Fecha Inicio</th>
                            <th style="width: 15%;">Fecha Final</th>
                            <th style="width: 10%;">Tipo Asignado</th>
                            <th style="width: 15%;">Area Asignada</th>
                            <th style="width: 10%;">Coordinador</th>
                            <th style="width: 5%;">Meta</th>
                            <th style="width: 5%;">Registrados</th>
                            <th style="width: 5%;">Restante</th>
                            <th style="width: 35%;">Progreso</th>
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
                <h4 class="modal-title title_modal lead text-center">-</h4>
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="" id="id_meta">
                <div class="form-group frm_coord">
                    <label for="id_assign">Asignación</label>
                    <select class="form-control border selectpicker" data-live-search="true" id="id_assign">
                        <option value="">Selecciona una Asignación</option>
                        <?php 
                            
                                foreach($this->asignaciones as $k => $d){
                                    if(count($this->asignaciones) > 0 && $d != false){
                                    ?>
                                        <option value="<?php echo $d->id_asignacion ?>"><?php echo $d->detalle->description . ' | ' . $d->coordinador->first_name . ' ' . $d->coordinador->last_name ?></option>
                                    <?php
                                    }
                                    
                                }
                            
                        ?>
                    </select>
                </div>
                <div class="form-group">
                  <label for="cant">Cantidad Propuesta</label>
                  <input type="text"
                    class="form-control" id="cant" aria-describedby="helpId" placeholder="Cantidad Meta">
                  <small id="helpId" class="form-text text-muted">Cantidad Propuesta</small>
                </div>
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-success btn-guardar">Aceptar</button>
            </div>
        </div>
    </div>
</div>