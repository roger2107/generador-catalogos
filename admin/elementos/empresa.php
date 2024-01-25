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

    $id = '';
    $nombre = '';
    $direccion ='';
    $telefono='';
    $email ='';
    $whatsapp ='';
    $facebook='';
    $instagram ='';
    $website ='';
    $logo ='';

    //Comprueba si hay  un resultado en la URL para mostrar mensajes condicionales
    $resultado = $_GET['resultado'] ?? null;

    //Consulta para obtener los datoa de la empresa
    $consulta = "SELECT * FROM empresa";
    $resultadoConsultaSelect = mysqli_query($db, $consulta);
    $datos = mysqli_fetch_assoc($resultadoConsultaSelect);

    $errores =[];
    //Habilitar o deshabilitar campos
    $habilitados = '';
    // echo '<pre>';
    // var_dump($datos['nombre']);
    // echo '</pre>';
    //Variables para autollenado
    

    if(isset($datos['id'])){
        //SI YA HAY DATOS ENTONCES VAMOS A HACER UN UPDATE
        //echo 'Si hay datos';
        $habilitados = 'disabled';
        //Variables para autollenado
        $id = $datos['id'];
        $nombre = $datos['nombre'];
        $direccion =$datos['direccion'];
        $telefono=$datos['telefono'];
        $email =$datos['email'];
        $whatsapp =$datos['whatsapp'];
        $facebook=$datos['facebook'];
        $instagram =$datos['instagram'];
        $website =$datos['website'];
        $logo =$datos['logo'];

        
        if($_SERVER["REQUEST_METHOD"] === "POST"){ //////CODIGO PARA ACTUALIZAR LOS DATOS DE LA EMPRESA
            echo 'ACTUALIZANDO';
            // echo '<pre>';
            // var_dump($_POST);
            // echo '</pre>';
            $id = mysqli_real_escape_string($db,$_POST['id']);
            $nombre = mysqli_real_escape_string($db,$_POST['nombre']);
            $direccion =mysqli_real_escape_string($db,$_POST['direccion']);
            $telefono=mysqli_real_escape_string($db,$_POST['telefono']);
            $email =mysqli_real_escape_string($db,$_POST['email']);
            $whatsapp =mysqli_real_escape_string($db,$_POST['whatsapp']);
            $facebook=mysqli_real_escape_string($db,$_POST['facebook']);
            $instagram =mysqli_real_escape_string($db,$_POST['instagram']);
            $website =mysqli_real_escape_string($db,$_POST['website']);
            $logo = $_FILES['logo'];

            

            if(strlen($nombre) < 5 || strlen($nombre) >40){
                $errores[] = 'EL CAMPO NOMBRE DEBE TENER ENTRE 5 Y 40 CARACTERES';
            }
            if(strlen($telefono) !== 10){
                $errores[] = 'EL CAMPO TELEFONO DEBE TENER 10 CARACTERES';
            }
            if(strlen($email) < 10 || strlen($email) >40){
                $errores[] = 'EL CAMPO EMAIL DEBE TENER ENTRE 10 Y 40 CARACTERES';
            }
            if(!$logo){
                $errores[] = 'EL CAMPO LOGOTIPO ES NECESARIO';
            }
            //Validar el tamaño del logo
            $medida = 1000 *600;
            if($logo['size']>$medida){
                $errores[] = 'EL LOGO DEBE SER MENOR A 600KB';
            }
            if(empty($errores)){
                //CREAR CARPETA
                $carpetaImagenes = '../../imagenes/';
                
                if(!is_dir($carpetaImagenes)){
                    mkdir($carpetaImagenes);
                }

                $nombreImagen = '';

                if($logo['name']){  //SI SE SUBE UNA NUEVA IMAGEN
                    ///ELIMINAMOS LA IMAGEN PREVIA 
                    unlink($carpetaImagenes . $datos['logo']);

                    //GENERAR NOMBRE DE LA IMAGEN
                    $nombreImagen = 'logo.jpg';

                    //SUBIR LA IMAGEN
                    move_uploaded_file($logo['tmp_name'], $carpetaImagenes  . $nombreImagen );
                }else{
                    $nombreImagen = $datos['logo'];
                }
                

                $query = "UPDATE empresa SET nombre = '$nombre', direccion = '$direccion', telefono = '$telefono' , email = '$email', whatsapp = '$whatsapp', facebook = '$facebook' , instagram = '$instagram', website = '$website', logo = '$nombreImagen' WHERE id = $id";
                //echo $query;
                //exit;
                $resultadoConsultaUpdate = mysqli_query($db, $query);

                if($resultadoConsultaUpdate){
                    header('Location: /catalogos-php/admin/elementos/empresa.php?resultado=2');
                }else{
                    echo 'Hubo un error al insertar los datos';
                }
            }
        }
    }
    else{
        //SI AUN NO HAY DATOS
        //echo 'No hay datos';
        if($_SERVER["REQUEST_METHOD"] === "POST"){
            
            //TOMAMMOS LOS DATOS DEL FORMULARIO Y HACEMOS UN INSERT
            $id = mysqli_real_escape_string($db,$_POST['id']);
            $nombre = mysqli_real_escape_string($db,$_POST['nombre']);
            $direccion =mysqli_real_escape_string($db,$_POST['direccion']);
            $telefono=mysqli_real_escape_string($db,$_POST['telefono']);
            $email =mysqli_real_escape_string($db,$_POST['email']);
            $whatsapp =mysqli_real_escape_string($db,$_POST['whatsapp']);
            $facebook=mysqli_real_escape_string($db,$_POST['facebook']);
            $instagram =mysqli_real_escape_string($db,$_POST['instagram']);
            $website =mysqli_real_escape_string($db,$_POST['website']);
            $logo = $_FILES['logo'];

            if(strlen($nombre) < 5 || strlen($nombre) >40){
                $errores[] = 'EL CAMPO NOMBRE DEBE TENER ENTRE 5 Y 40 CARACTERES';
            }
            if(strlen($telefono) !== 10){
                $errores[] = 'EL CAMPO TELEFONO DEBE TENER 10 CARACTERES';
            }
            if(strlen($email) < 10 || strlen($email) >40){
                $errores[] = 'EL CAMPO EMAIL DEBE TENER ENTRE 10 Y 40 CARACTERES';
            }
            if(!$logo){
                $errores[] = 'EL CAMPO LOGOTIPO ES NECESARIO';
            }
            //Validar el tamaño del logo
            $medida = 1000 *600;
            if($logo['size']>$medida){
                $errores[] = 'EL LOGO DEBE SER MENOR A 600KB';
            }

            if(empty($errores)){
                $carpetaImagenes = '../../imagenes/';
                
                if(!is_dir($carpetaImagenes)){
                    mkdir($carpetaImagenes);
                }

                $nombreImagen = 'logo.jpg';
                move_uploaded_file($logo['tmp_name'], $carpetaImagenes  . $nombreImagen );


                $query = "INSERT INTO empresa (nombre, direccion, telefono, email, whatsapp, facebook, instagram, website, logo) VALUES ( '$nombre' , '$direccion' , '$telefono' , '$email', '$whatsapp', '$facebook', '$instagram', '$website', '$nombreImagen' )";
                //echo $query;
                $resultadoConsultaInsert = mysqli_query($db, $query);

                if($resultadoConsultaInsert){
                    header('Location: /catalogos-php/admin/elementos/empresa.php?resultado=1');
                }else{
                    echo 'Hubo un error al insertar los datos';
                }
            }
        }
        
    }

 

    $vistaTabla = true;
    $volver = 'index';

    $nombrePagina = 'Datos de la empresa';
    incluirTemplate('header-doc',$agregarElemento=false, $elemento='' , $volver, $nombrePagina);
    incluirTemplate('header-user', false,'','','',$_SESSION['usuario_username']);

    incluirTemplate('barra-menu', $agregarElemento=false, $elemento='' , $volver);
?>

    <div class="contenedor">
        <?php if(intval($resultado) === 1): ?>
            <p class="alerta exito">Guardado Correctamente</p>
            <?php elseif(intval($resultado) === 2): ?>
                <p class="alerta exito">Actualizado Correctamente</p>
        <?php endif ?>
    </div>
    
    <section class="contenedor">
        <button class="boton boton--cuadrado boton--noborder" id="btn-editar-empresa">Editar</button>  
        <?php foreach($errores as $error): ?>

            <div class="alerta error">
                <?php echo $error; ?>
            </div>
        
        <?php  endforeach; ?>  
        <form form action="/catalogos-php/admin/elementos/empresa.php" class="formulario" method="POST" enctype="multipart/form-data">
            <fieldset class="formulario__campos">
                <legend class="formulario__legend">Datos de la Empresa</legend>
                <input type="hidden" name="id" id="input-id-empresa" value="<?php echo $id; ?>">
                <div class="contenedor-campos contenedor--vertical">
                    <label class="formulario__label" for="empresa-nombre">Nombre</label>
                    <input <?php echo $habilitados; ?> class="formulario__input" type="text" name="nombre" id="empresa-nombre" value="<?php echo $nombre; ?>">
                </div>

                <div class="contenedor-campos contenedor--vertical">
                    <label class="formulario__label" for="empresa-direccion">Dirección</label>
                    <input <?php echo $habilitados; ?> class="formulario__input" type="text" name="direccion" id="empresa-direccion" value="<?php echo $direccion; ?>">
                </div>

                <div class="contenedor-campos contenedor--vertical">
                    <label class="formulario__label" for="empresa-telefono">Teléfono</label>
                    <input <?php echo $habilitados; ?> class="formulario__input" type="tel" name="telefono" id="empresa-telefono" value="<?php echo $telefono; ?>">
                </div>

                <div class="contenedor-campos contenedor--vertical">
                    <label class="formulario__label" for="empresa-whatsapp">WhatsApp</label>
                    <input <?php echo $habilitados; ?> class="formulario__input" type="tel" name="whatsapp" id="empresa-whatsapp" value="<?php echo $whatsapp; ?>">
                </div>

                <div class="contenedor-campos contenedor--vertical">
                    <label class="formulario__label" for="">Email</label>
                    <input <?php echo $habilitados; ?> class="formulario__input" type="email" name="email" id="empresa-email" value="<?php echo $email; ?>">
                </div>

                <div class="contenedor-campos contenedor--vertical">
                    <label class="formulario__label" for="empresa-email">Facebook</label>
                    <input <?php echo $habilitados; ?> class="formulario__input" type="text" name="facebook" id="empresa-facebook" value="<?php echo $facebook; ?>">
                </div>

                <div class="contenedor-campos contenedor--vertical">
                    <label class="formulario__label" for="empresa-instagram">Instagram</label>
                    <input <?php echo $habilitados; ?> class="formulario__input" type="text" name="instagram" id="empresa-instagram" value="<?php echo $instagram; ?>">
                </div>

                <div class="contenedor-campos contenedor--vertical">
                    <label class="formulario__label" for="empresa-website">Sitio Web</label>
                    <input <?php echo $habilitados; ?> class="formulario__input" type="text" name="website" id="empresa-website" value="<?php echo $website; ?>">
                </div>
                
                <div class="contenedor-campos contenedor--vertical">
                    <label class="formulario__label" for="empresa-logo">Logotipo</label>
                    <input <?php echo $habilitados; ?> class="formulario__input" type="file" accept="image/jpeg, image/png" name="logo" id="empresa-logo" value="<?php echo $logo; ?>">
                    <img src="/catalogos-php/imagenes/<?php echo $logo; ?>" alt="logo empresa" class="imagen--medium">
                </div>

                <div class="contenedor--horizontal">
                    <input class="boton boton--cuadrado boton--noborder" id="btn-guardar" type="submit" value="Guardar" <?php echo $habilitados; ?>>
                    
                </div>
            </fieldset>
        </form>
        
    </section>
    <script src="/catalogos-php/build/js/app.js"></script>
</body>
</html>