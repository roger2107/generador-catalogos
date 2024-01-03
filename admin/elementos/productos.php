<?php
    // mostrar errores de php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    require '../../includes/funciones.php';

    $auth = estaAutenticado();
    if(!$auth){
        header('Location: /catalogos-php/index.php');
    }
    if(intval($_SESSION['usuario_tipo']) === 0){
        header('Location: /catalogos-php/admin/index.php');
    }

    //Importar la conexion
    require '../../includes/config/database.php';
    $db  = conectarDB();

    //Escribir el query
    //$query = "SELECT * FROM productos";
    $query = "SELECT productos.id AS id, productos.nombre AS nombre, productos.descripcion AS descripcion, productos.precio AS precio, productos.imagen AS imagen,
    categorias.nombre AS nombreCategoria FROM productos JOIN categorias WHERE productos.idcategoria = categorias.id;";

    //Consultar la BD
    $resultadoConsulta = mysqli_query($db, $query);
   
    $resultado = $_GET['resultado'] ?? null;

    $elemento = 'Producto';
    $volver = 'index';
    $agregarElemento = true;

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $idEliminar = $_POST['id'];
        $idEliminar = filter_var($idEliminar, FILTER_VALIDATE_INT);

        if($idEliminar){

            //Eliminar el archivo
            $queryImagen = "SELECT imagen FROM productos WHERE id = $idEliminar";
            
            $resultadoImagen = mysqli_query($db, $queryImagen);
            $producto = mysqli_fetch_assoc($resultadoImagen);
            unlink('../../imagenes/'.$producto['imagen']);
            
            //exit;
            //Eliminar la propiedad
            $queryEliminar = "DELETE FROM productos WHERE id = $idEliminar";
            $resultadoEliminar=mysqli_query($db, $queryEliminar);

            if($resultadoEliminar){
                header('Location: /catalogos-php/admin/elementos/productos.php?resultado=3');
            }
        }
    }
    
    $nombrePagina = 'Productos';
    incluirTemplate('header-doc',$agregarElemento, $elemento , $volver, $nombrePagina);
    incluirTemplate('header-user', false,'','','',$_SESSION['usuario_username']);

    incluirTemplate('barra-menu', $agregarElemento, $elemento, $volver);
?>
    

    <div class="contenedor">
        <?php if(intval($resultado) === 1): ?>
            <p class="alerta exito">Guardado Correctamente</p>
            <?php elseif(intval($resultado) === 2): ?>
                <p class="alerta exito">Actualizado Correctamente</p>
            <?php elseif(intval($resultado) === 3): ?>
                <p class="alerta exito">Eliminado Correctamente</p>
                
        <?php endif ?>
    </div>
    
    
    <section class="lista-usuarios">
        
        <table class="tabla tabla--usuarios">
            <thead>
                <tr >
                    <th class="tabla__encabenzados">ID</th>
                    <th class="tabla__encabenzados">NOMBRE</th>
                    <th class="tabla__encabenzados">DESCRIPCION</th>
                    <th class="tabla__encabenzados">PRECIO</th>
                    <th class="tabla__encabenzados">IMAGEN</th>
                    <th class="tabla__encabenzados">CATEGORIA</th>
                    <th class="tabla__encabenzados">OPCIONES</th>
                </tr>
            </thead>
            
            <tbody> <!-- MOSTRAR LOS DATOS -->
                <?php while($producto = mysqli_fetch_assoc($resultadoConsulta)): ?>
                    <tr>
                        <td> <?php echo $producto['id'] ?> </td>
                        <td> <?php echo $producto['nombre'] ?> </td>
                        <td> <?php echo $producto['descripcion'] ?> </td>
                        <td> <?php echo $producto['precio'] ?> </td>
                        <td><img src="/catalogos-php/imagenes/<?php echo $producto['imagen'] ?>" alt="imagen producto" class="imagen--medium "></td>
                        <td> <?php echo $producto['nombreCategoria'] ?> </td>
                        <td>
                            <a href="/catalogos-php/admin/elementos/actualizarProducto.php?id=<?php echo $producto['id'] ?>" class="boton boton--small boton--cuadrado boton--noborder boton--naranja">Editar</a>
                            <form method="POST">
                                <input type="hidden" name="id" value="<?php echo $producto['id'] ?>">
                                <input type="submit" class="boton boton--small boton--cuadrado boton--noborder boton--rojo" value="Eliminar">
                            </form>
                            
                        </td>
                    </tr>   
                <?php endwhile; ?>
            </tbody>
                   
        </table>
    </section>
    <script src="/catalogos-php/build/js/app.js"></script>
</body>
</html>

<?php 
//CERRAR LA CONEXION
mysqli_close($db);
?>