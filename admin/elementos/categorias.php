<?php
    // mostrar errores de php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    // echo '<pre>';
    // var_dump($_GET['resultado']);
    // echo '</pre>';
    //Importar la conexion
    require '../../includes/config/database.php';
    $db  = conectarDB();

    //Escribir el query
    $query = "SELECT * FROM categorias";

    //Consultar la BD
    $resultadoConsulta = mysqli_query($db, $query);

    $resultado = $_GET['resultado'] ?? null;


    $elemento = 'Categoria';
    $volver = 'index';
    $agregarElemento = true;

    require '../../includes/funciones.php';
    
    $nombrePagina = 'Categorias';
    incluirTemplate('header-doc',$agregarElemento, $elemento , $volver, $nombrePagina);
    incluirTemplate('header-user');

    incluirTemplate('barra-menu', $agregarElemento, $elemento, $volver);
?>

    <div class="contenedor">
        <?php if(intval($resultado) === 1): ?>
            <p class="alerta exito">Guardado Correctamente</p>
            <?php elseif(intval($resultado) === 2): ?>
                <p class="alerta exito">Actualizado Correctamente</p>
        <?php endif ?>
    </div>

    <section class="lista-usuarios">
        <table class="tabla">
            <thead>
                <tr >
                    <th class="tabla__encabenzados">ID</th>
                    <th class="tabla__encabenzados">NOMBRE</th>
                    <th class="tabla__encabenzados">IMAGEN</th>
                    <th class="tabla__encabenzados">OPCIONES</th>
                </tr>
            </thead>
            
            <tbody>
                <?php while($categoria = mysqli_fetch_assoc($resultadoConsulta)): ?>
                    <tr>
                        <td><?php echo $categoria['id'] ?></td>
                        <td> <?php echo $categoria['nombre'] ?> </td>
                        <td><img src="/catalogos-php/imagenes/<?php echo $categoria['imagen'] ?>" alt="imagen categoria" class="imagen imagen--medium "></td>
                        <td>
                            <a href="/catalogos-php/admin/elementos/actualizarCategoria.php?id=<?php echo $categoria['id']; ?>" class="boton boton--small boton--cuadrado boton--noborder boton--naranja">Editar</a>
                            <a href="#" class="boton boton--small boton--cuadrado boton--noborder boton--rojo">Eliminar</a>
                        </td>
                    </tr> 
                <?php endwhile; ?>
            </tbody>  
            
        </table>
    </section>
    <script src="/catalogos-php/build/js/app.js"></script>
</body>
</html>