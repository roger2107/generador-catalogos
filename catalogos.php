<?php
    $vistaTabla = true;
    $volver = 'admin';

    require './includes/funciones.php';
    
    incluirTemplate('header-doc');
    incluirTemplate('header-user');

    incluirTemplate('barra-menu', $agregarElemento=false, $elemento='' , $volver);
?>
   
    <section class="seccion-design">
        <div class="contenedor-design">
            <div class="design__categoria">
                <label class="formulario__label" for="">Categoria</label>
                <select class="formulario__input" name="" id="">
                    <option value="0">TODAS</option>
                    <option value="1">ABARROTES</option>
                    <option value="2">LIMPIEZA</option>
                    <option value="3">CUID. PERSONAL</option>
                    <option value="4">DULCERIA</option>
                </select>
            </div>
            <div class="contenedor--horizontal design__design">
                <div class="contenedor-campo contenedor-campo--design">
                    <label for="" class="formulario__label">Bordes</label>
                    <input type="checkbox" name="" id="check-bordes" checked>
                </div>
                <div class="contenedor-campo contenedor-campo--design">
                    <label for="" class="formulario__label">Columnas</label>
                    <select class="formulario__input" name="" id="seleccion-columnas">
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4" selected>4</option>
                    </select>
                </div>
                <div class="contenedor-campo contenedor-campo--design">
                    <button id="btnGeneradorPDF" class="boton boton--cuadrado boton--noborder boton-generador">Generar PDF</button>
                </div>
            </div>
        </div>
    </section>
    <main class="catalogo" id="catalogo">
        <div class="contenedor-productos grid-4col" id="contenedor-productos">
            <div class="card-producto borde sombra">
                <p class="card-producto__nombre">ACEITE PATRONA 500ML</p>
                <img src="build/img/producto.png" alt="producto" class="card-producto__imagen">
                <p class="card-producto__descripcion">ACEITE PATRONA 500ML. CAJA CON 24PZAS</p>
            </div>

            <div class="card-producto borde sombra">
                <p class="card-producto__nombre">ACEITE PATRONA 500ML</p>
                <img src="build/img/producto.png" alt="producto" class="card-producto__imagen">
                <p class="card-producto__descripcion">ACEITE PATRONA 500ML. CAJA CON 24PZAS</p>
            </div>

            <div class="card-producto borde sombra">
                <p class="card-producto__nombre">ACEITE PATRONA 500ML</p>
                <img src="build/img/producto.png" alt="producto" class="card-producto__imagen">
                <p class="card-producto__descripcion">ACEITE PATRONA 500ML. CAJA CON 24PZAS</p>
            </div>

            <div class="card-producto borde sombra">
                <p class="card-producto__nombre">ACEITE PATRONA 500ML</p>
                <img src="build/img/producto.png" alt="producto" class="card-producto__imagen">
                <p class="card-producto__descripcion">ACEITE PATRONA 500ML. CAJA CON 24PZAS</p>
            </div>
        </div>
        
    </main>
    <script src="build/js/app.js"></script>
    <script src="build/js/html2pdf.bundle.min.js"></script>
</body>
</html>