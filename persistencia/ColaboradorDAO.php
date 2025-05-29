<?php
class ColaboradorDAO{
    
    public function __construct(){
        // Puede estar vacío
    }

    public function registrar(Conexion $conexion, $nombre, $tipo_residuo, $servicio_ofrecido, $idCuenta){
        $sql = "INSERT INTO Colaborador (nombre, tipo_residuo, servicio_ofrecido, idCuenta) 
                VALUES (?, ?, ?, ?)";
        $stmt = $conexion->prepararConsulta($sql);
        if (!$stmt) {
            error_log("Prepare failed for ColaboradorDAO::registrar.");
            return false;
        }
        $stmt->bind_param("sssi", $nombre, $tipo_residuo, $servicio_ofrecido, $idCuenta);
        if ($stmt->execute()) {
            $stmt->close();
            return true;
        } else {
            error_log("Execute failed for ColaboradorDAO::registrar: " . $stmt->error);
            $stmt->close();
            return false;
        }
    }

    public function consultarCuenta(Conexion $conexion, $idCuenta){
        $sql = "SELECT idColaborador, nombre, tipo_residuo, servicio_ofrecido, idCuenta
                FROM Colaborador
                WHERE idCuenta = ?";
        $stmt = $conexion->prepararConsulta($sql);
        if (!$stmt) {
             error_log("Prepare failed for ColaboradorDAO::consultarCuenta.");
            return null;
        }
        $stmt->bind_param("i", $idCuenta);
        $datos = null;
        if ($stmt->execute()) {
            $resultado = $stmt->get_result();
            if ($resultado->num_rows == 1) {
                $datos = $resultado->fetch_assoc();
            }
        } else {
            error_log("Execute failed for ColaboradorDAO::consultarCuenta: " . $stmt->error);
        }
        $stmt->close();
        return $datos;
    }

    /**
     * Actualiza los datos de un colaborador en la tabla Colaborador.
     * @param Conexion $conexion
     * @param int $idColaborador El ID del colaborador a actualizar.
     * @param string $nombre Nuevo nombre.
     * @param string $tipo_residuo Nuevo tipo de residuo.
     * @param string $servicio_ofrecido Nuevo servicio ofrecido.
     * @return bool True si la actualización fue exitosa y afectó filas, false en caso contrario.
     */
    public function actualizar(Conexion $conexion, $idColaborador, $nombre, $tipo_residuo, $servicio_ofrecido) {
        $sql = "UPDATE Colaborador SET nombre = ?, tipo_residuo = ?, servicio_ofrecido = ? WHERE idColaborador = ?";
        $stmt = $conexion->prepararConsulta($sql);

        if (!$stmt) {
            error_log("Prepare failed for ColaboradorDAO::actualizar: Error en SQL o conexión.");
            return false;
        }

        $stmt->bind_param("sssi", $nombre, $tipo_residuo, $servicio_ofrecido, $idColaborador);

        if ($stmt->execute()) {
            $affected_rows = $stmt->affected_rows;
            $stmt->close();
            return $affected_rows > 0;
        } else {
            error_log("Execute failed for ColaboradorDAO::actualizar: " . $stmt->error);
            $stmt->close();
            return false;
        }
    }
}
?>