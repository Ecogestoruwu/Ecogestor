<?php
class ColaboradorDAO{    
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
    public function consultarCuenta($idCuenta){
        return "SELECT idColaborador,nombre,tipo_residuo,servicio_ofrecido,idCuenta
        FROM Colaborador
        WHERE idCuenta = $idCuenta;";
    }
    public function registrar($nombre,$tipo_residuo,$servicio_ofrecido,$idCuenta){
        return "INSERT INTO Colaborador (nombre,tipo_residuo,servicio_ofrecido,idCuenta) 
        VALUES ('$nombre','$tipo_residuo','$servicio_ofrecido',$idCuenta);";
    }
}
?>