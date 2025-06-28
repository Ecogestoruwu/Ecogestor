    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-7">
                <div class="update-form-card">
                    <h2 class="text-center">Registrar puntos de recoleccion</h2>
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
                    <form method="POST" action="crear_pr.php" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre del punto:</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                        </div>

                        <div class="mb-3">
                            <label for="direccion" class="form-label">Dirección:</label>
                            <input type="text" class="form-control" id="direccion" name="direccion" required>
                        </div>

                        <div class="mb-3">
                            <label for="latitud" class="form-label">Latitud:</label>
                            <input type="number" step="0.00000001" class="form-control" id="latitud" name="latitud"
                                required>
                        </div>

                        <div class="mb-3">
                            <label for="longitud" class="form-label">Longitud:</label>
                            <input type="number" step="0.00000001" class="form-control" id="longitud" name="longitud"
                                required>
                        </div>

                        <div class="mb-3">
                            <label for="estado" class="form-label">Estado:</label>
                            <input type="text" class="form-control" id="estado" name="estado" required>
                        </div>
                        <div class="d-grid gap-2 mt-4">
                            <button type="submit" name="asignarP_recolect" class="btn btn-info btn-lg">Registrar punto
                                de recoleccion</button>
                            <a href="crear_pr.php" class="btn btn-secondary">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>