<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once (__DIR__ . '/../../../logica/Usuario.php');
require_once (__DIR__ . '/../../../logica/Cuenta.php');

if (isset($_POST["registrar"])) {
    // Basic validation (you should add more)
    if (empty($_POST["correo"]) || empty($_POST["clave"]) || empty($_POST["nombre"]) || empty($_POST["apellido"])) {
        $_SESSION['message_type'] = 'danger';
        $_SESSION['message'] = 'Todos los campos son obligatorios.';
        // Redirect back to registration form
        header("Location: registrarse.php"); 
        exit();
    }

    $cuenta = new Cuenta();
    $usuario = new Usuario();
    // registrar now returns ID or false
    $idCuenta = $cuenta->registrar($_POST["correo"], $_POST["clave"], 1); 

    if ($idCuenta) {
        // registrar for UsuarioDAO should also be updated to use prepared statements
        // and return true/false
        $usuarioRegistrado = $usuario->registrar($_POST["nombre"], $_POST["apellido"], $idCuenta);
        if ($usuarioRegistrado) {
            $_SESSION['message_type'] = 'success';
            $_SESSION['message'] = '¡Usuario registrado exitosamente! Ahora puedes iniciar sesión.';
            header("Location: /puntos-reciclaje/index.php");
            exit();
        } else {
            // Potentially delete the created Cuenta if Usuario registration fails (more advanced)
            $_SESSION['message_type'] = 'danger';
            $_SESSION['message'] = 'Error al registrar los detalles del usuario.';
            header("Location: registrarse.php"); // Or index.php
            exit();
        }
    } else {
        $_SESSION['message_type'] = 'danger';
        // More specific error: e.g., email already exists (needs check in Cuenta::registrar or DAO)
        $_SESSION['message'] = 'Error al registrar la cuenta. El correo podría ya estar en uso.';
        header("Location: registrarse.php"); // Stay on registration page
        exit();
    }
}
?>