<div class="row mt-3">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Informe</h4>
                <p class="card-text">Exportar lista de usuarios por distrito</p>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="id_district">Distrito (*)</label>
                            <select class="form-control selectpicker border" id="id_district" data-live-search="true">
                                <option value="">Selecciona un Distrito para el informe</option>
                                <?php
                                    foreach ($this->distritos as $k => $d) {
                                        ?>
                                            <option value="<?php echo $d->id_district ?>"><?php echo $d->description ?></option>
                                        <?php
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-6">
                        <div class="form-group">
                            <label>Fecha (*)</label>
                            <input class="form-control" type="text" name="daterange" value="" readonly />

                        </div>
                    </div>
                    <div class="col-6"></div>
                    <div class="col-md-3">
                        <button class="btn btn-danger btn-rounded send-message export-pdf">Exportar PDF</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>