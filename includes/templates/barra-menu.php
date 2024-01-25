<section class="seccion-usuarios">
        <div class="menu-usuarios">
            <?php if($agregarElemento){ ?>
                <a href="/catalogos-php/admin/elementos/<?php echo 'nuevo' . $elemento . '.php'; ?>" class="boton boton--cuadrado menu-usuarios__boton">
                <img class="menu-usuarios__icono" src="/catalogos-php/build/img/icono-agregar.png" alt="nuevo usuario">
                <p class="menu-usuarios__texto"><?php echo 'Agregar ' . $elemento; ?></p>
            </a> 
            <?php } ?>

            <a href="/catalogos-php/admin/<?php echo $volver . '.php' ?>"  class="boton boton--cuadrado menu-usuarios__boton">
                <img class="menu-usuarios__icono" src="/catalogos-php/build/img/icono-volver.png" alt="nuevo usuario">
                <p class="menu-usuarios__texto">Volver</p>
            </a>
        </div>
    </section>