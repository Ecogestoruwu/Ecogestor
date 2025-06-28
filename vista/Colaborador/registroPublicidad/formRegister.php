    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-7">
                <div class="update-form-card">
                    <h2 class="text-center">Publicar campañas / noticias</h2>
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
                    <form method="POST" action="publicar.php" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="titulo" class="form-label">Nombre de campañas/noticias:</label>
                            <input type="text" class="form-control" id="titulo" name="titulo" required>
                        </div>
                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripcion:</label>
                            <input type="text" class="form-control" id="descripcion" name="descripcion" required>
                        </div>
                        <div class="mb-3">
                            <label for="tipo" class="form-label">Tipo:</label>
                            <input type="text" class="form-control" id="tipo" name="tipo" required>
                        </div>
                        <div class="mb-3">
                            <label for="fecha_public" class="form-label">Fecha de publicacion:</label>
                            <input type="text" class="form-control" id="fecha_public" name="fecha_public" required>
                        </div>
                        <div class="mb-3">
                            <label for="enlace" class="form-label">Enlace:</label>
                            <input type="text" class="form-control" id="enlace" name="enlace" required>
                        </div>
                        <div class="d-grid gap-2 mt-4">
                            <button type="submit" name="registrar_publicidad"
                                class="btn btn-info btn-lg">Publicar</button>
                            <a href="publicar.php" class="btn btn-secondary">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>