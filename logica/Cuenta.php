<?php
require_once (__DIR__ . '/../persistencia/Conexion.php');
require (__DIR__ . '/../persistencia/CuentaDAO.php');

class Cuenta{
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
    public function registrar($correo,$clave,$rol){
        $conexion = new Conexion();
        $conexion -> abrirConexion();
        $cuentaDAO = new CuentaDAO();
        $conexion->ejecutarConsulta($cuentaDAO->registrar(
            $correo, $clave,$rol
        ));
        $idCuenta = $conexion -> obtenerLlaveAutonumerica();
        $conexion->cerrarConexion();
        return $idCuenta;
    }
    
    public function autenticar($correo,$clave){
        $conexion = new Conexion();
        $conexion -> abrirConexion();
        $cuentaDAO = new CuentaDAO();
        $conexion -> ejecutarConsulta($cuentaDAO -> consultarCorreo($correo,$clave));
        if($conexion -> numeroFilas() == 0){
            $conexion -> cerrarConexion();
            return false;
        }
        $registro = $conexion -> siguienteRegistro();
        $this->idCuenta = $registro[0];
        $this->correo = $registro[1];
        $this->clave = $registro[2];
        $this->rol = $registro[3];
        $conexion -> cerrarConexion();
        return true;
    }
    public function cambiarClave($correo,$clave){
        $conexion = new Conexion();
        $conexion -> abrirConexion();
        $cuentaDAO = new CuentaDAO();
        $conexion->ejecutarConsulta($cuentaDAO->cambiarClave(
            $correo, $clave
        ));
        $conexion->cerrarConexion();
    }
    public function getIdCuenta()
    {
        return $this->idCuenta;
    }
    public function setIdCuenta($idCuenta)
    {
        $this->idCuenta = $idCuenta;
    }
    public function getCorreo()
    {
        return $this->correo;
    }
    public function setCorreo($correo)
    {
        $this->correo = $correo;
    }
    public function getClave()
    {
        return $this->clave;
    }
    public function setClave($clave)
    {
        $this->clave = $clave;
    }
    public function getRol()
    {
        return $this->rol;
    }
    public function setRol($rol)
    {
        $this->rol = $rol;
    }
}
?>