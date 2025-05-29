<?php
require_once(__DIR__ . '/navbarUser.php'); 

if (!isset($_SESSION["usuario"])) {
    header("Location: /PuntosReciclaje/index.php");
    exit();
}
$usuario = $_SESSION["usuario"]; // Este es un objeto Usuario

$mensaje = "";
$tipo_mensaje = ""; // 'success', 'danger', 'info'

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['actualizar_usuario'])) {
    $nuevo_nombre = trim($_POST['nombre']);
    $nuevo_apellido = trim($_POST['apellido']);
    $nuevo_correo = trim($_POST['correo']);

    // Validaciones básicas
    if (empty($nuevo_nombre) || empty($nuevo_apellido) || empty($nuevo_correo)) {
        $mensaje = "Todos los campos (nombre, apellido, correo) son obligatorios.";
        $tipo_mensaje = "danger";
    } elseif (!filter_var($nuevo_correo, FILTER_VALIDATE_EMAIL)) {
        $mensaje = "El formato del correo electrónico no es válido.";
        $tipo_mensaje = "danger";
    } else {
        // Llama al método de actualización en el objeto Usuario
        // Este método ahora devuelve un array con 'success' y 'message'
        $resultadoActualizacion = $usuario->actualizarMisDatos($nuevo_nombre, $nuevo_apellido, $nuevo_correo);

        $mensaje = $resultadoActualizacion['message'];
        if ($resultadoActualizacion['success']) {
            $tipo_mensaje = "success";
            // Si los datos se actualizaron en el objeto $usuario dentro del método,
            // y $usuario es una referencia al objeto en sesión, la sesión se actualiza.
            // Si no, necesitas reasignar:
            $_SESSION["usuario"] = $usuario; // Re-guarda el objeto actualizado en la sesión
        } else {
            $tipo_mensaje = "danger";
             // Si hubo un error específico de correo no único y quieres un mensaje más amigable
            if (strpos($mensaje, "ya está en uso") !== false) {
                // El mensaje ya lo da el método, no hace falta añadir más aquí
            }
        }
    }
}
// El resto del HTML del formulario sigue igual que en la respuesta anterior...
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Actualizar Información - Puntos de Reciclaje</title>
    <style>
        body { background-color: #f4f7f6; }
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
                    <h2 class="text-center">Actualizar Mis Datos</h2>
                    
                    <?php if ($mensaje): ?>
                        <div class="alert alert-<?php echo htmlspecialchars($tipo_mensaje); ?> alert-dismissible fade show" role="alert">
                            <?php echo htmlspecialchars($mensaje); ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>

                    <form method="POST" action="actualizarDatos.php">
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre:</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo htmlspecialchars($usuario->getNombre()); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="apellido" class="form-label">Apellido:</label>
                            <input type="text" class="form-control" id="apellido" name="apellido" value="<?php echo htmlspecialchars($usuario->getApellido()); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="correo" class="form-label">Correo Electrónico:</label>
                            <input type="email" class="form-control" id="correo" name="correo" value="<?php
                                if ($usuario->getCuenta() && method_exists($usuario->getCuenta(), 'getCorreo')) {
                                    echo htmlspecialchars($usuario->getCuenta()->getCorreo());
                                }
                            ?>" required>
                        </div>
                        
                        <div class="d-grid gap-2 mt-4">
                            <button type="submit" name="actualizar_usuario" class="btn btn-primary btn-lg">Guardar Cambios</button>
                            <a href="indexUsuario.php" class="btn btn-secondary">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>