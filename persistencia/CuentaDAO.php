<?php
class CuentaDAO{
    private $idCuenta;
    private $correo;
    private $clave;
    private $rol;
    public function __construct($idCuenta=0, $correo="", $clave="", $rol=0){
        $this -> idCuenta = $idCuenta;
        $this -> correo = $correo;
        $this -> clave = $clave;
        $this -> rol = $rol;
    }
    public function consultarId($idCuenta){
        return "SELECT idCuenta,,correo,clave,rol FROM Cuenta WHERE idCuenta = $idCuenta;";
    }
    public function consultarCorreo($correo,$clave){
        return "SELECT idCuenta,correo,clave,rol
        FROM Cuenta
        WHERE correo = '$correo' AND clave = '$clave';";
    }
    public function cambiarClave($correo,$clave){
        return "UPDATE Cuenta
        SET clave = '$clave'
        WHERE correo = '$correo';";
    }
    public function registrar($correo,$clave,$rol){
        return "INSERT INTO Cuenta (correo,clave,rol) 
        VALUES ('$correo','$clave',$rol);";
    }
}

?>