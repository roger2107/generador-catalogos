<?php
    $menuAdmin = true;
    include'./includes/templates/header-doc.php';
    include'./includes/templates/header-user.php';
?>
    <section class="menu-admin ">
        <div class="contenedor-menu contenedor">
            <a href="usuarios.php">
                <div class="menu-opcion">
                    <img class="menu-opcion__icono" src="build/img/icono-usuario.png" alt="usuarios">
                    <p class="menu-opcion__texto">Usuarios</p>
                </div>
            </a>
            <a href="productos.php">
                <div class="menu-opcion">
                    <img class="menu-opcion__icono" src="build/img/icono-producto.png" alt="usuarios">
                    <p class="menu-opcion__texto">Productos</p>
                </div>
            </a>
            <a href="categorias.php">
                <div class="menu-opcion">
                    <img class="menu-opcion__icono" src="build/img/icono-categoria.png" alt="usuarios">
                    <p class="menu-opcion__texto">Categorias</p>
                </div>
            </a>
            <a href="empresa.php">
                <div class="menu-opcion">
                    <img class="menu-opcion__icono" src="build/img/icono-empresa.png" alt="usuarios">
                    <p class="menu-opcion__texto">Empresa</p>
                </div>
            </a>
            <a href="catalogos.php">
                <div class="menu-opcion">
                    <img class="menu-opcion__icono" src="build/img/icono-catalogo.png" alt="usuarios">
                    <p class="menu-opcion__texto">Catálogos</p>
                </div>
            </a>
        </div>
    </section>
</body>
</html>