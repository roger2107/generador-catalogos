<?php
    // mostrar errores de php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    require 'includes/config/database.php';
    $db = conectarDB();

    $errores = [];
    //Autenticar al usuario
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        // echo '<pre>';
        // var_dump($_POST);
        // echo '</pre>';

        $username = mysqli_real_escape_string($db, $_POST['username']);
        $password = mysqli_real_escape_string($db, $_POST['password']);

        if(!$username || strlen($username) < 4 || strlen($username) >10){
            $errores[] = 'INGRESE UN USUARIO VALIDO';
        }
        if(!$password || strlen($password) < 4 || strlen($password) >10){
            $errores[] = 'INGRESE UN PASSWORD VALIDO';
        }   

        if(empty($errores)){
            //revisar si el usuario existe
            $query = "SELECT * FROM usuarios WHERE username = '$username'";
            $resultado = mysqli_query($db, $query);

            

            if($resultado->num_rows){
                //Revisar si el password es correcto
                $usuario = mysqli_fetch_assoc($resultado);
                
                //verificar si el password es correcto pablo123
                $auth = password_verify($password, $usuario['password']);
                //var_dump($auth);
                if($auth){
                    //El usuario esta autenticado
                    session_start();

                    $_SESSION['usuario_nombre'] = $usuario['nombre'];
                    $_SESSION['usuario_username'] = $usuario['username'];
                    $_SESSION['usuario_tipo'] = $usuario['tipo'];

                    $_SESSION['login'] = true;

                    header('Location: /catalogos-php/admin/index.php');
                    
                }else{
                    $errores [] = 'El password es incorrecto';
                }
            }else{
                $errores [] = 'El usuario no existe';
            }
        }

        // echo '<pre>';
        // var_dump($errores);
        // echo '</pre>';
    }




    require 'includes/funciones.php';
    
    $nombrePagina = 'LOGIN';
    incluirTemplate('header-doc',$agregarElemento=false, $elemento='' , $volver=false, $nombrePagina);
    
?>
    <section class="seccion-login">
        
        <div class="contenedor-formulario">
            <img class="icono-login" src="build/img/icono-usuario.png" alt="icono login">
            <form class="formulario formulario--login" method="POST">
                <fieldset class="formulario__campos">
                    <!-- <legend>Inicia Sesión</legend> -->
                    <div class="contendor-campo contendor-campo__login">
                        <label class="label-login" for="usuario">Usuario</label>
                        <input type="text" name="username" required>
                    </div>
                    <div class="contendor-campo contendor-campo__login">
                        <label class="label-login" for="usuario">Contraseña</label>
                        <input type="password" name="password" id="" required>
                    </div>
                    <input  type="submit" class="boton" value="Ingresar">

                    <?php foreach($errores as $error): ?>
                        <p class="texto texto--error"> <?php echo $error ?> </p>
                    <?php endforeach; ?>
                </fieldset>
            </form>
            
        </div>
    </section>
</body>
</html>