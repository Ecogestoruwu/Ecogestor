<?php
class UsuarioDAO{
    private $idUsuario;
    private $nombre;
    private $apellido;
    private $cuenta;
    
    public function __construct($idUsuario=0, $nombre="", $apellido="", $cuenta=null){
        $this -> idUsuario = $idUsuario;
        $this -> nombre = $nombre;
        $this -> apellido = $apellido;
        $this -> cuenta = $cuenta;
    }
    public function consultarCuenta($idCuenta){
        return "SELECT idUsuario,nombre,apellido,idCuenta
        FROM Usuario
        WHERE idCuenta = $idCuenta;";
    }
    public function registrar($nombre,$apellido,$idCuenta){
        return "INSERT INTO Usuario (nombre,apellido,idCuenta) 
        VALUES ('$nombre','$apellido',$idCuenta);";
    }
}
?>