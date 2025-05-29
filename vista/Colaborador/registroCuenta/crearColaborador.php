<?php
require_once (__DIR__ . '/../../../logica/Colaborador.php');
require_once (__DIR__ . '/../../../logica/Cuenta.php');
if (isset($_POST["registrar"])) {
    $cuenta = new Cuenta();
    $colaborador = new Colaborador();
    $idCuenta = $cuenta  -> registrar($_POST["correo"],$_POST["clave"],2);
    $colaborador -> registrar($_POST["nombre"],$_POST["tipo_residuo"], $_POST["servicio_ofrecido"],$idCuenta);

    header("Location: /puntos-reciclaje/index.php");
}
?>