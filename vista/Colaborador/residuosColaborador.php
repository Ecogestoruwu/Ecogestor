<?php
require_once(__DIR__ . '/navbarColaborador.php');
require_once(__DIR__ . '/../../persistencia/Conexion.php');
require_once(__DIR__ . '/../../persistencia/ResiduoDAO.php');
require_once(__DIR__ . '/../../persistencia/ColaboradorDAO.php');

if (!isset($_SESSION["colaborador"])) {
    header("Location: /PuntosReciclaje/index.php");
    exit();
}
$colaborador = $_SESSION["colaborador"];

$mensaje = "";
$tipo_mensaje = "";

$conexion = new Conexion();
$conexion->abrirConexion();
$residuoDAO = new ResiduoDAO();
$colaboradorDAO = new ColaboradorDAO();

// Obtener lista de residuos
$residuos = $residuoDAO->listarTodos($conexion);
// Obtener residuos seleccionados previamente
$residuosColaborador = $colaboradorDAO->obtenerResiduosColaborador($conexion, $colaborador->getIdColaborador());
$observacionesActuales = $colaboradorDAO->obtenerObservacionesResiduos($conexion, $colaborador->getIdColaborador());

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['guardar_residuos'])) {
    $seleccionados = isset($_POST['residuos']) ? $_POST['residuos'] : [];
    $observaciones = isset($_POST['observaciones']) ? trim($_POST['observaciones']) : '';
    if (empty($seleccionados)) {
        $mensaje = "Debes seleccionar al menos un tipo de residuo e-waste.";
        $tipo_mensaje = "danger";
    } else {
        // Guardar selección y observaciones
        $colaboradorDAO->actualizarResiduosColaborador($conexion, $colaborador->getIdColaborador(), $seleccionados, $observaciones);
        $mensaje = "Información de residuos actualizada correctamente.";
        $tipo_mensaje = "success";
        // Refrescar datos
        $residuosColaborador = $colaboradorDAO->obtenerResiduosColaborador($conexion, $colaborador->getIdColaborador());
        $observacionesActuales = $observaciones;
    }
}
$conexion->cerrarConexion();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Residuos gestionados - Puntos de Reciclaje</title>
    <style>
        body { background-color: #eef1f5; }
        .residuo-form-card { margin-top: 50px; padding: 30px; border-radius: 15px; box-shadow: 0 8px 16px rgba(0,0,0,0.1); background-color: #fff; }
        .residuo-form-card h2 { color: #333; margin-bottom: 25px; }
        .form-label { font-weight: bold; color: #555; }
    </style>
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10 col-lg-9"> <!-- Cambiado de col-md-8 col-lg-7 a col-md-10 col-lg-9 -->
            <div class="residuo-form-card">
                <h2 class="text-center">Tipos de residuos gestionados</h2>
                <?php if ($mensaje): ?>
                    <div class="alert alert-<?php echo htmlspecialchars($tipo_mensaje); ?> alert-dismissible fade show" role="alert">
                        <?php echo htmlspecialchars($mensaje); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>
                <form method="POST" action="residuosColaborador.php">
                    <div class="mb-3">
                        <label for="filtro_categoria" class="form-label">Filtrar por categoría:</label>
                        <select id="filtro_categoria" class="form-select mb-3" onchange="filtrarPorCategoria()">
                            <option value="">Todas</option>
                            <?php
                            $categorias = array_unique(array_map(function($r){ return $r['categoria']; }, $residuos));
                            sort($categorias);
                            foreach ($categorias as $cat): ?>
                                <option value="<?php echo htmlspecialchars($cat); ?>"><?php echo htmlspecialchars($cat); ?></option>
                            <?php endforeach; ?>
                        </select>
                        <label class="form-label">Selecciona los tipos de residuos electrónicos que gestionas <span class="text-danger">*</span>:</label>
                        <div class="overflow-auto border rounded p-2" id="lista_residuos" style="max-height: 400px; min-height: 120px; background: #f8fafc;">
                            <div class="row flex-nowrap flex-md-wrap g-2">
                            <?php foreach ($residuos as $residuo): ?>
                                <div class="col-12 col-md-6 mb-2 residuo-item" data-categoria="<?php echo htmlspecialchars($residuo['categoria']); ?>" style="min-width: 320px;">
                                    <div class="form-check p-2 border rounded bg-light h-100">
                                        <input class="form-check-input" type="checkbox" name="residuos[]" id="residuo_<?php echo $residuo['idResiduo']; ?>" value="<?php echo $residuo['idResiduo']; ?>" <?php echo in_array($residuo['idResiduo'], $residuosColaborador) ? 'checked' : ''; ?>>
                                        <label class="form-check-label w-100" for="residuo_<?php echo $residuo['idResiduo']; ?>">
                                            <div class="d-flex flex-wrap align-items-center justify-content-between">
                                                <div>
                                                    <strong><?php echo htmlspecialchars($residuo['nombre']); ?></strong>
                                                    <small class="text-muted d-block mt-1"><?php echo nl2br(htmlspecialchars($residuo['descripcion'])); ?></small>
                                                </div>
                                                <span class="badge bg-info text-dark mb-1 ms-2 text-wrap align-self-start" style="max-width: 120px; white-space: normal; word-break: break-word;"><?php echo htmlspecialchars($residuo['categoria']); ?></span>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="observaciones" class="form-label">Observaciones / Notas (opcional):</label>
                        <textarea class="form-control" id="observaciones" name="observaciones" rows="3"><?php echo htmlspecialchars($observacionesActuales); ?></textarea>
                    </div>
                    <div class="d-grid gap-2 mt-4">
                        <button type="submit" name="guardar_residuos" class="btn btn-success btn-lg">Guardar</button>
                        <a href="indexColaborador.php" class="btn btn-secondary">Volver</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
<script>
function filtrarPorCategoria() {
    var cat = document.getElementById('filtro_categoria').value;
    var items = document.querySelectorAll('.residuo-item');
    items.forEach(function(item) {
        if (!cat || item.getAttribute('data-categoria') === cat) {
            item.style.display = '';
        } else {
            item.style.display = 'none';
        }
    });
}
</script>
</body>
</html>
