<?php
require_once (__DIR__ . '/../../../logica/Usuario.php');
require_once (__DIR__ . '/../../../logica/Cuenta.php');
if (isset($_POST["registrar"])) {
    $cuenta = new Cuenta();
    $usuario = new Usuario();
    $idCuenta = $cuenta  -> registrar($_POST["correo"],$_POST["clave"],1);
    $usuario -> registrar($_POST["nombre"],$_POST["apellido"], $idCuenta);

    header("Location: /PuntosReciclaje/index.php");
}
?>