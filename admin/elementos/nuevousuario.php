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

    $nombre = "";
    $username = ""; 
    $password = "";
    $tipo = "";

    if($_SERVER["REQUEST_METHOD"] === "POST"){
        

        $nombre = mysqli_real_escape_string($db, $_POST["nombre"]);
        $username = mysqli_real_escape_string($db, $_POST["username"]); 
        $password = mysqli_real_escape_string($db, $_POST["password"]);
        $tipo = mysqli_real_escape_string($db, $_POST["tipo"]);

        // echo '<pre>';
        // var_dump($_POST);
        // echo '</pre>';

        //Verificar si todos los campos fueron llenados correctamente
        if(strlen($nombre) < 5 || strlen($nombre) >45){ //VERIFICA QUE EL NOMBRE DE USUARIO TENGA LA LONGITUD ADECUADA
            $errores[] = 'EL CAMPO NOMBRE DEBE TENER ENTRE 5 Y 45 CARACTERES';
        }
        if(strlen($username) < 4 || strlen($username) >10){
            $errores[] = 'EL CAMPO USERNAME DEBE TENER ENTRE 4 Y 10 CARACTERES';
        }
        if(strlen($password) < 5 || strlen($password) >10){
            $errores[] = 'EL CAMPO CONTRASEÑA DEBE TENER ENTRE 4 Y 10 CARACTERES';
        }
        if( $tipo === "" || intval($tipo) <0 || intval($tipo)>1){
            $errores[] = 'TIPO DE USUARIO NO VALIDO';
        }
        $passwordHash = password_hash($password, PASSWORD_BCRYPT);
        // echo '<pre>';
        // var_dump($errores);
        // echo '</pre>';

        //Revisar que el arreglo de errores esté vacio
        if(empty($errores)){
            $query = "INSERT INTO usuarios (nombre, username, password, tipo) VALUES ( '$nombre' , '$username' , '$passwordHash' , '$tipo' )";
            //echo $query;
            $resultado = mysqli_query($db, $query);

            if($resultado){
                header('Location: /catalogos-php/admin/elementos/usuarios.php?resultado=1');
            }else{
                echo 'Hubo un error al insertar los datos';
            }
        }
       
        
    }

    

    $volver = 'elementos/usuarios';
    $nombrePagina = 'Nuevo Usuario';
    
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
        <form action="/catalogos-php/admin/elementos/nuevousuario.php" class="formulario" method="POST">
            <fieldset class="formulario__campos">
                <legend class="formulario__legend">Datos del Usuario</legend>
                <div class="contenedor-campos contenedor--vertical">
                    <label class="formulario__label" for="usuario-nombre">Nombre</label>
                    <input class="formulario__input" type="text" name="nombre" id="usuario-nombre" value="<?php echo $nombre; ?>">
                </div>
                <div class="contenedor-campos contenedor--vertical">
                    <label class="formulario__label" for="usuario-username">Username</label>
                    <input class="formulario__input" type="text" name="username" id="usuario-username" value="<?php echo $username; ?>">
                </div>
                <div class="contenedor-campos contenedor--vertical">
                    <label class="formulario__label" for="usuario-password">Contraseña</label>
                    <input class="formulario__input" type="password" name="password" id="usuario-password" value="<?php echo $password; ?>">
                </div>
                <div>
                    <label class="formulario__label" >¿Usuario Admin?</label >
                    <div class="contenedor--horizontal">
                        <input type="radio" name="tipo" value="1" checked />
                        <label>Si</label>
                        <input type="radio" name="tipo" value="0" checked />
                        <label>No</label>
                    </div>
                </div>

                <input class="boton boton--cuadrado boton--noborder" type="submit" value="Guardar">
            </fieldset>
        </form>
        
    </section>
    <script src="/catalogos-php/build/js/app.js"></script>
</body>
</html>