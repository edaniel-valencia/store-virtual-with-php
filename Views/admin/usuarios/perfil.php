<?php include_once 'Views/template/header-admin.php'; ?>

<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <h4 class="page-title m-0">Tus datos</h4>
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end page-title-box -->
    </div>
</div>

<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><i class="fas fa-id-card"></i> Mis datos</h5>
                <hr>
                <form id="frmPerfil" autocomplete="off">
                    <div class="form-group">
                        <label>Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $data['usuario']['nombre']; ?>">
                    </div>
                    <div class="form-group">
                        <label>Apellido</label>
                        <input type="text" class="form-control" id="apellido" name="apellido" value="<?php echo $data['usuario']['apellido']; ?>">
                    </div>
                    <div class="form-group">
                        <label>Usuario</label>
                        <input type="text" class="form-control" id="usuario" name="usuario" value="<?php echo $data['usuario']['correo']; ?>">
                    </div>
                    <div class="form-group">
                        <label>Correo</label>
                        <input type="email" class="form-control" id="correo" name="correo" value="<?php echo $data['usuario']['correo']; ?>">
                    </div>
                    <div class="form-group">
                        <label>Dirección</label>
                        <input type="text" class="form-control" id="direccion" name="direccion" value="<?php echo $data['usuario']['direccion']; ?>">
                    </div>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Guardar cambios</button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><i class="fas fa-lock"></i> Cambiar contraseña</h5>
                <hr>
                <form id="frmPasword" autocomplete="off">
                    <div class="form-group">
                        <label>Contraseña actual</label>
                        <input type="password" class="form-control" id="actual" name="actual">
                    </div>
                    <div class="form-group">
                        <label>Nueva contraseña</label>
                        <input type="password" class="form-control" id="nueva" name="nueva">
                    </div>
                    <div class="form-group">
                        <label>Confirmar nueva contraseña</label>
                        <input type="password" class="form-control" id="confirmar" name="confirmar">
                    </div>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-key"></i> Cambiar contraseña</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include_once 'Views/template/footer-admin.php'; ?>

<script src="<?php echo asset('public/admin/js/page/perfil.js'); ?>"></script>

</body>

</html>
