<?php
// Asegurarse de que la sesión esté iniciada para mostrar mensajes potenciales
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
// Guardar mensajes antes de destruir la sesión
$mensaje = isset($_SESSION['message']) ? $_SESSION['message'] : null;
$mensaje_tipo = isset($_SESSION['message_type']) ? $_SESSION['message_type'] : null;
// Destruir cualquier sesión activa al cargar el login
session_unset();
session_destroy();
// Restaurar mensajes en la nueva sesión
if ($mensaje) {
    session_start();
    $_SESSION['message'] = $mensaje;
    $_SESSION['message_type'] = $mensaje_tipo;
}

// Cabeceras anti-caché para evitar acceso tras logout o retroceso
header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
header('Cache-Control: post-check=0, pre-check=0', false);
header('Pragma: no-cache');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <title>Iniciar Sesión - Puntos de Reciclaje</title>
    <style>
        body {
            background-color: #f8f9fa; /* Fondo gris claro */
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }
        .login-card {
            max-width: 450px; /* Ancho ligeramente aumentado */
            width: 100%;
            padding: 2rem;
            border: none;
            border-radius: 0.75rem; /* Esquinas más suaves */
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1); /* Sombra más suave */
        }
        .logo-placeholder {
            /* Estilo para el área del logo si se tiene uno */
            text-align: center;
            margin-bottom: 1.5rem;
            font-size: 1.5rem;
            font-weight: bold;
            color: #0d6efd; /* Azul primario de Bootstrap */
        }
        /* Opcional: Estilo para etiquetas de formulario, ligeramente más pequeñas y en gris */
        .form-label {
            font-size: 0.875rem;
            color: #6c757d;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-5"> 
                <?php
                // Esto incluye el contenido de loginForm.php
                include (__DIR__ . '/loginForm.php');
                ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous">
    </script>
</body>
</html>