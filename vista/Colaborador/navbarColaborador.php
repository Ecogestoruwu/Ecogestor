<?php
require_once(__DIR__ . '/../../logica/Colaborador.php');
require_once(__DIR__ . '/../../logica/Cuenta.php');
require_once(__DIR__ . '/../../logica/Solicitud.php');
require_once(__DIR__ . '/../../logica/Usuario.php');
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (isset($_GET["cerrarSesion"])||!isset($_SESSION["colaborador"])) {
    $_SESSION = [];
    session_destroy();

    header("Location: /puntos-reciclaje/index.php");
    exit();
}
$colaborador = $_SESSION["colaborador"];
$cuenta = $_SESSION["cuenta"] ?? ($colaborador && method_exists($colaborador, 'getCuenta') ? $colaborador->getCuenta() : null);
?>

<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="/puntos-reciclaje/vista/Colaborador/indexColaborador.php">
            <img src="/assets/images/logo.webp" style="width: 30px; height: 30px;" alt="Logo">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0"> 
                <li class="nav-item">
                    <a class="nav-link" href="/puntos-reciclaje/vista/Colaborador/actualizarDatos.php">Actualizar mis datos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/puntos-reciclaje/vista/Colaborador/residuosColaborador.php">Gestionar residuos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/puntos-reciclaje/vista/Colaborador/registroPublicidad/registrarPublicidad.php">publicar</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/puntos-reciclaje/vista/Colaborador/registro_P_Recolect/registrarP_Recolect.php">registrar punto_recoleccion</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/puntos-reciclaje/vista/Colaborador/solicitud/verSolicitudes.php">ver solicitudes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/puntos-reciclaje/index.php?cerrarSesion=1">Cerrar sesión</a>
                </li>
            </ul>
            <span class="navbar-text">
                <?php echo htmlspecialchars($colaborador->getNombre()); ?>
            </span>
        </div>
    </div>
</nav>