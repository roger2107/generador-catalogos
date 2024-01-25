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

    $id= $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if(!$id){
        header('Location: /catalogos-php/admin/elementos/categorias.php');
    }


    //Database
    require '../../includes/config/database.php';
    $db  = conectarDB();

    //Consultar producto con el id indicado en la URL
    $consultaCategoria = "SELECT * FROM categorias WHERE id= $id";
    $resultadoConsultaCategoria = mysqli_query($db, $consultaCategoria);
    $categoria = mysqli_fetch_assoc($resultadoConsultaCategoria);
    
    //Arreglo con mensajes de error
    $errores =[];
    //Variables para autollenado
    $nombre = $categoria['nombre'];
    $imagen = $categoria['imagen'];

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        // echo '<pre>';
        // var_dump($_POST);
        // echo '</pre>';
        $nombre = mysqli_real_escape_string($db, $_POST["nombre"]);
        
        $imagen = $_FILES['imagen'];

        if(!$nombre){
            $errores[] = 'EL CAMPO NOMBRE ES NECESARIO';
        }
        // if(!$imagen['name']|| $imagen['error']){
        //     $errores[] = 'EL CAMPO IMAGEN ES NECESARIO';
        // }

        //Validar el tamaño de la imagen
        $medida = 1000 *600;
        if($imagen['size']>$medida){
            $errores[] = 'LA IMAGEN DEBE SER MENOR A 600KB';
        }

        //var_dump($errores);
        if(empty($errores)){

            //crear carpeta
            $carpetaImagenes = '../../imagenes/';
            
            if(!is_dir($carpetaImagenes)){
                mkdir($carpetaImagenes);
            }

            $nombreImagen = '';

            /**SUBIDA DE ARCHIVOS */
            if($imagen['name']){ //SI SE SUBE UNA NUEVA IMAGEN
                //echo $producto['imagen'];
                if($categoria['imagen'] === 'default.jpg'){
                    //echo 'la imagen  era el default';
                    //GENERAR NOMBRE DE LA IMAGEN
                    $nombreImagen = md5( uniqid( rand(), true ) ). '.jpg';

                    //SUBIR LA IMAGEN
                    move_uploaded_file($imagen['tmp_name'], $carpetaImagenes  . $nombreImagen );
                }else{
                    ///ELIMINAMOS LA IMAGEN PREVIA 
                    unlink($carpetaImagenes . $categoria['imagen']);

                    //GENERAR NOMBRE DE LA IMAGEN
                    $nombreImagen = md5( uniqid( rand(), true ) ). '.jpg';

                    //SUBIR LA IMAGEN
                    move_uploaded_file($imagen['tmp_name'], $carpetaImagenes  . $nombreImagen );
                }
                //ELIMINAMOS LA IMAGEN PREVIA 
                //unlink($carpetaImagenes . $producto['imagen']);
        }else{
                $nombreImagen = $categoria['imagen'];
        }


            $query = "UPDATE categorias SET nombre = '$nombre', imagen = '$nombreImagen' WHERE id = $id ";
            
             //echo $query;
             //exit;
            $resultado = mysqli_query($db, $query);

            if($resultado){
                header('Location: /catalogos-php/admin/elementos/categorias.php?resultado=2');
            }else{
                echo 'Hubo un error al insertar los datos';
            }
        }
    }

    //exit;
    
    //incluirTemplate('header-doc');
    $volver = 'elementos/categorias';
    $nombrePagina = 'Editar Categoria';
    
    incluirTemplate('header-doc',$agregarElemento=false, $elemento='' , $volver, $nombrePagina);
    incluirTemplate('header-user', false,'','','',$_SESSION['usuario_username']);
    incluirTemplate('barra-menu', $agregarElemento=false, $elemento='' , $volver);
?>
    
    <section class="contenedor">
    <?php foreach($errores as $error): ?>

        <div class="alerta error">
            <?php echo $error; ?>
        </div>

    <?php  endforeach; ?>
        <form form  class="formulario" method="POST" enctype="multipart/form-data">
            <fieldset class="formulario__campos">
                <legend class="formulario__legend">Datos de la Categoria</legend>
                <div class="contenedor-campos contenedor--vertical">
                    <label class="formulario__label" for="categoria-nombre">Nombre</label>
                    <input class="formulario__input" type="text" name="nombre" id="categoria-nombre" value="<?php echo $nombre; ?>">
                </div>
                
                <div class="contenedor-campos contenedor--vertical">
                    <label class="formulario__label" for="categoria-imagen">Imagen</label>
                    <input class="formulario__input" type="file" accept="image/jpeg, image/png" name="imagen" id="categoria-imagen" value="<?php echo $imagen; ?>">
                    <img src="/catalogos-php/imagenes/<?php echo $imagen  ?>" alt="imagen categoria" class="imagen-small">
                </div>

                <input class="boton boton--cuadrado boton--noborder" type="submit" value="Guardar">
            </fieldset>
        </form>
        
    </section>
    <script src="/catalogos-php/build/js/app.js"></script>
</body>
</html>