<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2 class="mb-4 text-center">Cambiar Contraseña</h2>
            <?php
            // Display messages if any (e.g., if redirected back to this form on error)
            // Ensure session_start() is called in the parent file (cambioClave.php)
            if (isset($_SESSION['message']) && isset($_SESSION['message_type'])) {
                echo "<div class='alert alert-" . htmlspecialchars($_SESSION['message_type']) . " alert-dismissible fade show' role='alert'>";
                echo htmlspecialchars($_SESSION['message']);
                echo "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>";
                echo "</div>";
                unset($_SESSION['message']);
                unset($_SESSION['message_type']);
            }
            ?>
            <form method="post" action="cambiarClave.php"> <div class="form-outline mb-4">
                    <label class="form-label" for="changeCorreo">Correo Electrónico</label>
                    <input type="email" id="changeCorreo" name="correo" class="form-control" placeholder="tu@correo.com" required />
                </div>

                <div class="form-outline mb-4">
                    <label class="form-label" for="changeClave">Nueva Contraseña</label>
                    <input type="password" id="changeClave" name="clave" class="form-control" placeholder="Ingresa tu nueva contraseña" required />
                </div>
                
                <div class="form-outline mb-4">
                    <label class="form-label" for="confirmClave">Confirmar Nueva Contraseña</label>
                    <input type="password" id="confirmClave" name="confirm_clave" class="form-control" placeholder="Confirma tu nueva contraseña" required />
                </div>

                <button type="submit" class="btn btn-primary btn-block mb-4" name="cambioClave">Cambiar Contraseña</button>
            </form>
            <hr>
            <div class="text-center mb-2">
                <a href="/puntos-reciclaje/index.php">Volver a Iniciar Sesión</a>
            </div>
            <div class="text-center mb-2">
                 <a href="/puntos-reciclaje/vista/Usuario/registroCuenta/registrarse.php">Registrarme como usuario</a>
            </div>
            <div class="text-center">
                 <a href="/puntos-reciclaje/vista/Colaborador/registroCuenta/registrarse.php">Registrarme como colaborador</a>
            </div>
        </div>
    </div>
</div>