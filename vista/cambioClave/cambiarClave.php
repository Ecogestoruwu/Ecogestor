<?php
session_start();
if (isset($_GET['cuenta'])) {
    require_once (__DIR__ . '/../../logica/Cuenta.php');
    $cuenta = new Cuenta();
    // The cambiarClave method in Cuenta.php should handle hashing the $clave
    // and return true on success, false on failure.
    $resultado = $cuenta->cambiarClave($_SESSION["email_pending"], $_SESSION["clave_pending"]); //

    if ($resultado) {
        $_SESSION['message_type'] = 'success';
        $_SESSION['message'] = '¡Contraseña cambiada exitosamente! Ahora puedes iniciar sesión con tu nueva contraseña.';
        header("Location: /puntos-reciclaje/index.php"); // Redirect to login page
        exit();
    } else {
        $_SESSION['message_type'] = 'danger';
        $_SESSION['message'] = 'Error al cambiar la contraseña. Verifica el correo electrónico o inténtalo más tarde.';
        header("Location: cambioClave.php"); // Redirect back to the form view page
        exit();
    }
}header("Location: /puntos-reciclaje/index.php");
?>