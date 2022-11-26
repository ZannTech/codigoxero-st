<div class="row pt-4">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="row text-center m-t-0 p-l-10 p-r-10 mb-4">
                    <div class="col-12 m-t-20">
                        <h3 class="m-b-0 font-normal usuarios-count " style="font-size: 30px;"></h3>
                        <h6 class="font-bold m-b-10">Personas Registradas</h6>
                    </div>
                </div>
                <h4 class="card-title text-center">Gestión de Usuarios</h4>
                <p class="card-text text-center">Administra los usuarios que se han agregado.</p>
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
                        <button type="button" onclick="crud_usuarios()" class="btn btn-info btn-rounded col-auto mr-4" data-mdb-ripple-color="dark" title="Agrega Nuevo Distrito"><i class="mdi mdi-plus"></i></button>
                        <span id="pdf_btn"></span>
                        <span id="excel_btn"></span>
                    </div>
                </div>
                <div class="table-responsive m-b-10">
                    <table id="table" class="table table-condensed table-hover stylish-table" cellspacing="0" width="100%">
                        <thead class="table-head">
                            <th style="width: 10%;">Fecha Registro</th>
                            <th style="width: 20%;">Nombre</th>
                            <th style="width: 20%;">Tipo Usuario</th>
                            <th style="width: 15%;">DNI</th>
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
    <div class="modal-dialog modal-lg">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <h4 class="modal-title title_modal lead text-center"></h4>
                <button type="button" class="close" data-bs-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
            </div>
            <div class="modal-body">
                <div class="row floating-labels m-t-40">
                    <input type="hidden" id="user_id">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="id_type">Tipo de usuario (*)</label>
                            <select id="id_type" class="form-control selectpicker border" data-live-search="true">
                                <option value="">[Seleccione]</option>
                                <?php
                                foreach ($this->user_type as $c => $d) {
                                ?>
                                    <option value="<?php echo $d->id_typeuser; ?>"><?php echo $d->description; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                            <small class="form-text text-muted">Seleccione el tipo de usuario</small>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="dni">DNI / No.Doc (*)</label>
                            <input type="text" class="form-control" maxlength="8" id="dni" placeholder="xxxxxxxx">
                            <small class="form-text text-muted">Ingresa el Número de identificación de la persona</small>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="password">Contraseña (*)</label>
                            <input type="text" class="form-control" id="password" placeholder="*********" maxlength="12">
                            <small class="form-text text-muted">Ingresa la contraseña</small>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="first_name">Nombre(s) (*)</label>
                            <input type="text" class="form-control" id="first_name" placeholder="Nombre" maxlength="15">
                            <small class="form-text text-muted">Ingresa el/los nombre(s) del usuario</small>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="last_name">Apellido(s) (*)</label>
                            <input type="text" class="form-control" id="last_name" placeholder="Apellidos" maxlength="30">
                            <small class="form-text text-muted">Ingresa el/los apellido(s) del usuario</small>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="date_of_birth">Fecha de Nacimiento (*)</label>
                            <input type="date" class="form-control" id="date_of_birth">
                            <small class="form-text text-muted">Ingresa la fecha de nacimiento</small>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group mb-2">
                            <label for="id_district">Distrito (*)</label>
                            <select id="id_district" class="form-control selectpicker border" data-live-search="true">
                                <option value="">[Seleccione]</option>
                                <?php
                                foreach ($this->zones->distritos as $c => $d) {
                                ?>
                                    <option value="<?php echo $d->id_district; ?>"><?php echo $d->description; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group mb-2">
                            <label for="id_zone">Zona (*)</label>
                            <select id="id_zone" disabled class="form-control selectpicker border" data-live-search="true">
                                <option value="">[Seleccione]</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group mb-2">
                            <label for="id_street">Manzana (*)</label>
                            <select id="id_street" disabled class="form-control selectpicker border" data-live-search="true">
                                <option value="">[Seleccione]</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group mb-2">
                            <label for="id_genre">Género (*)</label>
                            <select id="id_genre" class="form-control selectpicker border" data-live-search="true">
                                <option value="">[Seleccione]</option>
                                <?php
                                foreach ($this->genres as $c => $d) {
                                ?>
                                    <option value="<?php echo $d->id_sex; ?>"><?php echo $d->description; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="address">Dirección (*)</label>
                            <input type="text" class="form-control" id="address">
                            <small class="form-text text-muted">Ingresa la fecha de nacimiento</small>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <label for="short_phone">Teléfono (*)</label>
                        <div class="form-group form-inline">
                            <div class="form-group mb-2 col-3">
                                <select id="lada_phone" class="form-control selectpicker border" data-live-search="true">
                                    <?php
                                    foreach ($this->countries as $c => $d) {
                                        if ($d->phonecode == '52') {
                                    ?>
                                            <option value="<?php echo '+' . $d->phonecode . '1'; ?>" selected><?php echo '+' . $d->phonecode . ' ' . $d->iso; ?></option>
                                        <?php
                                        } else {
                                        ?>
                                            <option value="<?php echo '+' . $d->phonecode; ?>"><?php echo '+' . $d->phonecode . ' ' . $d->iso; ?></option>
                                    <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group mb-2 col-9">
                                <input type="text" class="form-control col-12" id="short_phone">
                            </div>
                            <small class="form-text text-muted">Ingresa el número de teléfono</small>
                        </div>
                    </div>

                </div>
                <div class="row floating-labels m-t-40">
                    <div class="col-lg-4 pb-2">
                        <label class="sr-only" for="social_whatsapp">Whatsapp</label>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="" id="social_whatsapp" value="" checked>
                                Tiene WhatsApp
                            </label>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <label class="sr-only" for="social_facebook">Facebook</label>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="mdi mdi-facebook"></i></div>
                            </div>
                            <input type="text" class="form-control" id="social_facebook" placeholder="Facebook">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <label class="sr-only" for="social_twitter">Twitter</label>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="mdi mdi-twitter"></i></div>
                            </div>
                            <input type="text" class="form-control" id="social_twitter" placeholder="Twitter">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <label class="sr-only" for="social_instagram">Instagram</label>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="mdi mdi-instagram"></i></div>
                            </div>
                            <input type="text" class="form-control" id="social_instagram" placeholder="Instagram">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <label class="sr-only" for="social_tiktok">Tiktok</label>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fab fa-tiktok"></i></div>
                            </div>
                            <input type="text" class="form-control" id="social_tiktok" placeholder="Tiktok">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <label class="sr-only" for="social_twitch">Twitch</label>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="mdi mdi-twitch"></i></div>
                            </div>
                            <input type="text" class="form-control" id="social_twitch" placeholder="Twitch">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <label for="email">Correo Electrónico (*)</label>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="mdi mdi-email"></i></div>
                            </div>
                            <input type="email" class="form-control" id="email" placeholder="alguien@example.com">
                        </div>
                    </div>
                    <div class="col-lg-6 metas">
                        <label for="type metas">Tipo Trabajo (*)</label>
                        <select class="form-control selectpicker border" id="type">
                            <option value="">Seleccione el tipo de trabajo</option>
                            <option value="DISTRITO">Distrito</option>
                            <option value="ZONA">Zona</option>
                        </select>
                    </div>
                    <div class="col-lg-6 mt-2 metas">
                        <label for="id_asignado">Area (*)</label>
                        <select class="form-control selectpicker border" id="id_asignado" data-live-search="true" disabled>
                            <option value="">Seleccione una opción</option>
                        </select>
                    </div>
                    <div class="col-lg-6 mt-2 metas">
                        <label for="meta">Meta propuesta (*)</label>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="mdi mdi-flag-checkered"></i></div>
                            </div>
                            <input type="number" min="0" max="9999999" class="form-control" id="meta" placeholder="Meta propuesta">
                        </div>
                    </div>

                    <div class="col-lg-12 pt-4">
                        <div id="map" class="map"></div>
                        <small class="mt-2 help_map">Está es una ubicación aproximada, puede que tenga alguna distinción de la ubicación.</small>
                    </div>
                </div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-success btn-guardar">Aceptar</button>
            </div>
        </div>
    </div>