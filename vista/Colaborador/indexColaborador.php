<?php
// El archivo navbarColaborador.php ya debería manejar el inicio de sesión
// y la creación del objeto $colaborador en la sesión.
require_once(__DIR__ . '/navbarColaborador.php'); //

// Verificación de seguridad: si no hay un colaborador en la sesión, redirigir al login.
if (!isset($_SESSION["colaborador"])) {
    header("Location: /PuntosReciclaje/index.php");
    exit();
}
$colaborador = $_SESSION["colaborador"]; // Obtener el objeto Colaborador de la sesión

// Verificar si faltan datos obligatorios
$faltanDatos = empty($colaborador->getTelefono()) || empty($colaborador->getDireccion()) || empty($colaborador->getFotoPerfil());
if ($faltanDatos) {
    header("Location: actualizarDatos.php?completar=1");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <title>Panel de Colaborador - Puntos de Reciclaje</title>
    <style>
        body {
            background-color: #eef1f5; /* Un azul-gris muy claro, diferente al de usuario */
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; /* Fuente más moderna */
        }
        .profile-card-colab { /* Nombre de clase específico para evitar colisiones */
            margin-top: 50px;
            padding: 35px; /* Un poco más de padding */
            border-radius: 10px; /* Bordes ligeramente menos redondeados */
            box-shadow: 0 6px 20px rgba(0,0,0,0.08); /* Sombra más sutil */
            background-color: #ffffff;
            border-left: 5px solid #17a2b8; /* Borde izquierdo de color info */
        }
        .profile-card-colab h2 {
            color: #17a2b8; /* Color info para el título */
            margin-bottom: 25px;
            font-weight: 600;
        }
        .profile-card-colab .info-label {
            font-weight: 600; /* Ligeramente más grueso */
            color: #495057; /* Gris oscuro */
            font-size: 0.95rem;
        }
        .profile-card-colab .info-value {
            color: #212529; /* Negro suave */
            font-size: 0.95rem;
        }
        .btn-custom-update-colab { /* Nombre de clase específico */
            background-color: #17a2b8; /* Bootstrap 'info' color */
            border-color: #17a2b8;
            color: white;
            padding: 10px 25px; /* Botón más grande */
            font-size: 1.05rem;
            border-radius: 5px; /* Bordes del botón */
            transition: background-color 0.3s ease;
            margin-top: 25px;
        }
        .btn-custom-update-colab:hover {
            background-color: #138496; /* Tono más oscuro del 'info' */
            border-color: #117a8b;
        }
        hr {
            margin-top: 1.5rem;
            margin-bottom: 1.5rem;
        }
    </style>
</head>
<body>
    <?php
    // navbarColaborador.php ya se incluye al principio del script,
    // lo que proporciona la barra de navegación y la validación de sesión.
    ?>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9 col-xl-8"> 
                <div class="profile-card-colab">
                    <h2 class="text-center">Perfil del Colaborador</h2>
                    <p class="text-center text-muted mb-4">Bienvenido, <?php echo htmlspecialchars($colaborador->getNombre()); ?>. Aquí puedes ver los detalles de tu perfil.</p>
                    <hr>
                    <div class="row mb-3 align-items-center">
                        <div class="col-md-4 text-md-end info-label">Nombre de Entidad/Persona:</div>
                        <div class="col-md-8 text-md-start info-value"><?php echo htmlspecialchars($colaborador->getNombre()); ?></div>
                    </div>
                    <div class="row mb-3 align-items-center">
                        <div class="col-md-4 text-md-end info-label">Correo Electrónico de Contacto:</div>
                        <div class="col-md-8 text-md-start info-value">
                            <?php
                                // Asumimos que el objeto Cuenta está disponible a través de $colaborador->getCuenta()
                                // y que Cuenta tiene un método getCorreo()
                                if ($colaborador->getCuenta() && method_exists($colaborador->getCuenta(), 'getCorreo')) {
                                    echo htmlspecialchars($colaborador->getCuenta()->getCorreo());
                                } else {
                                    echo "Correo no disponible";
                                }
                            ?>
                        </div>
                    </div>
                    <div class="row mb-3 align-items-center">
                        <div class="col-md-4 text-md-end info-label">Tipo de Residuo Principal que Gestiona:</div>
                        
                    </div>
                    <div class="row mb-3 align-items-center">
                        <div class="col-md-4 text-md-end info-label">Servicio Ofrecido:</div>
                        <div class="col-md-8 text-md-start info-value"><?php echo htmlspecialchars($colaborador->getServicioOfrecido()); ?></div>
                    </div>
                    
                    <div class="text-center"> 
                        <a href="actualizarDatos.php" class="btn btn-custom-update-colab">Actualizar Información</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous">
    </script>
</body>
</html>