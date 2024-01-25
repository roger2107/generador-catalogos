<?php

    
    // mostrar errores de php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    require '../includes/funciones.php';

    $auth = estaAutenticado();
    if(!$auth){
        header('Location: /catalogos-php/index.php');
    }

    $mostrarElemento = '';

    // var_dump($_SESSION['usuario_tipo']);
    // if(intval($_SESSION['usuario_tipo'])===0){
    //     $mostrarElemento = 'oculto';
    //     echo 'ocultar';
    // }else{
    //     $mostrarElemento = '';
    // }
    // echo '<pre>';
    // var_dump($_SESSION);
    // echo '</pre>';
    

    $menuAdmin = true;
    $volver = '';
    $nombrePagina ='';
    if( intval($_SESSION['usuario_tipo']) === 1 ){
        $nombrePagina = 'Menu Administrador';
    }else{
        $nombrePagina = 'Menu Usuario';
    }
    
    incluirTemplate('header-doc',$agregarElemento=false, $elemento='' , $volver, $nombrePagina);
    incluirTemplate('header-user', false,'','','',$_SESSION['usuario_username']);

    //incluirTemplate('barra-menu', $agregarElemento=false, $elemento='' , $volver);
?>
    <section class="menu-admin ">
        <div class="contenedor-menu contenedor">
        <?php if( intval($_SESSION['usuario_tipo']) === 1 ) : ?>
                <a href="/catalogos-php/admin/elementos/usuarios.php" >
                    <div class="menu-opcion  ">
                        <img class="menu-opcion__icono" src="/catalogos-php/build/img/icono-usuario.png" alt="usuarios">
                        <p class="menu-opcion__texto">Usuarios</p>
                    </div>
                </a>
                
                <a href="/catalogos-php/admin/elementos/productos.php" >
                    <div class="menu-opcion  ">
                        <img class="menu-opcion__icono" src="/catalogos-php/build/img/icono-producto.png" alt="usuarios">
                        <p class="menu-opcion__texto">Productos</p>
                    </div>
                </a>
                <a href="/catalogos-php/admin/elementos/categorias.php" >
                    <div class="menu-opcion  ">
                        <img class="menu-opcion__icono" src="/catalogos-php/build/img/icono-categoria.png" alt="usuarios">
                        <p class="menu-opcion__texto">Categorias</p>
                    </div>
                </a>
                <a href="/catalogos-php/admin/elementos/empresa.php" >
                    <div class="menu-opcion     ">
                        <img class="menu-opcion__icono" src="/catalogos-php/build/img/icono-empresa.png" alt="usuarios">
                        <p class="menu-opcion__texto">Empresa</p>
                    </div>
                </a>
            <?php endif ?>
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