<div class="row pt-4">
    <div class="col-lg-12">
        <div class="card">
            <img class="card-img-top" src="<?php echo IMG_PATH ?>card-img/head-img/personas.jpg" alt="Personas" style="filter: blur(8px);   -webkit-filter: blur(8px); height: 200px; object-fit: cover;" />
            <div class="card-body">
                <div class="row text-center m-t-0 p-l-10 p-r-10 mb-4">
                    <div class="col-12 m-t-20">
                        <h3 class="m-b-0 font-normal usuarios-count"></h3>
                        <h6 class="font-bold m-b-10">Personas Registradas</h6>
                    </div>
                </div>
                <h4 class="card-title text-center">Gestión de Personas</h4>
                <p class="card-text text-center">Visualiza las personas que se han agregado.</p>
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
                        <span id="pdf_btn"></span>
                        <span id="excel_btn"></span>
                    </div>
                </div>
                <div class="table-responsive m-b-10">
                    <table id="table" class="table table-condensed table-hover stylish-table" cellspacing="0" width="100%">
                        <thead class="table-head">
                            <th style="width: 10%;">Fecha Registro</th>
                            <th style="width: 5%;">Tipo</th>
                            <th style="width: 15%;">Nombre</th>
                            <th style="width: 10%;">DNI</th>
                            <th style="width: 15%;">Distrito</th>
                            <th style="width: 15%;">Zona</th>
                            <th style="width: 15%;">Manzana</th>
                            <th style="width: 15%;">Ubicación</th>
                            <th style="width: 10%;">Correo</th>
                        </thead>
                        <tbody class="tb-st">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

