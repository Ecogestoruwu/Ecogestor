<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once(__DIR__ . '/../../logica/Cuenta.php'); //

if (isset($_POST["cambioClave"])) { //
    $correo = $_POST["correo"];
    $clave = $_POST["clave"];
    $confirm_clave = $_POST["confirm_clave"]; // From the new confirmation field

    // Basic Validations
    if (empty($correo) || empty($clave) || empty($confirm_clave)) {
        $_SESSION['message_type'] = 'danger';
        $_SESSION['message'] = 'Todos los campos son obligatorios.';
        header("Location: cambioClave.php"); // Redirect back to the form view page
        exit();
    }

    if (!preg_match('/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{5,}$/', $clave)) {
        $_SESSION['message_type'] = 'danger';
        $_SESSION['message'] = 'la contraseña debe tener mínimo 5 caracteres, al menos 1 letra y 1 número.';
        // Redirect back to registration form
        header("Location: cambioClave.php"); 
        exit();
    }

    if ($clave !== $confirm_clave) {
        $_SESSION['message_type'] = 'danger';
        $_SESSION['message'] = 'Las contraseñas no coinciden.';
        header("Location: cambioClave.php"); // Redirect back to the form view page
        exit();
    }
    // Consider adding more validation for password strength if desired

    $cuenta = new Cuenta();
    // The cambiarClave method in Cuenta.php should handle hashing the $clave
    // and return true on success, false on failure.
    $resultado = $cuenta->cambiarClave($correo, $clave); //

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
} else {
    // If accessed directly without POST, redirect to form or home
    header("Location: cambioClave.php");
    exit();
}
?>