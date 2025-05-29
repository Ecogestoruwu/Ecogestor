<?php
require_once(__DIR__ . '/../../logica/Cuenta.php');
if (isset($_POST["cambioClave"])) {
    $cuenta = new Cuenta();
    $cuenta  -> cambiarClave($_POST["correo"],$_POST["clave"]);
    header("Location: /PuntosReciclaje/index.php");
}
?>