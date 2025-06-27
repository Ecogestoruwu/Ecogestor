<div class="table-scroll-wrapper">
    <table class="table table-bordered mb-0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Dirección</th>
                <th>Fecha de Solicitud</th>
                <th>Usuario</th>
                <th>Residuo</th>
                <th>Fecha Programada</th>
                <th>Estado</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($solicitudes as $solicitud): ?>
            <form method="POST" action="programarSolicitud.php">
                <tr>
                    <td>
                        <?= $solicitud->getId() ?>
                        <input type="hidden" name="id" value="<?= $solicitud->getId() ?>">
                    </td>
                    <td>
                        <?= $solicitud->getDireccion() ?>
                        <input type="hidden" name="direccion" value="<?= $solicitud->getDireccion() ?>">
                    </td>
                    <td>
                        <?= $solicitud->getFechaSolicitud() ?>
                        <input type="hidden" name="fecha_solicitud" value="<?= $solicitud->getFechaSolicitud() ?>">
                    </td>
                    <td>
                        <?= $solicitud->getUsuario()->getNombre() ?>
                        <input type="hidden" name="usuario_id" value="<?= $solicitud->getUsuario()->getIdUsuario() ?>">
                    </td>
                    <td>
                        <?= $solicitud->getResiduo()->getNombre() ?>
                        <input type="hidden" name="residuo_id" value="<?= $solicitud->getResiduo()->getId() ?>">
                    </td>
                    <td>
                        <input type="datetime-local" name="fecha_programada" value="<?= $solicitud->getFechaProgramada() 
                    ? date('Y-m-d\TH:i', strtotime($solicitud->getFechaProgramada()))
                    : '' 
                ?>" min="<?= date('Y-m-d\TH:i') ?>">
                    </td>
                    <td>
                        <?= $solicitud->getEstado() ?>
                        <input type="hidden" name="estado" value="<?= $solicitud->getEstado() ?>">
                    </td>
                    <td>
                        <input type="hidden" name="correoUsuario" value="<?= $solicitud->getUsuario()->getCuenta()->getCorreo()?>">
                        <input type="hidden" name="colaborador_id"
                            value="<?= $solicitud->getColaborador()->getIdColaborador() ?>">
                        <button type="submit" class="btn btn-sm btn-primary">Programar</button>
                    </td>
                </tr>
            </form>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>