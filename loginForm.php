<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form method="post" action="validacionRol.php">
                <!-- Email input -->
                <div data-mdb-input-init class="form-outline mb-4">
                    <input type="email" name="correo" class="form-control" />
                    <label class="form-label">correo</label>
                </div>

                <!-- Password input -->
                <div data-mdb-input-init class="form-outline mb-4">
                    <input type="password" name="clave" class="form-control" />
                    <label class="form-label">clave</label>
                </div>

                <!-- 2 column grid layout for inline styling -->
                <div class="row mb-4">
                    <div class="col d-flex justify-content-center">
                        <!-- Checkbox -->
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="form2Example31" checked />
                            <label class="form-check-label" for="form2Example31"> Remember me </label>
                        </div>
                    </div>

                    <div class="col">
                        <!-- Simple link -->
                        <a href="vista/cambioClave/CambioClave.php">Forgot password?</a>
                    </div>
                    <div class="col">
                        <!-- Simple link -->
                        <a href="vista/Usuario/registroCuenta/registrarse.php">Registrarme como usuario</a>
                    </div>
                    <div class="col">
                        <!-- Simple link -->
                        <a href="vista/Colaborador/registroCuenta/registrarse.php">Registrarme como colaborador</a>
                    </div>
                </div>

                <!-- Submit button -->
                <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-block mb-4"
                    name="inicioSesion">Sign in</button>
            </form>
        </div>
    </div>
</div>