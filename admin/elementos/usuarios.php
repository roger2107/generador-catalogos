<?php
    // mostrar errores de php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    //Importar la conexion
    require '../../includes/config/database.php';
    $db  = conectarDB();

    //Escribir el query
    $query = "SELECT * FROM usuarios";

    //Consultar la BD
    $resultadoConsulta = mysqli_query($db, $query);
   
    $resultado = $_GET['resultado'] ?? null;

    $agregarElemento=true;
    $elemento = 'usuario';
    $volver = 'index';
    //$agregarElemento = true;

    require '../../includes/funciones.php';
    
    $nombrePagina = 'Usuarios';
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
        <table class="tabla tabla--usuarios">
            <thead>
                <tr >
                    <th class="tabla__encabenzados">ID</th>
                    <th class="tabla__encabenzados">NOMBRE</th>
                    <th class="tabla__encabenzados">USUARIO</th>
                    <th class="tabla__encabenzados">OPCIONES</th>
                </tr>
            </thead>
            
            <tbody>
                <?php while($usuario = mysqli_fetch_assoc($resultadoConsulta)): ?>
                    <tr>
                        <td> <?php echo $usuario['id'] ?> </td>
                        <td><?php echo $usuario['nombre'] ?></td>
                        <td> <?php echo $usuario['username'] ?> </td>
                        <td>
                            <a href="/catalogos-php/admin/elementos/actualizarUsuario.php?id=<?php echo $usuario['id'] ?>" class="boton boton--small boton--cuadrado boton--noborder boton--naranja">Editar</a>
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