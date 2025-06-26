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
    $nuevo_telefono = isset($_POST['telefono']) ? trim($_POST['telefono']) : '';
    $nueva_direccion = isset($_POST['direccion']) ? trim($_POST['direccion']) : '';
    $nuevo_servicio_ofrecido = isset($_POST['servicio_ofrecido']) ? trim($_POST['servicio_ofrecido']) : '';
    $foto_perfil = isset($_FILES['foto_perfil']) ? $_FILES['foto_perfil'] : null;

    // Validaciones básicas del lado del servidor
    if (empty($nuevo_nombre_colab) || empty($nuevo_correo_colab) || empty($nuevo_telefono) || empty($nueva_direccion) || empty($nuevo_servicio_ofrecido)) {
        $mensaje_feedback = "Todos los campos (nombre, correo, teléfono, dirección, servicio) son obligatorios.";
        $tipo_mensaje_feedback = "danger";
    } elseif (!filter_var($nuevo_correo_colab, FILTER_VALIDATE_EMAIL)) {
        $mensaje_feedback = "El formato del correo electrónico no es válido.";
        $tipo_mensaje_feedback = "danger";
    } elseif (!preg_match('/^[0-9\-\+\s]{7,20}$/', $nuevo_telefono)) {
        $mensaje_feedback = "El teléfono debe ser válido (solo números, espacios, + o -).";
        $tipo_mensaje_feedback = "danger";
    } elseif (isset($foto_perfil) && $foto_perfil['error'] === 0) {
        $allowed = ['image/jpeg', 'image/png'];
        if (!in_array($foto_perfil['type'], $allowed)) {
            $mensaje_feedback = "La imagen debe ser JPG o PNG.";
            $tipo_mensaje_feedback = "danger";
        } elseif ($foto_perfil['size'] > 2*1024*1024) {
            $mensaje_feedback = "La imagen no debe superar 2MB.";
            $tipo_mensaje_feedback = "danger";
        } else {
            $ext = pathinfo($foto_perfil['name'], PATHINFO_EXTENSION);
            $destino = '../imagenes/colaborador_' . $colaborador->getIdColaborador() . '_' . time() . '.' . $ext;
            if (move_uploaded_file($foto_perfil['tmp_name'], $destino)) {
                $colaborador->setFotoPerfil($destino);
            } else {
                $mensaje_feedback = "Error al subir la imagen.";
                $tipo_mensaje_feedback = "danger";
            }
        }
    } 
    if (empty($mensaje_feedback)) {
        // Si no hubo errores en las validaciones, actualizar los datos del colaborador en la base de datos
        require_once(__DIR__ . '/../../persistencia/Conexion.php');
        require_once(__DIR__ . '/../../persistencia/ColaboradorDAO.php');
        $conexion = new Conexion();
        $conexion->abrirConexion();
        $colaboradorDAO = new ColaboradorDAO();
        $foto_guardar = $colaborador->getFotoPerfil();
        $actualizado = $colaboradorDAO->actualizarDatosCompletos(
            $conexion,
            $colaborador->getIdColaborador(),
            $nuevo_nombre_colab,
            $nuevo_telefono,
            $nueva_direccion,
            $nuevo_servicio_ofrecido,
            $foto_guardar
        );
        $conexion->cerrarConexion();
        if ($actualizado) {
            $colaborador->setNombre($nuevo_nombre_colab);
            $colaborador->setTelefono($nuevo_telefono);
            $colaborador->setDireccion($nueva_direccion);
            $colaborador->setServicioOfrecido($nuevo_servicio_ofrecido);
            $_SESSION["colaborador"] = $colaborador;
            $mensaje_feedback = "Datos actualizados correctamente.";
            $tipo_mensaje_feedback = "success";
        } else {
            $mensaje_feedback = "No se pudo actualizar la información en la base de datos.";
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

                    <form method="POST" action="actualizarDatos.php" enctype="multipart/form-data">
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
                            <label for="telefono" class="form-label">Teléfono de Contacto:</label>
                            <input type="text" class="form-control" id="telefono" name="telefono" value="<?php echo htmlspecialchars($colaborador->getTelefono()); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="direccion" class="form-label">Dirección de la Organización:</label>
                            <input type="text" class="form-control" id="direccion" name="direccion" value="<?php echo htmlspecialchars($colaborador->getDireccion()); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="servicio_ofrecido" class="form-label">Servicio Ofrecido:</label>
                            <input type="text" class="form-control" id="servicio_ofrecido" name="servicio_ofrecido" value="<?php echo htmlspecialchars($colaborador->getServicioOfrecido()); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="foto_perfil" class="form-label">Foto de Perfil o Logotipo (JPG/PNG, máx 2MB):</label>
                            <input type="file" class="form-control" id="foto_perfil" name="foto_perfil" accept="image/jpeg,image/png">
                            <?php if (!empty($colaborador->getFotoPerfil())): ?>
                                <img src="<?php echo htmlspecialchars($colaborador->getFotoPerfil()); ?>" alt="Foto actual" style="max-width:100px;max-height:100px;margin-top:10px;">
                            <?php endif; ?>
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