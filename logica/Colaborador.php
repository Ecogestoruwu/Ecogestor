<?php
require_once (__DIR__ . '/../persistencia/Conexion.php');
require_once (__DIR__ . '/../persistencia/ColaboradorDAO.php');
require_once (__DIR__ . '/../persistencia/CuentaDAO.php'); // Para actualizar correo
require_once (__DIR__ . '/Cuenta.php');

class Colaborador{
    private $idColaborador;
    private $nombre;
    private $servicio_ofrecido;
    private $cuenta; // Debe ser un objeto Cuenta

    public function __construct($idColaborador = 0, $nombre = "", $servicio_ofrecido = "", $cuenta = null){
        $this->idColaborador = $idColaborador;
        $this->nombre = $nombre;
        $this->servicio_ofrecido = $servicio_ofrecido;
        $this->cuenta = $cuenta;
    }

    public function registrar($nombre, $servicio_ofrecido, $idCuenta){
        $conexion = new Conexion();
        $conexion->abrirConexion();
        $colaboradorDAO = new ColaboradorDAO();
        $success = $colaboradorDAO->registrar($conexion, $nombre, $servicio_ofrecido, $idCuenta);
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
            error_log("COLABORADOR LOGIC: No details found for colaborador with idCuenta: " . $idCuenta);
            return false;
        }
        $this->idColaborador = $datosColaborador['idColaborador'];
        $this->nombre = $datosColaborador['nombre'];
        $this->servicio_ofrecido = $datosColaborador['servicio_ofrecido'];
        $this->cuenta = $cuentaObject;
        return true;
    }

    /**
     * Actualiza los datos del colaborador y opcionalmente el correo.
     * @param string $nuevoNombre
     * @param string $nuevoServicioOfrecido
     * @param string $nuevoCorreo
     * @return array ['success' => bool, 'message' => string]
     */
    public function actualizarMisDatos($nuevoNombre, $nuevoServicioOfrecido, $nuevoCorreo) {
        if (!$this->cuenta || !$this->idColaborador) {
            return ['success' => false, 'message' => "Error: Datos del colaborador o cuenta no cargados."];
        }

        $conexion = new Conexion();
        $conexion->abrirConexion();
        $colaboradorDAO = new ColaboradorDAO();
        $cuentaDAO = new CuentaDAO();

        $cambiosRealizados = false; // Para rastrear si algo realmente cambió
        $mensajes = []; // Para acumular mensajes de éxito o error parcial

        // 1. Actualizar datos específicos del Colaborador
        // Solo actualiza si los datos han cambiado
        $colaboradorDataCambio = false;
        if ($this->nombre !== $nuevoNombre || $this->servicio_ofrecido !== $nuevoServicioOfrecido) {
            $colaboradorDataCambio = true;
        }

        if ($colaboradorDataCambio) {
            if ($colaboradorDAO->actualizar($conexion, $this->idColaborador, $nuevoNombre, $nuevoServicioOfrecido)) {
                $this->nombre = $nuevoNombre;
                $this->servicio_ofrecido = $nuevoServicioOfrecido;
                $mensajes[] = "Datos del perfil del colaborador actualizados.";
                $cambiosRealizados = true;
            } else {
                // Podría ser que la consulta falló o que los datos eran idénticos y no se afectaron filas.
                // Si affected_rows es 0 pero no hubo error SQL, no es necesariamente un fallo de la operación.
                $mensajes[] = "No se realizaron cambios en los datos del perfil del colaborador o hubo un error.";
            }
        }

        // 2. Actualizar correo en la tabla Cuenta (si ha cambiado y es válido)
        $correoDataCambio = false;
        if ($this->cuenta->getCorreo() !== $nuevoCorreo) {
            $correoDataCambio = true;
        }

        if ($correoDataCambio) {
            if (empty($nuevoCorreo) || !filter_var($nuevoCorreo, FILTER_VALIDATE_EMAIL)) {
                $mensajes[] = "El nuevo correo electrónico proporcionado no es válido.";
            } else if ($cuentaDAO->verificarCorreoExistente($conexion, $nuevoCorreo, $this->cuenta->getIdCuenta())) {
                $mensajes[] = "El nuevo correo electrónico ('" . htmlspecialchars($nuevoCorreo) . "') ya está en uso por otro usuario.";
            } else {
                if ($cuentaDAO->actualizarCorreo($conexion, $this->cuenta->getIdCuenta(), $nuevoCorreo)) {
                    $this->cuenta->setCorreo($nuevoCorreo); // Actualiza el correo en el objeto Cuenta asociado
                    $mensajes[] = "Correo electrónico actualizado.";
                    $cambiosRealizados = true;
                } else {
                    $mensajes[] = "No se pudo actualizar el correo electrónico o ya era el mismo.";
                }
            }
        }
        
        $conexion->cerrarConexion();

        if (!$colaboradorDataCambio && !$correoDataCambio) {
            return ['success' => true, 'message' => "No se detectaron cambios para actualizar."];
        }

        if ($cambiosRealizados) {
             // Si al menos una operación fue exitosa y resultó en un cambio.
            return ['success' => true, 'message' => implode(" ", $mensajes)];
        } else {
            // Si no se realizó ningún cambio efectivo o todas las operaciones que intentaron cambios fallaron.
            if (empty($mensajes)) $mensajes[] = "No se pudo actualizar la información o no hubo cambios efectivos.";
            return ['success' => false, 'message' => implode(" ", $mensajes)];
        }
    }

    // Getters y Setters
    public function getIdColaborador() { return $this->idColaborador; }
    public function setIdColaborador($idColaborador) { $this->idColaborador = $idColaborador; }
    public function getNombre() { return $this->nombre; }
    public function setNombre($nombre) { $this->nombre = $nombre; }
    public function getServicioOfrecido() { return $this->servicio_ofrecido; }
    public function setServicioOfrecido($servicio_ofrecido) { $this->servicio_ofrecido = $servicio_ofrecido; }
    public function getCuenta() { return $this->cuenta; }
    public function setCuenta(Cuenta $cuenta) { $this->cuenta = $cuenta; }
}
?>