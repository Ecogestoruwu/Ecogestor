<?php
require_once (__DIR__ . '/../persistencia/Conexion.php');
require_once (__DIR__ . '/../persistencia/ColaboradorDAO.php');
require_once (__DIR__ . '/../persistencia/CuentaDAO.php'); // Para actualizar correo
require_once (__DIR__ . '/Cuenta.php');

class Colaborador{
    private $idColaborador;
    private $nombre;
    private $tipo_residuo;
    private $servicio_ofrecido;
    private $cuenta; // Objeto Cuenta

    public function __construct($idColaborador = 0, $nombre = "", $tipo_residuo = "", $servicio_ofrecido = "", $cuenta = null){
        $this->idColaborador = $idColaborador;
        $this->nombre = $nombre;
        $this->tipo_residuo = $tipo_residuo;
        $this->servicio_ofrecido = $servicio_ofrecido;
        $this->cuenta = $cuenta; // Debe ser un objeto Cuenta
    }

    public function registrar($nombre, $tipo_residuo, $servicio_ofrecido, $idCuenta){
        $conexion = new Conexion();
        $conexion->abrirConexion();
        $colaboradorDAO = new ColaboradorDAO();
        $success = $colaboradorDAO->registrar($conexion, $nombre, $tipo_residuo, $servicio_ofrecido, $idCuenta);
        $conexion->cerrarConexion();
        return $success;
    }

    public function consultarCuenta(Cuenta $cuentaObject){
        $conexion = new Conexion();
        $conexion->abrirConexion();
        $colaboradorDAO = new ColaboradorDAO();
        $idCuenta = $cuentaObject->getIdCuenta();
        $datosColaborador = $colaboradorDAO->consultarCuenta($conexion, $idCuenta);
        $conexion->cerrarConexion();

        if (!$datosColaborador) {
            return false;
        }
        $this->idColaborador = $datosColaborador['idColaborador'];
        $this->nombre = $datosColaborador['nombre'];
        $this->tipo_residuo = $datosColaborador['tipo_residuo'];
        $this->servicio_ofrecido = $datosColaborador['servicio_ofrecido'];
        $this->cuenta = $cuentaObject; // Asigna el objeto Cuenta
        return true;
    }

    /**
     * Actualiza los datos del colaborador y opcionalmente el correo.
     * @param string $nuevoNombre
     * @param string $nuevoTipoResiduo
     * @param string $nuevoServicioOfrecido
     * @param string $nuevoCorreo
     * @return array ['success' => bool, 'message' => string]
     */
    public function actualizarMisDatos($nuevoNombre, $nuevoTipoResiduo, $nuevoServicioOfrecido, $nuevoCorreo) {
        $conexion = new Conexion();
        $conexion->abrirConexion();
        $colaboradorDAO = new ColaboradorDAO();
        $cuentaDAO = new CuentaDAO();

        $datosActualizados = false;
        $correoActualizado = false;
        $mensajeGlobal = "";

        // 1. Actualizar datos específicos del Colaborador
        if ($this->nombre !== $nuevoNombre || $this->tipo_residuo !== $nuevoTipoResiduo || $this->servicio_ofrecido !== $nuevoServicioOfrecido) {
            if ($colaboradorDAO->actualizar($conexion, $this->idColaborador, $nuevoNombre, $nuevoTipoResiduo, $nuevoServicioOfrecido)) {
                $this->nombre = $nuevoNombre;
                $this->tipo_residuo = $nuevoTipoResiduo;
                $this->servicio_ofrecido = $nuevoServicioOfrecido;
                $datosActualizados = true;
            } else {
                // Error o no cambios
            }
        }

        // 2. Actualizar correo en la tabla Cuenta (si ha cambiado)
        // (Misma lógica que en Usuario->actualizarMisDatos para el correo)
        if ($this->cuenta && $this->cuenta->getCorreo() !== $nuevoCorreo) {
            if (empty($nuevoCorreo) || !filter_var($nuevoCorreo, FILTER_VALIDATE_EMAIL)) {
                 $mensajeGlobal .= "El nuevo correo electrónico no es válido. ";
            } else if ($cuentaDAO->verificarCorreoExistente($conexion, $nuevoCorreo, $this->cuenta->getIdCuenta())) {
                $mensajeGlobal .= "El nuevo correo electrónico ('" . htmlspecialchars($nuevoCorreo) . "') ya está en uso por otro usuario. ";
            } else {
                if ($cuentaDAO->actualizarCorreo($conexion, $this->cuenta->getIdCuenta(), $nuevoCorreo)) {
                    $this->cuenta->setCorreo($nuevoCorreo);
                    $correoActualizado = true;
                } else {
                     $mensajeGlobal .= "No se pudo actualizar el correo electrónico. ";
                }
            }
        }
        $conexion->cerrarConexion();

        if ($datosActualizados && $correoActualizado) {
            $mensajeGlobal = "Datos del colaborador y correo actualizados correctamente.";
             return ['success' => true, 'message' => $mensajeGlobal];
        } elseif ($datosActualizados) {
            $mensajeGlobal = "Datos del colaborador actualizados. " . $mensajeGlobal;
             return ['success' => true, 'message' => $mensajeGlobal];
        } elseif ($correoActualizado) {
            $mensajeGlobal = "Correo actualizado. " . $mensajeGlobal;
             return ['success' => true, 'message' => $mensajeGlobal];
        } elseif (empty($mensajeGlobal) && ($this->nombre === $nuevoNombre && $this->tipo_residuo === $nuevoTipoResiduo && $this->servicio_ofrecido === $nuevoServicioOfrecido && $this->cuenta && $this->cuenta->getCorreo() === $nuevoCorreo)) {
            return ['success' => true, 'message' => "No se realizaron cambios."];
        } else {
            if(empty($mensajeGlobal)) $mensajeGlobal = "No se pudo actualizar la información o no hubo cambios detectados.";
            return ['success' => false, 'message' => $mensajeGlobal];
        }
    }

    // Getters y Setters
    public function getIdColaborador() { return $this->idColaborador; }
    public function setIdColaborador($idColaborador) { $this->idColaborador = $idColaborador; }
    public function getNombre() { return $this->nombre; }
    public function setNombre($nombre) { $this->nombre = $nombre; }
    public function getTipoResiduo() { return $this->tipo_residuo; }
    public function setTipoResiduo($tipo_residuo) { $this->tipo_residuo = $tipo_residuo; }
    public function getServicioOfrecido() { return $this->servicio_ofrecido; }
    public function setServicioOfrecido($servicio_ofrecido) { $this->servicio_ofrecido = $servicio_ofrecido; }
    public function getCuenta() { return $this->cuenta; } // Devuelve el objeto Cuenta
    public function setCuenta(Cuenta $cuenta) { $this->cuenta = $cuenta; } // Acepta un objeto Cuenta
}
?>