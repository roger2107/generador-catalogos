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

    //Database
    require '../../includes/config/database.php';
    $db  = conectarDB();
    
    //Arreglo con mensajes de error
    $errores =[];
    //Variables para autollenado
    $nombre = '';
    $imagen = '';

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $nombre = mysqli_real_escape_string($db, $_POST["nombre"]);
        
        $imagen = $_FILES['imagen'];

        if(strlen($nombre) < 10 || strlen($nombre) >20){
            $errores[] = 'EL CAMPO NOMBRE DEBE TENER ENTRE 10 Y 20 CARACTERES';
        }
        if(!$imagen['name']|| $imagen['error']){
            $errores[] = 'EL CAMPO IMAGEN ES NECESARIO';
        }

        //Validar el tamaño de la imagen
        $medida = 1000 *600;
        if($imagen['size']>$medida){
            $errores[] = 'LA IMAGEN DEBE SER MENOR A 600KB';
        }

        //var_dump($errores);
        if(empty($errores)){


            $carpetaImagenes = '../../imagenes/';
            
            if(!is_dir($carpetaImagenes)){
                mkdir($carpetaImagenes);
            }

            //GENERAR NOMBRE DE LA IMAGEN
            $nombreImagen = md5( uniqid( rand(), true ) )  . '.jpg';

            //SUBIR LA IMAGEN
            move_uploaded_file($imagen['tmp_name'], $carpetaImagenes  . $nombreImagen);


            $query = "INSERT INTO categorias (nombre, imagen) VALUES ( '$nombre' , '$nombreImagen')";
            // echo $query;
            // exit;
            $resultado = mysqli_query($db, $query);

            if($resultado){
                header('Location: /catalogos-php/admin/elementos/categorias.php?resultado=1');
            }else{
                echo 'Hubo un error al insertar los datos';
            }
        }
    }

    //exit;



    $volver = 'elementos/categorias';
    
    incluirTemplate('header-doc');
    incluirTemplate('header-user', false,'','','',$_SESSION['usuario_username']);
    incluirTemplate('barra-menu', $agregarElemento=false, $elemento='' , $volver);
?>
    
    <section class="contenedor">
    <?php foreach($errores as $error): ?>

        <div class="alerta error">
            <?php echo $error; ?>
        </div>

    <?php  endforeach; ?>
        <form form action="/catalogos-php/admin/elementos/nuevocategoria.php" class="formulario" method="POST" enctype="multipart/form-data">
            <fieldset class="formulario__campos">
                <legend class="formulario__legend">Datos de la Categoria</legend>
                <div class="contenedor-campos contenedor--vertical">
                    <label class="formulario__label" for="categoria-nombre">Nombre</label>
                    <input class="formulario__input" type="text" name="nombre" id="categoria-nombre" value="<?php echo $nombre; ?>">
                </div>
                
                <div class="contenedor-campos contenedor--vertical">
                    <label class="formulario__label" for="categoria-imagen">Imagen</label>
                    <input class="formulario__input" type="file" accept="image/jpeg, image/png" name="imagen" id="categoria-imagen">
                </div>

                <input class="boton boton--cuadrado boton--noborder" type="submit" value="Guardar">
            </fieldset>
        </form>
        
    </section>
    <script src="/catalogos-php/build/js/app.js"></script>
</body>
</html>