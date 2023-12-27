<?php
    include'./includes/templates/header-doc.php';
?>
    <section class="seccion-login">
        
        <div class="contenedor-formulario">
            <img class="icono-login" src="build/img/icono-usuario.png" alt="icono login">
            <form class="formulario formulario--login" action="admin.php">
                <fieldset class="formulario__campos">
                    <!-- <legend>Inicia Sesión</legend> -->
                    <div class="contendor-campo">
                        <label class="label-login" for="usuario">Usuario</label>
                        <input type="text" name="usuario" required>
                    </div>
                    <div class="contendor-campo">
                        <label class="label-login" for="usuario">Contraseña</label>
                        <input type="password" name="password" id="" required>
                    </div>
                    <input class="boton" type="submit" value="Inicar Sesión">
                </fieldset>
            </form>
        </div>
    </section>
</body>
</html>