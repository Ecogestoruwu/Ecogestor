<?php
require_once(__DIR__ . '/navbarColaborador.php'); // Para mantener la sesión y el estilo

if (!isset($_SESSION["colaborador"])) {
    header("Location: /PuntosReciclaje/index.php");
    exit();
}
$colaborador = $_SESSION["colaborador"];

// Lógica para manejar el POST del formulario
$mensaje = "";
$tipo_mensaje = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['actualizar_colaborador'])) {
    // Aquí procesarías los datos del formulario
    // Por ejemplo:
    // $nuevo_nombre_colab = $_POST['nombre_colaborador'];
    // $nuevo_tipo_residuo = $_POST['tipo_residuo'];
    // $nuevo_servicio = $_POST['servicio_ofrecido'];
    // ...llamar a un método en $colaborador o en una clase de lógica para actualizar la BD...

    // Ejemplo de mensaje (reemplazar con lógica real):
    // if (actualizacion_exitosa) {
    //    $mensaje = "¡Información del colaborador actualizada correctamente!";
    //    $tipo_mensaje = "success";
    //    // Actualizar el objeto $colaborador en la sesión
    //    // $_SESSION["colaborador"] = $colaboradorActualizado;
    //    // $colaborador = $colaboradorActualizado;
    // } else {
    //    $mensaje = "Error al actualizar la información del colaborador.";
    //    $tipo_mensaje = "danger";
    // }
    $mensaje = "Funcionalidad de actualización en desarrollo."; // Placeholder
    $tipo_mensaje = "info";
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Actualizar Info. Colaborador - Puntos de Reciclaje</title>
    <style>
        body {
            background-color: #eef1f5;
        }
        .update-form-card {
            margin-top: 50px;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 8px 16px rgba(0,0,0,0.1);
            background-color: #fff;
        }
        .update-form-card h2 {
            color: #333;
            margin-bottom: 25px;
        }
        .form-label {
            font-weight: bold;
            color: #555;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-7">
                <div class="update-form-card">
                    <h2 class="text-center">Actualizar Datos del Colaborador</h2>
                    
                    <?php if ($mensaje): ?>
                        <div class="alert alert-<?php echo $tipo_mensaje; ?> alert-dismissible fade show" role="alert">
                            <?php echo htmlspecialchars($mensaje); ?>
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
                                }
                            ?>" required>
                            <small class="form-text text-muted">Cambiar el correo puede requerir una nueva verificación.</small>
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