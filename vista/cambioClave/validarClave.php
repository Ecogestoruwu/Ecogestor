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
    $_SESSION["email_pending"] = $_POST["correo"];
    $_SESSION["clave_pending"] = $_POST["clave"];
    header("Location: /puntos-reciclaje/vista/cambioClave/autenticarCorreo.php");
} else {
    // If accessed directly without POST, redirect to form or home
    header("Location: cambioClave.php");
    exit();
}
?>