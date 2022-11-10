
<div class="row mt-5">
    <div class="col-lg-4">
        <div class="card">
            <img src="https://images.unsplash.com/photo-1561154464-82e9adf32764?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=800&q=60" style="height: 200px; object-fit: cover; filter: blur(4px);">
            <div class="card-body">
                <h5 class="card-title">Asignación de Trabajo</h5>
                <h6 class="card-subtitle mb-2 text-muted ">Rellene el formulario tal y como se pide para asignar trabajo a coordinadores.<br />
                    <hr />
                    Las asignaciones no se podrán editar, solamente se podrán terminar o borrar.
                    Verifique bien los datos antes de dar en el botón <b>Asignar</b>
                </h6>
                <div class="row">
                    <div class="col-lg-4">
                        <select class="form-control selectpicker border" id="type">
                            <option value="">Seleccione el tipo de trabajo</option>
                            <option value="DISTRITO">Distrito</option>
                            <option value="ZONA">Zona</option>
                        </select>
                    </div>
                    <div class="col-lg-4">
                        <select class="form-control selectpicker border" id="id_asignado" data-live-search="true" disabled>
                            <option value="">Seleccione una opción</option>
                        </select>
                    </div>
                    <div class="col-lg-4">
                        <select class="form-control selectpicker border" id="uid_coordinador" data-live-search="true">
                            <option value="">Seleccione el coordinador</option>
                            <?php
                            foreach ($this->coordinadores as $k => $d) {
                                echo "<option value='" . $d->dni . "' >" . $d->dni . ' - ' . $d->first_name . ' ' . $d->last_name . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-lg-6 offset-lg-3 mt-3">
                        <button class="btn btn-success col-12" id="assign">Asignar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-8">
        <div class="card">
            <img class="card-img-top" src="<?php echo IMG_PATH ?>card-img/head-img/header.jpg" alt="Header" style="filter: blur(8px);   -webkit-filter: blur(8px); height: 200px; object-fit: cover;" />
            <div class="card-body">
                <div class="row text-center m-t-0 p-l-10 p-r-10 mb-4">
                    <div class="col-12 m-t-20">
                        <h3 class="m-b-0 font-normal metas-count"></h3>
                        <h6 class="font-bold m-b-10">Asignaciones</h6>
                    </div>
                </div>
                <h4 class="card-title text-center">Gestión de Asignaciones</h4>
                <p class="card-text text-center">Visualiza las asignaciones a zonas o distritos a los coordinadores.</p>
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
                        <span id="pdf_btn"></span>
                        <span id="excel_btn"></span>
                    </div>
                </div>
                <div class="table-responsive m-b-10">
                    <table id="table" class="table table-condensed table-hover stylish-table" cellspacing="0" width="100%">
                        <thead class="table-head">
                            <th style="width: 15%;">Fecha Inicio</th>
                            <th style="width: 15%;">Fecha Final</th>
                            <th style="width: 10%;">Tipo Asignacion</th>
                            <th style="width: 10%;">Detalle</th>
                            <th style="width:15%;">Coordinador</th>
                            <th style="width: 5%;">Meta</th>
                            <th style="width: 5%;">Restante</th>
                            <th style="width: 30%;">Progreso</th>
                            <th style="width: 15%;">Opciones</th>
                        </thead>
                        <tbody class="tb-st">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>