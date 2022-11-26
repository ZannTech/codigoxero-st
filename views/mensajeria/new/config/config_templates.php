<div class="row pt--50">
    <div class="col-lg-6">
        <div class="card shadow-xl">
            <div class="card-body">
                <h4 class="card-title">Plantillas Registradas</h4>
                <p class="card-text">Lista de las plantillas generadas y aceptadas por &reg; Meta Inc</p>
                <div class="row mt-2 mb-5">
                    <div class="col-lg-3">
                        <button type="button" onclick="crud({
                            method: 'new',
                        })" class="btn btn-primary"><i class="mdi mdi-plus"></i>
                            Nuevo</button>
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="table" class="table table-hover" style="width: 100%;">
                        <thead class="thead-inverse">
                            <tr>
                                <th>Nombre</th>
                                <th>Fecha Registro</th>
                                <th>Estado</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6" style="height: 800px;">
        <div class="page nexus6">
            <div class="phone">
                <div class="wa-container">
                    <div class="status-bar">
                        <div class="time">

                        </div>
                        <div class="battery">
                            <i class="zmdi zmdi-battery"></i>
                        </div>
                        <div class="network">
                            <i class="zmdi zmdi-network"></i>
                        </div>
                        <div class="wifi">
                            <i class="zmdi zmdi-wifi-alt-2"></i>
                        </div>
                        <div class="star">
                            <i class="zmdi zmdi-star"></i>
                        </div>
                    </div>
                    <div class="wrapperchat">
                        <div class="chat-root">
                            <div class="user-bar">
                                <div class="back">
                                    <i class="zmdi zmdi-arrow-left"></i>
                                </div>
                                <!-- user info start -->
                                <div class="user">
                                    <img src="<?php echo URL ?>public/codigoxero.jpg" alt="user" />
                                </div>
                                <div class="user-name">
                                    <b>CodigoXero</b>
                                    <span>online now</span>
                                </div>
                                <!-- user info end -->
                                <div class="actions more">
                                    <i class="zmdi zmdi-more-vert"></i>
                                </div>
                                <div class="actions attachment">
                                    <i class="zmdi zmdi-attachment-alt"></i>
                                </div>
                                <div class="actions">
                                    <i class="zmdi zmdi-phone"></i>
                                </div>
                            </div>
                            <div class="chat-window">
                                <!-- conversation start -->
                                <div class="conversation">


                                    <!--  -->
                                </div>
                                <!-- conversation end -->
                                <div class="textarea">
                                    <div class="emoticons"></div>
                                    <textarea class="message" name="message" placeholder="Type a message"></textarea>
                                    <div class="photo">
                                        <i class="zmdi zmdi-camera"></i>
                                    </div>
                                    <div class="send-mic">
                                        <div class="circle-cont">
                                            <i class="mdi mdi-microphone"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bottom-bar">
                        <div class="triangle">
                            <i class="zmdi zmdi-triangle-up"></i>
                        </div>
                        <div>
                            <i class="zmdi zmdi-circle-o"></i>
                        </div>
                        <div>
                            <i class="zmdi zmdi-square-o"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="modal_plantilla" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <input type="hidden" id="id_plantilla">
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="">Nombre de la plantilla</label>
                                <input type="text" class="form-control" id="nombre" aria-describedby="helpId"
                                    placeholder="">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Cuerpo del mensaje</label>
                                <textarea class="form-control" id="body" rows="10"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" onclick="sendAjax()">Guardar</button>
            </div>
        </div>
    </div>
</div>