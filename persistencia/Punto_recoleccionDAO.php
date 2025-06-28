<?php
class Punto_recoleccionDAO{
    public function __construct(){
        // Puede estar vacío
    }
    public function registrar($nombre, $direccion, $latitud, $longitud, $estado, $colaborador_id) {
        return "INSERT INTO Punto_Recoleccion (
            nombre,
            direccion,
            latitud,
            longitud,
            estado,
            Colaborador_idColaborador
        ) VALUES (
            '$nombre',
            '$direccion',
            $latitud,
            $longitud,
            '$estado',
            $colaborador_id
        );";
    }

}
?>