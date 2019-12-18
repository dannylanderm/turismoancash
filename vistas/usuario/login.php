<div class="container">
    <form class="login-form" method="post" action="vistas/usuario/proceso/usuario_login.php">
        <?php echo isset($errorLogin) ? $errorLogin : ''; ?>
        <div class="login-wrap" style='text-align: center'>
            <p class="login-img"><i class="fa fa-lock"></i></p>
            <h3>Intranet - Turismo Ancash</h3>
            <div class="input-group">
                <span class="input-group-addon"><span class="fa fa-user"></span></span>
                <input type="text" name="txtLogin" placeholder="Ingresar Usuario" class="form-control" autofocus
                       required>
            </div>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                <input type="password" name="txtPwd" placeholder="Contraseña" class="form-control" required>
            </div>
            <button name="token" type="submit" class="btn btn-primary btn-lg btn-block">Iniciar Session</button>
        </div>
    </form>
</div>