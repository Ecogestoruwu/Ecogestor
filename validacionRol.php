<?php
require_once(__DIR__ . '/logica/Colaborador.php');
require_once(__DIR__ . '/logica/Usuario.php');
require_once(__DIR__ . '/logica/Cuenta.php');
if (isset($_POST["inicioSesion"])) {
    $cuenta = new Cuenta();
    $autenticar = $cuenta  -> autenticar($_POST["correo"],$_POST["clave"]);
    if(!$autenticar){
        header("Location: /PuntosReciclaje/index.php");
    }
    session_start();
    if($cuenta->getRol()==1){
        $usuario = new Usuario();
		$usuario -> consultarCuenta($cuenta);
        $_SESSION["usuario"] = $usuario;
        header("Location: /PuntosReciclaje/vista/Usuario/indexUsuario.php");
    }else{
        $colaborador = new Colaborador();
        $colaborador -> consultarCuenta($cuenta);
        $_SESSION["colaborador"] = $colaborador;
        header("Location: /PuntosReciclaje/vista/Colaborador/indexColaborador.php");
    }
}
?>