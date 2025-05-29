    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form method="post" action="crearColaborador.php">
                    <div data-mdb-input-init class="form-outline mb-4">
                        <input type="email" name="correo" class="form-control" />
                        <label class="form-label">correo</label>
                    </div>
                    <div data-mdb-input-init class="form-outline mb-4">
                        <input type="text" name="clave" class="form-control" />
                        <label class="form-label">Clave</label>
                    </div>
                    <div data-mdb-input-init class="form-outline mb-4">
                        <input type="text" name="nombre" class="form-control" />
                        <label class="form-label">nombre</label>
                    </div>
                    <div data-mdb-input-init class="form-outline mb-4">
                        <input type="text" name="tipo_residuo" class="form-control" />
                        <label class="form-label">tipo de residuo</label>
                    </div>
                    <div data-mdb-input-init class="form-outline mb-4">
                        <input type="text" name="servicio_ofrecido" class="form-control" />
                        <label class="form-label">servicio ofrecido</label>
                    </div>
                    <!-- Submit button -->
                    <button type="submit" data-mdb-button-init data-mdb-ripple-init
                        class="btn btn-primary btn-block mb-4" name="registrar">Registrarse</button>
                </form>
            </div>
        </div>
    </div>