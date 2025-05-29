<?php
require_once (__DIR__ . '/../persistencia/Conexion.php');
require_once(__DIR__ . '/../persistencia/UsuarioDAO.php');
require_once (__DIR__ . '/Cuenta.php');

class Usuario{
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
    public function registrar($nombre,$apellido,$idCuenta){
        $conexion = new Conexion();
        $conexion -> abrirConexion();
        $usuarioDAO = new UsuarioDAO();
        $conexion->ejecutarConsulta($usuarioDAO->registrar(
            $nombre, $apellido, $idCuenta
        ));
        $conexion->cerrarConexion();
        return true;
    }
    public function consultarCuenta($cuenta){
        $conexion = new Conexion();
        $conexion -> abrirConexion();
        $usuarioDAO = new UsuarioDAO();
        $conexion -> ejecutarConsulta($usuarioDAO -> consultarCuenta($cuenta->getIdCuenta()));
        if($conexion -> numeroFilas() == 0){
            $conexion -> cerrarConexion();
            return false;
        }
        $registro = $conexion -> siguienteRegistro();
        $this->idUsuario = $registro[0];
        $this->nombre = $registro[1];
        $this->apellido = $registro[2];
        $this->cuenta = $cuenta;
        $conexion -> cerrarConexion();
        return true;
    }
    public function getIdUsuario()
    {
        return $this->idUsuario;
    }

    public function setIdUsuario($idUsuario)
    {
        $this->idUsuario = $idUsuario;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function getApellido()
    {
        return $this->apellido;
    }

    public function setApellido($apellido)
    {
        $this->apellido = $apellido;
    }
    public function getCuenta()
    {
        return $this->cuenta;
    }
        public function setCuenta($cuenta)
    {
        $this->cuenta = $cuenta;
    }
}

?>