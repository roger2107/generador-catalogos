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

    //Consulta para obtener las categorias
    $consulta = "SELECT * FROM categorias";
    $resultado = mysqli_query($db, $consulta);

    //Arreglo con mensajes de error
    $errores =[];
    //Variables para autollenado
    $nombre = '';
    $descripcion = '';
    $precio = '';
    $imagen = '';
    $categoriaId = "";

    if($_SERVER["REQUEST_METHOD"] === "POST"){
     

        $nombre = mysqli_real_escape_string($db, $_POST["nombre"]);
        $descripcion = mysqli_real_escape_string($db, $_POST["descripcion"]);
        //$precio = mysqli_real_escape_string ($db, $_POST["precio"]);
        $precio = $_POST["precio"];
        //var_dump($precio);
        //$imagen = mysqli_real_escape_string($db, $_POST["imagen"]);
        $categoriaId = mysqli_real_escape_string($db, $_POST["categoria"]);

        $imagen = $_FILES['imagen'];

       

        if(strlen($nombre) < 10 || strlen($nombre) >20){
            $errores[] = 'EL CAMPO NOMBRE DEBE TENER ENTRE 10 Y 20 CARACTERES';
        }
        if(strlen($descripcion) < 10 || strlen($descripcion) >20){
            $errores[] = 'EL CAMPO DESCRIPCION DEBE TENER ENTRE 10 Y 20 CARACTERES';
        }
        if(!$precio){
            $errores[] = 'EL CAMPO PRECIO ES NECESARIO';
        }
        if($categoriaId ===""){
            $errores[] = 'SELECCIONA UNA CATEGORIA';
        }
        if(!$imagen['name']|| $imagen['error']){
            $errores[] = 'EL CAMPO IMAGEN ES NECESARIO';
        }
        //Validar el tamaño de la imagen
        $medida = 1000 *600;
        if($imagen['size']>$medida){
            $errores[] = 'LA IMAGEN DEBE SER MENOR A 600KB';
        }

        // echo '<pre>';
        // var_dump($errores);
        // echo '</pre>';
        if(empty($errores)){

            /**SUBIDA DE ARCHIVOS */
            //CREAR CARPETA
            $carpetaImagenes = '../../imagenes/';
            
            if(!is_dir($carpetaImagenes)){
                mkdir($carpetaImagenes);
            }

            //GENERAR NOMBRE DE LA IMAGEN
            $nombreImagen = md5( uniqid( rand(), true ) ). '.jpg';

            //SUBIR LA IMAGEN
            move_uploaded_file($imagen['tmp_name'], $carpetaImagenes  . $nombreImagen );
            //exit;

            $query = "INSERT INTO productos (nombre, descripcion, precio, imagen, idcategoria) VALUES ( '$nombre' , '$descripcion' , '$precio' , '$nombreImagen' , '$categoriaId' )";
            echo $query;
            //exit;
            $resultado = mysqli_query($db, $query);

            if($resultado){
                header('Location: /catalogos-php/admin/elementos/productos.php?resultado=1');
            }else{
                echo 'Hubo un error al insertar los datos';
            }
        }
    }

    $volver = 'elementos/productos';
    $nombrePagina = 'Nuevo Producto';
    
    incluirTemplate('header-doc',$agregarElemento=false, $elemento='' , $volver, $nombrePagina);
    incluirTemplate('header-user', false,'','','',$_SESSION['usuario_username']);
    incluirTemplate('barra-menu', $agregarElemento=false, $elemento='' , $volver, $nombrePagina='');

    
   
?>
    
    <section class="contenedor">
        <?php foreach($errores as $error): ?>

            <div class="alerta error">
                <?php echo $error; ?>
            </div>
        
        <?php  endforeach; ?>
        <form action="/catalogos-php/admin/elementos/nuevoproducto.php" class="formulario" method="POST" enctype="multipart/form-data">
            <fieldset class="formulario__campos">
                <legend class="formulario__legend">Datos del Producto</legend>
                <div class="contenedor-campos contenedor--vertical">
                    <label class="formulario__label" for="">Nombre</label>
                    <input class="formulario__input" type="text" name="nombre" id="producto-nombre" value="<?php echo $nombre; ?>">
                </div>
                <div class="contenedor-campos contenedor--vertical">
                    <label class="formulario__label" for="">Descripcion</label>
                    <input class="formulario__input" type="text" name="descripcion" id="producto-descripcion" value="<?php echo $descripcion; ?>">
                </div>
                <div class="contenedor-campos contenedor--vertical">
                    <label class="formulario__label" for="">Precio</label>
                    <input class="formulario__input" type="number" name="precio" id="producto-precio" step="0.01" value="<?php echo $precio; ?>">
                </div>
                <div class="contenedor-campos contenedor--vertical">
                    <label class="formulario__label" for="">Imagen</label>
                    <input class="formulario__input" type="file" accept="image/jpeg" name="imagen" value="<?php echo $imagen; ?>">
                </div>
                <div class="contenedor-campos contenedor--vertical">
                    <label class="formulario__label" for="">Categoria</label>
                    <select id="producto-categoria"name="categoria" class="formulario__input">
                        <option value=""  selected >--Selecciona--</option>
                        <?php while($opcionCategoria = mysqli_fetch_assoc($resultado)): ?>
                            <option <?php echo $categoriaId === $opcionCategoria['id'] ? 'selected' : ''; ?> value="<?php echo $opcionCategoria['id']; ?>"><?php echo $opcionCategoria['nombre']; ?></option>
                        <?php endwhile; ?>
                        <!-- <option value="1">ABARROTES</option>
                        <option value="2">LIMPIEZA</option>
                        <option value="3">CUID. PERSONAL</option>
                        <option value="4">DULCERIA</option> -->
                    </select>
                </div>

                <input class="boton boton--cuadrado boton--noborder" type="submit" value="Guardar">
            </fieldset>
        </form>
        
    </section>
    <script src="/catalogos-php/build/js/app.js"></script>
</body>
</html>