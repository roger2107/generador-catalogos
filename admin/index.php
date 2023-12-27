<?php

    // mostrar errores de php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    $menuAdmin = true;
    $volver = '';

    require '../includes/funciones.php';
    
    $nombrePagina = 'Menu Administrador';
    incluirTemplate('header-doc',$agregarElemento=false, $elemento='' , $volver, $nombrePagina);
    incluirTemplate('header-user');

    //incluirTemplate('barra-menu', $agregarElemento=false, $elemento='' , $volver);
?>
    <section class="menu-admin ">
        <div class="contenedor-menu contenedor">
            <a href="/catalogos-php/admin/elementos/usuarios.php">
                <div class="menu-opcion">
                    <img class="menu-opcion__icono" src="/catalogos-php/build/img/icono-usuario.png" alt="usuarios">
                    <p class="menu-opcion__texto">Usuarios</p>
                </div>
            </a>
            <a href="/catalogos-php/admin/elementos/productos.php">
                <div class="menu-opcion">
                    <img class="menu-opcion__icono" src="/catalogos-php/build/img/icono-producto.png" alt="usuarios">
                    <p class="menu-opcion__texto">Productos</p>
                </div>
            </a>
            <a href="/catalogos-php/admin/elementos/categorias.php">
                <div class="menu-opcion">
                    <img class="menu-opcion__icono" src="/catalogos-php/build/img/icono-categoria.png" alt="usuarios">
                    <p class="menu-opcion__texto">Categorias</p>
                </div>
            </a>
            <a href="/catalogos-php/admin/elementos/empresa.php">
                <div class="menu-opcion">
                    <img class="menu-opcion__icono" src="/catalogos-php/build/img/icono-empresa.png" alt="usuarios">
                    <p class="menu-opcion__texto">Empresa</p>
                </div>
            </a>
            <a href="/catalogos-php/admin/elementos/catalogos.php">
                <div class="menu-opcion">
                    <img class="menu-opcion__icono" src="/catalogos-php/build/img/icono-catalogo.png" alt="usuarios">
                    <p class="menu-opcion__texto">Catálogos</p>
                </div>
            </a>
        </div>
    </section>
    <script src="/catalogos-php/build/js/app.js"></script>
</body>
</html>