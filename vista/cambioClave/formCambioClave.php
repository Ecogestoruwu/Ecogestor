<form method="post" action="validarClave.php">
    <div class="form-outline mb-4">
        <label class="form-label" for="changeCorreo">Correo Electrónico</label>
        <input type="email" id="changeCorreo" name="correo" class="form-control" placeholder="tu@correo.com" required />
    </div>

    <div class="form-outline mb-4">
        <label class="form-label" for="changeClave">Nueva contraseña.</label>
        <input type="password" id="changeClave" name="clave" class="form-control"
            placeholder="mínimo 5 caracteres, al menos 1 letra y 1 número." required />
    </div>

    <div class="form-outline mb-4">
        <label class="form-label" for="confirmClave">Confirmar Nueva Contraseña</label>
        <input type="password" id="confirmClave" name="confirm_clave" class="form-control"
            placeholder="Confirma tu nueva contraseña" required />
    </div>

    <button type="submit" class="btn btn-primary btn-block mb-4" name="cambioClave">Cambiar
        Contraseña</button>
</form>