<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (isset($_POST["activar"])) {
    if($_POST["activacion"]==1){
    require_once (__DIR__ . '/../../logica/Cuenta.php');
    $cuenta = new Cuenta();
    $cuenta -> activar($_SESSION["correo"]);
    $_SESSION['message_type'] = 'success';
    $_SESSION['message'] = '¡Cuenta activada exitosamente! Ahora puedes iniciar sesión.';
    }
    header("Location: /puntos-reciclaje/index.php");
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <title>Registrarse como Usuario - Puntos de Reciclaje</title>
    <style>
        body {
            background-color: #f0f4f8;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 20px;
        }

        .register-card {
            max-width: 450px;
            width: 100%;
            border: none;
            border-radius: 1rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            background-color: #ffffff;
        }

        .logo-placeholder {
            text-align: center;
        }

        .logo-placeholder img {
            max-width: 80px;
            margin-bottom: 1rem;
        }

        .btn-info {
            background-color: #0d6efd;
            border-color: #0d6efd;
        }

        .btn-info:hover {
            background-color: #0b5ed7;
            border-color: #0a58ca;
        }

        label {
            margin-left: 0.5rem;
            font-weight: 500;
        }

        input[type="radio"] {
            margin-right: 0.25rem;
        }
    </style>
</head>

<body>
    <div class="card register-card p-4">
        <div class="card-body">
            <div class="logo-placeholder">
                <img src="https://www.todoimpresoras.com/wp-content/uploads/2018/02/beneficios-utilizar-papel-reciclado-en-las-empresas.png"
                    alt="Logo Puntos Reciclaje">
                <h4 class="mb-3">Puntos de Reciclaje</h4>
            </div>
            <h5 class="card-title text-center mb-4 text-primary">¿Quieres activar tu cuenta?</h5>

            <form method="post" action="activarCuenta.php">
                <div class="mb-3">
                    <div class="form-check">
                        <input type="radio" id="si" name="activacion" value="1" class="form-check-input">
                        <label for="si" class="form-check-label">Sí</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" id="no" name="activacion" value="0" class="form-check-input">
                        <label for="no" class="form-check-label">No</label>
                    </div>
                </div>

                <div class="d-grid mb-3">
                    <button type="submit" class="btn btn-info btn-lg" name="activar">
                        action
                    </button>
                </div>

                <div class="text-center">
                    <p class="mb-1">¿Ya tienes una cuenta?</p>
                    <a href="/puntos-reciclaje/index.php" class="text-decoration-none text-primary">Iniciar Sesión</a>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous">
    </script>
</body>

</html>
