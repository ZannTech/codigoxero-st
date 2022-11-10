<div class="row">

    <div class="col-lg-6 offset-lg-3">
        <div class="alert alert-danger" role="alert">
            <strong>Si no cambiarás la contraseña, no escribas nada en el campo contraseña</strong>
        </div>
        <div class="card">
            <img src="https://images.unsplash.com/photo-1511367461989-f85a21fda167?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1631&q=80" style="height: 200px; object-fit: cover; filter: blur(5px);" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">Edita tu perfil</h5>
                <h6 class="card-subtitle mb-2 text-muted ">Cambia los datos de tu perfil</h6>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="">Nombre de la cuenta</label>
                            <input type="text" class="form-control" value="<?php echo $this->data->description ?>" name="" id="nombre" aria-describedby="helpId" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="">Usuario</label>
                            <input type="text" class="form-control" value="<?php echo $this->data->user ?>" name="" id="usuario" aria-describedby="helpId" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="">Contraseña</label>
                            <input type="password" class="form-control" value="<?php echo $this->data->password ?>" name="" id="pwd" aria-describedby="helpId" placeholder="">
                        </div>
                        <button name="" id="submit" class="btn btn-primary btn-block" role="button">Actualizar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>