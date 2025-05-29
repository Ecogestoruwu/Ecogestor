<?php
require_once(__DIR__ . '/navbarColaborador.php'); // Asegura la sesión y el objeto $colaborador

if (!isset($_SESSION["colaborador"])) {
    header("Location: /PuntosReciclaje/index.php");
    exit();
}
$colaborador = $_SESSION["colaborador"]; // Este es un objeto Colaborador

$mensaje_feedback = ""; // Renombrado para claridad
$tipo_mensaje_feedback = ""; // 'success', 'danger', 'info'

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['actualizar_colaborador'])) {
    // Recoger datos del formulario
    $nuevo_nombre_colab = isset($_POST['nombre_colaborador']) ? trim($_POST['nombre_colaborador']) : '';
    $nuevo_correo_colab = isset($_POST['correo_colaborador']) ? trim($_POST['correo_colaborador']) : '';
    $nuevo_tipo_residuo = isset($_POST['tipo_residuo']) ? trim($_POST['tipo_residuo']) : '';
    $nuevo_servicio_ofrecido = isset($_POST['servicio_ofrecido']) ? trim($_POST['servicio_ofrecido']) : '';

    // Validaciones básicas del lado del servidor
    if (empty($nuevo_nombre_colab) || empty($nuevo_correo_colab) || empty($nuevo_tipo_residuo) || empty($nuevo_servicio_ofrecido)) {
        $mensaje_feedback = "Todos los campos (nombre, correo, tipo de residuo, servicio) son obligatorios.";
        $tipo_mensaje_feedback = "danger";
    } elseif (!filter_var($nuevo_correo_colab, FILTER_VALIDATE_EMAIL)) {
        $mensaje_feedback = "El formato del correo electrónico no es válido.";
        $tipo_mensaje_feedback = "danger";
    } else {
        // Intentar actualizar los datos llamando al método del objeto Colaborador
        // El método actualizarMisDatos ya existe en la clase Colaborador y fue proporcionado anteriormente
        $resultadoActualizacion = $colaborador->actualizarMisDatos(
            $nuevo_nombre_colab,
            $nuevo_tipo_residuo,
            $nuevo_servicio_ofrecido,
            $nuevo_correo_colab
        );

        $mensaje_feedback = $resultadoActualizacion['message'];
        if ($resultadoActualizacion['success']) {
            // Si la actualización fue exitosa (incluso si solo fue parcial o no hubo cambios netos pero sin errores graves)
            $tipo_mensaje_feedback = "success";
            if (strpos($mensaje_feedback, "No se realizaron cambios") !== false || strpos($mensaje_feedback, "No se detectaron cambios") !== false ) {
                $tipo_mensaje_feedback = "info"; // Si no hubo cambios, un mensaje 'info' es más apropiado
            }
            // Re-guardar el objeto $colaborador en la sesión para reflejar los cambios inmediatamente
            $_SESSION["colaborador"] = $colaborador;
        } else {
            // Si hubo un fallo explícito en la actualización
            $tipo_mensaje_feedback = "danger";
        }
    }
}
// El resto del HTML del formulario (ya proporcionado en la respuesta anterior) sigue aquí...
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Actualizar Info. Colaborador - Puntos de Reciclaje</title>
    <style>
        body { background-color: #eef1f5; }
        .update-form-card { margin-top: 50px; padding: 30px; border-radius: 15px; box-shadow: 0 8px 16px rgba(0,0,0,0.1); background-color: #fff; }
        .update-form-card h2 { color: #333; margin-bottom: 25px; }
        .form-label { font-weight: bold; color: #555; }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-7">
                <div class="update-form-card">
                    <h2 class="text-center">Actualizar Datos del Colaborador</h2>
                    
                    <?php if ($mensaje_feedback): // Usar la variable renombrada ?>
                        <div class="alert alert-<?php echo htmlspecialchars($tipo_mensaje_feedback); ?> alert-dismissible fade show" role="alert">
                            <?php echo htmlspecialchars($mensaje_feedback); ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>

                    <form method="POST" action="actualizarDatos.php">
                        <div class="mb-3">
                            <label for="nombre_colaborador" class="form-label">Nombre de Entidad/Persona:</label>
                            <input type="text" class="form-control" id="nombre_colaborador" name="nombre_colaborador" value="<?php echo htmlspecialchars($colaborador->getNombre()); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="correo_colaborador" class="form-label">Correo Electrónico:</label>
                            <input type="email" class="form-control" id="correo_colaborador" name="correo_colaborador" value="<?php
                                if ($colaborador->getCuenta() && method_exists($colaborador->getCuenta(), 'getCorreo')) {
                                    echo htmlspecialchars($colaborador->getCuenta()->getCorreo());
                                } else { echo ''; /* Evitar error si no hay cuenta o método */ }
                            ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="tipo_residuo" class="form-label">Tipo de Residuo Principal:</label>
                            <input type="text" class="form-control" id="tipo_residuo" name="tipo_residuo" value="<?php echo htmlspecialchars($colaborador->getTipoResiduo()); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="servicio_ofrecido" class="form-label">Servicio Ofrecido:</label>
                            <input type="text" class="form-control" id="servicio_ofrecido" name="servicio_ofrecido" value="<?php echo htmlspecialchars($colaborador->getServicioOfrecido()); ?>" required>
                        </div>
                        
                        <div class="d-grid gap-2 mt-4">
                            <button type="submit" name="actualizar_colaborador" class="btn btn-info btn-lg">Guardar Cambios</button>
                            <a href="indexColaborador.php" class="btn btn-secondary">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>