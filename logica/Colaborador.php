<?php
require_once (__DIR__ . '/../persistencia/Conexion.php');
require (__DIR__ . '/../persistencia/ColaboradorDAO.php');

class Colaborador{
    private $idColaborador;
    private $nombre;
    private $tipo_residuo;
    private $servicio_ofrecido;
    private $cuenta;
    public function __construct($idColaborador=0, $nombre="", $tipo_residuo="", $servicio_ofrecido="", $cuenta=null){
        $this -> idColaborador = $idColaborador;
        $this -> nombre = $nombre;
        $this -> tipo_residuo = $tipo_residuo;
        $this -> servicio_ofrecido = $servicio_ofrecido;
        $this -> cuenta = $cuenta;
    }
    public function registrar($nombre, $tipo_residuo, $servicio_ofrecido,$idCuenta){
        $conexion = new Conexion();
        $conexion -> abrirConexion();
        $colaboradorDAO = new ColaboradorDAO();
        $conexion->ejecutarConsulta($colaboradorDAO->registrar(
            $nombre, $tipo_residuo, $servicio_ofrecido, $idCuenta
        ));
        $conexion->cerrarConexion();
        return true;
    }
    public function consultarCuenta($cuenta){
        $conexion = new Conexion();
        $conexion -> abrirConexion();
        $colaboradorDAO = new ColaboradorDAO();
        $conexion -> ejecutarConsulta($colaboradorDAO -> consultarCuenta($cuenta->getIdCuenta()));
        if($conexion -> numeroFilas() == 0){
            $conexion -> cerrarConexion();
            return false;
        }
        $registro = $conexion -> siguienteRegistro();
        $this->idColaborador = $registro[0];
        $this->nombre = $registro[1];
        $this->tipo_residuo = $registro[2];
        $this->servicio_ofrecido = $registro[3];
        $this->cuenta = $cuenta;
        $conexion -> cerrarConexion();
        return true;
    }

public function getIdColaborador() {
    return $this->idColaborador;
}
public function setIdColaborador($idColaborador) {
    $this->idColaborador = $idColaborador;
}
public function getNombre() {
    return $this->nombre;
}
public function setNombre($nombre) {
    $this->nombre = $nombre;
}
public function getTipoResiduo() {
    return $this->tipo_residuo;
}
public function setTipoResiduo($tipo_residuo) {
    $this->tipo_residuo = $tipo_residuo;
}
public function getServicioOfrecido() {
    return $this->servicio_ofrecido;
}
public function setServicioOfrecido($servicio_ofrecido) {
    $this->servicio_ofrecido = $servicio_ofrecido;
}
public function getCuenta() {
    return $this->cuenta;
}
public function setCuenta($cuenta) {
    $this->cuenta = $cuenta;
}
}
?>