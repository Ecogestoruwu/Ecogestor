    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form method="post" action="cambiarClave.php">
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
                        <div class="col">
                            <!-- Simple link -->
                            <a href="/puntos-reciclaje/index.php">inicioSesion</a>
                        </div>
                        <div class="col">
                            <!-- Simple link -->
                            <a href="/puntos-reciclaje/vista/Usuario/registroCuenta/registrarse.php">Registrarme como usuario</a>
                        </div>
                        <div class="col">
                            <!-- Simple link -->
                            <a href="/puntos-reciclaje/vista/Colaborador/registroCuenta.php">Registrarme como colaborador</a>
                        </div>
                    </div>

                    <!-- Submit button -->
                    <button type="submit" data-mdb-button-init data-mdb-ripple-init
                        class="btn btn-primary btn-block mb-4" name="cambioClave">cambiar clave</button>
                </form>
            </div>
        </div>
    </div>