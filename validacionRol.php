<?php
// Ensure session is started at the very beginning of any script that uses sessions
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once(__DIR__ . '/logica/Colaborador.php');
require_once(__DIR__ . '/logica/Usuario.php');
require_once(__DIR__ . '/logica/Cuenta.php'); // Aquí se carga la clase Cuenta

if (isset($_POST["inicioSesion"])) {
    $correo_ingresado = $_POST["correo"];
    $clave_ingresada = $_POST["clave"];

    $cuenta = new Cuenta(); // Se crea una instancia de Cuenta
    
    // Aquí es donde se llama a autenticar
    $autenticado = $cuenta->autenticar($correo_ingresado, $clave_ingresada); 
    
    if(!$autenticado){ // Si autenticar() devuelve false
        $_SESSION['message_type'] = 'danger';
        $_SESSION['message'] = 'Correo o contraseña incorrectos.';
        header("Location: /puntos-reciclaje/index.php"); // Vuelve al login
        exit();
    }
    if($cuenta->getEstado()==0){
        $_SESSION["email_pending"] = $_POST["correo"];
        header("Location: /puntos-reciclaje/vista/activacionCuenta/autenticarCorreo.php");
        exit();
    }
    $_SESSION["cuenta"] = $cuenta;
    // Session already started, $_SESSION["usuario"] or $_SESSION["colaborador"] will be set
    if($cuenta->getRol()==1){
        $usuario = new Usuario();
        // consultarCuenta will need to be adapted to the new DAO return types (assoc array)
        // and to accept the $cuenta object to get its ID.
		$usuario->consultarCuenta($cuenta); // Pass the authenticated $cuenta object
        $_SESSION["usuario"] = $usuario; // Storing the object is fine
        header("Location: /puntos-reciclaje/vista/Usuario/indexUsuario.php");
        exit();
    }else{
        $colaborador = new Colaborador();
        // Similar adaptation for $colaborador->consultarCuenta($cuenta)
        $colaborador->consultarCuenta($cuenta);
        $_SESSION["colaborador"] = $colaborador;
        header("Location: /puntos-reciclaje/vista/Colaborador/indexColaborador.php");
        exit();
    }
}
?>