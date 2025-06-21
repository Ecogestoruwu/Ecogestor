<?php
require_once(__DIR__ . '/../../logica/Colaborador.php');
session_start();
if (isset($_GET["cerrarSesion"])||!isset($_SESSION["colaborador"])) {
    $_SESSION = [];
    session_destroy();

    header("Location: /puntos-reciclaje/index.php");
}
$colaborador = $_SESSION["colaborador"];
$cuenta = $_SESSION["cuenta"];
?>

<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">
            <img src="/assets/images/logo.webp" style="width: 30px; height: 30px;" alt="Logo">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">
                        menu 1</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">
                        menu 2</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">
                        menu 3</a>
                </li>
            </ul>
        </div>
        <div class="ml-auto">
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <?php echo $colaborador->getNombre(); ?>
                    </a>
                    <ul class="dropdown-menu">
                        <li> <?php echo $cuenta -> getCorreo(); ?></li>   
                        <li><a class='dropdown-item'
                                href='<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>?cerrarSesion=true'>Cerrar
                                Sesion</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>