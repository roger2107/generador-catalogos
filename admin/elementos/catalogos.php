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
    
    //Database
    require '../../includes/config/database.php';
    $db  = conectarDB();

    //Consulta para obtener las categorias
    $consulta = "SELECT * FROM categorias";
    $resultadoCategorias = mysqli_query($db, $consulta);

    $codigoURL = $_GET['codigo'] ?? null;
    $idCategoria = $_GET['categoria'] ?? null;

    $queryProductos ='';

    
    
    if($_SERVER['REQUEST_METHOD']=== 'GET'){
        if(!isset($codigoURL) || !isset($idCategoria)){
            $queryProductos = "SELECT * FROM productos ORDER BY  idcategoria;";
            $resultadoConsultaProductos = mysqli_query($db, $queryProductos);
        }
        //echo $idCategoria;
        if(intval($codigoURL)===1){
            if(intval($idCategoria) !== -1){
                //echo 'categoria valida, id ' . $idCategoria;
                if(intval($idCategoria) === 0){
                    //echo 'todas las categorias';
                    $queryProductos = "SELECT * FROM productos ORDER BY  idcategoria;";
                    echo 'consulta ' . $queryProductos;
                }else{
                    //echo 'categoria especifica: ' . $idCategoria;
                    $queryProductos = "SELECT * FROM productos WHERE idcategoria = $idCategoria ORDER BY  idcategoria;";
                    //echo 'consulta ' . $queryProductos;
                }
                $resultadoConsultaProductos = mysqli_query($db, $queryProductos);
            }
        }
        if(intval($codigoURL)===2){
            
        }

        
    }
    
    

    $vistaTabla = true;
    $volver = 'index';
    

    $nombrePagina = 'Genera Catalogo';
    incluirTemplate('header-doc',$agregarElemento=false, $elemento='' , $volver, $nombrePagina);
    incluirTemplate('header-user', false,'','','',$_SESSION['usuario_username']);

    incluirTemplate('barra-menu', $agregarElemento=false, $elemento='' , $volver);
    
?>


    
    <section class="contenedor buscador">
        <form action="/catalogos-php/admin/elementos/catalogos.php?codigo=1">
            <div class="buscador__elementos">
                <div class="buscador__elementos--elemento">
                    <label class="buscador__label" for="select-categoria">Categoria</label>
                    <select name="categoria" id="select-categoria" class="select-categoria">
                        <option value="-1" >---SELECCIONA---</option>
                        <option value="0" selected>TODAS</option>
                        <?php while($opcionCategoria = mysqli_fetch_assoc($resultadoCategorias)): ?>
                            <option <?php echo $idCategoria === $opcionCategoria['id'] ? 'selected' : '' ?>  value="<?php echo $opcionCategoria['id']; ?>"><?php echo $opcionCategoria['nombre']; ?></option>
                        <?php endwhile; ?>
                    </select>
                    
                </div>
                <!-- <input type="submit" value="Buscar" class="boton boton--cuadrado boton--noborder btn-buscador"> -->
                <!-- <a href="/catalogos-php/admin/elementos/catalogos.php?codigo=1&categoria=-1" class="boton boton--cuadrado boton--noborder btn-buscador" id="btn-buscar-productos">Buscar</a> -->
                <a href="/catalogos-php/admin/elementos/catalogos.php" class="boton boton--cuadrado boton--noborder btn-buscador" id="btn-buscar-productos">Buscar</a>
            </div>
        </form>
        <form action="/catalogos-php/admin/elementos/pdf.php" method="POST">
            <fieldset>
                <legend>Diseño catalogo</legend>
                    <div class="buscador__elementos">
                        <div class="buscador__elementos--elemento">
                            <label class="buscador__label" for="check-bordes">Bordes</label>
                            <input type="checkbox" name="bordes" id="check-bordes" checked>
                        </div>
                        <div class="buscador__elementos--elemento">
                            <label class="buscador__label" for="check-precios">Precios</label>
                            <input type="checkbox" name="precios" id="check-precios" checked>
                            <input type="hidden" name="inputcategoria" id="input-categoria" value="<?php echo $idCategoria ?>">
                        </div>
                        <div class="buscador__elementos--elemento">
                            <label class="buscador__label" for="select-columnas">Columnas</label>
                            <select name="columnas" id="select-columnas" class="select-columnas">
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4" selected>4</option>
                            </select>
                        </div>
                        
                        <input type="submit" value="Generar PDF" class="boton boton--cuadrado boton--noborder btn-buscador">
                        <!-- <a href="/catalogos-php/admin/elementos/catalogos.php?codigo=2" class="boton boton--cuadrado boton--noborder btn-buscador">Generar PDF</a> -->
                        <!-- <a href="/catalogos-php/admin/elementos/pdf.php" class="boton boton--cuadrado boton--noborder btn-buscador" target="_blank">Generar PDF</a> -->
                    
                    </div>
            </fieldset>
           
        </form>
        
    </section>


    <div class="contenedor">
        <?php if(intval($idCategoria) === -1): ?>
            <p class="alerta error">Selecciona una categoria</p>
        <?php endif ?>
    </div>

    <main class="catalogo" id="catalogo">
        <div class="contenedor-productos grid-4col" id="contenedor-productos">
            <?php while($producto = mysqli_fetch_assoc($resultadoConsultaProductos)): ?>
                <div class="card-producto borde sombra">
                    <p class="card-producto__nombre"><?php echo $producto['nombre'] ?></p>
                    <img src="/catalogos-php/imagenes/<?php echo $producto['imagen'] ?>" alt="producto" class="card-producto__imagen">
                    <p class="card-producto__descripcion"><?php echo $producto['descripcion'] ?></p>
                    <p class="card-producto__descripcion card-producto__descripcion--precio"><?php echo '$' . $producto['precio'] ?></p>
                </div>
            <?php endwhile; ?>
        </div>
        
    </main>
    <script src="/catalogos-php/build/js/app.js"></script>
</body>
</html>