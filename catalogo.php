<?php
    $categoria = 'abarrotes';

    //ob_start();
    //include './includes/templates/header-doc.php';
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <title>Login</title>
    <link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/catalogos-php/build/css/app.css">
</head>
<body>

<main class="catalogo" id="catalogo">

    <!-- <?php //include './includes/templates/header-catalogo.php'; ?> -->

    <div class="header-categoria">
        
        <div class="fondo">
            <h4 class="nombre-categoria">ABARROTES</h4>
            <img src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/catalogos-php/build/img/<?php echo $categoria ?>.jpg" alt="imagen categoria" class="imagen-categoria">
        </div>

        <img src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/catalogos-php/build/img/logo cima.jpg" alt="logo" class="logo-empresa">
    </div>


    <!---->

    <div class="contenedor-productos grid-4col" id="contenedor-productos">
        <div class="card-producto borde sombra">
            <p class="card-producto__nombre">ACEITE PATRONA 500ML</p>
            <img src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/catalogos-php/build/img/producto.png" alt="producto" class="card-producto__imagen">
            <p class="card-producto__descripcion">ACEITE PATRONA 500ML. CAJA CON 24PZAS</p>
        </div>

        <div class="card-producto borde sombra">
            <p class="card-producto__nombre">ACEITE PATRONA 500ML</p>
            <img src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/catalogos-php/build/img/producto.png" alt="producto" class="card-producto__imagen">
            <p class="card-producto__descripcion">ACEITE PATRONA 500ML. CAJA CON 24PZAS</p>
        </div>

        <div class="card-producto borde sombra">
            <p class="card-producto__nombre">ACEITE PATRONA 500ML</p>
            <img src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/catalogos-php/build/img/producto.png" alt="producto" class="card-producto__imagen">
            <p class="card-producto__descripcion">ACEITE PATRONA 500ML. CAJA CON 24PZAS</p>
        </div>

        <div class="card-producto borde sombra">
            <p class="card-producto__nombre">ACEITE PATRONA 500ML</p>
            <img src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/catalogos-php/build/img/producto.png" alt="producto" class="card-producto__imagen">
            <p class="card-producto__descripcion">ACEITE PATRONA 500ML. CAJA CON 24PZAS</p>
        </div>
    </div>
        
    </main>

    <!-- <?php //include './includes/templates/footer-catalogo.php'; ?> -->

    <footer class="footer-catalogo">
        <div class="contenedor-footer grid-3col">
            <div class="contendor-datos contenedor--vertical">
                <div class="dato contenedor--horizontal">
                    <img src="" alt="" class="datos__imagen">
                    <p class="datos__informacion">CIMA DISTRIBUCIONES</p>
                </div>
                <div class="dato contenedor--horizontal">
                    <img src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/catalogos-php/build/img/icono_ubicacion.png" alt="icono ubicacion" class="datos__imagen">
                    <p class="datos__informacion">MAGDALENA APASCO, OAX.</p>
                </div>
            </div>

            <div class="contendor-datos contenedor--vertical">
                <div class="dato contenedor--horizontal">
                    <img src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/catalogos-php/build/img/icono_email.png" alt="icono email" class="datos__imagen">
                    <p class="datos__informacion">correo@correo.com</p>
                </div>
                <div class="dato contenedor--horizontal">
                    <img src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/catalogos-php/build/img/icono_telefono.png" alt="icono ubicacion" class="datos__imagen">
                    <p class="datos__informacion">9511234567</p>
                </div>
            </div>

            <div class="contendor-datos contenedor--vertical">
                <div class="dato contenedor--horizontal">
                    <img src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/catalogos-php/build/img/icono_facebook.png" alt="icono email" class="datos__imagen">
                    <p class="datos__informacion">CIMA Distribuciones</p>
                </div>
                <div class="dato contenedor--horizontal">
                    <img src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/catalogos-php/build/img/icono_web.png" alt="icono ubicacion" class="datos__imagen">
                    <p class="datos__informacion">www.cimadistribuciones.com</p>
                </div>
            </div>
        </div>
    </footer>

    <!--  -->

</body>
</html>

<?php
/*$html= ob_get_clean();
//echo $html;
require './librerias/dompdf/autoload.inc.php';

use Dompdf\Dompdf;

$dompdf = new Dompdf();

$options = $dompdf->getOptions();
$options -> set(array('isRemoteEnabled' => true));
$dompdf->setOptions($options);

$dompdf->loadHtml($html);

$dompdf->setPaper('letter');
//$dompdf->setPaper('A4', 'landscape');

$dompdf->render();
$dompdf->stream("catalogo.pdf", array("Attachment"=>true));*/
?>