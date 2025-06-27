<?php
require_once (__DIR__ . '/../../../logica/Solicitud.php');
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$id = isset($_POST['id']);
$fechaProgramada = !empty($_POST['fecha_programada']) ? $_POST['fecha_programada'] : null;
$estado = $_POST["estado"];
if($fechaProgramada){
    $estado = "programada";
}
$solicitud = new Solicitud();
$solicitud->actualizar($id,$fechaProgramada,$estado);

// echo $_POST["correoUsuario"];
exit();
?>