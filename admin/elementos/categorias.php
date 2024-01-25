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

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $idEliminar = $_POST['id'];
        $idEliminar = filter_var($idEliminar, FILTER_VALIDATE_INT);

        if($idEliminar){

            //Eliminar el archivo
            $queryImagen = "SELECT imagen FROM categorias WHERE id = $idEliminar";
            
            $resultadoImagen = mysqli_query($db, $queryImagen);
            $categoria = mysqli_fetch_assoc($resultadoImagen);
            
            
            //exit;
            //Eliminar la propiedad
            try{
                $queryEliminar = "DELETE FROM categorias WHERE id = $idEliminar";
                $resultadoEliminar=mysqli_query($db, $queryEliminar);
                unlink('../../imagenes/'.$categoria['imagen']);
                if($resultadoEliminar){
                    header('Location: /catalogos-php/admin/elementos/categorias.php?resultado=3');
                }
            }catch(Exception $e){
                
                header('Location: /catalogos-php/admin/elementos/categorias.php?resultado=4');
                
            }
            

            
        }
    }
    
    $nombrePagina = 'Categorias';
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
                <p class="alerta exito">Eliminada Correctamente</p>
            <?php elseif(intval($resultado) === 4): ?>
                <p class="alerta error">La categoría tiene productos relacionados, elimine los productos antes de eliminar la categoria</p>
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
                            <form method="POST">
                                <input type="hidden" name="id" value="<?php echo $categoria['id'] ?>">
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