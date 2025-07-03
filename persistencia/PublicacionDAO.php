<?php
class PublicacionDAO{
    public function __construct(){
        // Puede estar vacío
    }
    public function registrar($titulo, $descripcion, $tipo, $fecha_publicacion, $enlace, $colaborador_id){
        return "INSERT INTO Publicacion (
    titulo,
    descripcion,
    tipo,
    fecha_publicacion,
    enlace,
    Colaborador_idColaborador
    ) VALUES ('$titulo', '$descripcion', '$tipo', '$fecha_publicacion', '$enlace', $colaborador_id
    );";
    }
    public function consultarTodos(){
        return "SELECT idPublicacion,titulo,descripcion,tipo,fecha_publicacion,enlace,Colaborador_idColaborador
        FROM Publicacion";
    }
    public function consultar_por_tipo($tipo){
        return "SELECT idPublicacion,titulo,descripcion,tipo,fecha_publicacion,enlace,Colaborador_idColaborador
        FROM Publicacion 
        WHERE tipo = '$tipo'
        Order by fecha_publicacion";
    }
}
?>