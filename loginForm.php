<div class="card login-card">
    <div class="card-body">
        <div class="logo-placeholder">
            <img src="https://www.todoimpresoras.com/wp-content/uploads/2018/02/beneficios-utilizar-papel-reciclado-en-las-empresas.png" alt="Logo Puntos Reciclaje" style="max-width: 80px; height: auto; margin-bottom: 1rem;">
            <h4>Puntos de Reciclaje</h4>
        </div>
        <h5 class="card-title text-center mb-4">Iniciar Sesión</h5>

        <?php
        // Display messages if any
        if (isset($_SESSION['debug_auth']) && !empty($_SESSION['debug_auth'])) {
    echo '<div class="alert alert-warning mt-3" role="alert">';
    echo '<h4 class="alert-heading">Información de Depuración de Autenticación:</h4><pre>';
    foreach ($_SESSION['debug_auth'] as $message) {
        echo htmlspecialchars($message) . "\n";
    }
    echo '</pre></div>';
    unset($_SESSION['debug_auth']); // Limpia los mensajes de debug después de mostrarlos
}

        if (isset($_SESSION['message']) && isset($_SESSION['message_type'])) {
            echo "<div class='alert alert-" . htmlspecialchars($_SESSION['message_type']) . " alert-dismissible fade show' role='alert'>";
            echo htmlspecialchars($_SESSION['message']);
            echo "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>";
            echo "</div>";
            unset($_SESSION['message']);
            unset($_SESSION['message_type']);
        }
        ?>

        <form method="post" action="validacionRol.php">
            <div class="mb-3"> 
                <label class="form-label" for="loginCorreo">Correo Electrónico</label>
                <input type="email" id="loginCorreo" name="correo" class="form-control form-control-lg" placeholder="tu@correo.com" required />
            </div>

            <div class="mb-3"> 
                <label class="form-label" for="loginClave">Contraseña</label>
                <input type="password" id="loginClave" name="clave" class="form-control form-control-lg" placeholder="Tu contraseña" required />
            </div>

            <div class="row mb-4">
                <div class="col-md-6 d-flex justify-content-center justify-content-md-start">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="form2Example31" checked />
                        <label class="form-check-label" for="form2Example31"> Recordarme </label>
                    </div>
                </div>

                <div class="col-md-6 text-center text-md-end">
                    <a href="vista/cambioClave/cambioClave.php">¿Olvidaste tu contraseña?</a>
                </div>
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-primary btn-lg" name="inicioSesion">Ingresar</button>
            </div>

            <hr class="my-4">

            <div class="text-center mb-2">
                <p class="mb-1">¿No tienes una cuenta?</p>
                <a href="vista/Usuario/registroCuenta/registrarse.php" class="btn btn-outline-success btn-sm mb-2">Registrarme como Usuario</a>
                <a href="vista/Colaborador/registroCuenta/registrarse.php" class="btn btn-outline-info btn-sm mb-2">Registrarme como Colaborador</a>
            </div>
        </form>
    </div>
</div>