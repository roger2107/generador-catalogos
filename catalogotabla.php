<?php
    $categoria = 'abarrotes';

    ob_start();
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

<main >

    <!-- <?php //include './includes/templates/header-catalogo.php'; ?> -->

    <!-- <div class="header-categoria">
        
        <div class="fondo">
            <h4 class="nombre-categoria">ABARROTES</h4>
            <img src="http://<?php //echo $_SERVER['HTTP_HOST']; ?>/catalogos-php/build/img/<?php //echo $categoria ?>.jpg" alt="imagen categoria" class="imagen-categoria">
        </div>

        <img src="http://<?php //echo $_SERVER['HTTP_HOST']; ?>/catalogos-php/build/img/logo cima.jpg" alt="logo" class="logo-empresa">
    </div> -->


    <!---->

    <div class="headercatalogo-tabla">
        <table class="tabla tabla-header ">
            <tr>
                <td class="celda-categoria tabla-header__celda">
                    <p class="nombre-categoria"><?php echo $categoria ?></p>
                    <img class="imagen-categoria" src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/catalogos-php/build/img/<?php echo $categoria ?>.jpg" alt=""> 
                    
                </td>
                <!-- <td class="celda-logo tabla-header__celda">
                    <img class="logo-empresa" src="http://<?php //echo $_SERVER['HTTP_HOST']; ?>/catalogos-php/build/img/logo cima.jpg" alt="logo empresa">
                </td> -->
            </tr>
        </table>
    </div>

    <section class="lista-usuarios">
        <table class="tabla tabla--usuarios">
            <tr >
                <th class="tabla__encabenzados">ID</th>
                <th class="tabla__encabenzados">NOMBRE</th>
                <th class="tabla__encabenzados">DESCRIPCION</th>
                <th class="tabla__encabenzados">IMAGEN</th>
                <th class="tabla__encabenzados">CATEGORIA</th>
                <th class="tabla__encabenzados">OPCIONES</th>
            </tr>
            
            <tr>
                <td>1</td>
                <td>MAYONESA MCORMICK 105GR</td>
                <td>FRASCO 105GR/CAJA 24PZAS</td>
                <td><img src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/catalogos-php/build/img/producto.png" alt="" class="imagen-small"></td>
                <td>ABARROTES</td>
                <td>opciones</td>
            </tr>   
            
            <tr>
                <td>1</td>
                <td>MAYONESA MCORMICK 105GR</td>
                <td>FRASCO 105GR/CAJA 24PZAS</td>
                <td><img src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/catalogos-php/build/img/producto.png" alt="" class="imagen-small"></td>
                <td>ABARROTES</td>
                <td>opciones</td>
            </tr> 
            <tr>
                <td>1</td>
                <td>MAYONESA MCORMICK 105GR</td>
                <td>FRASCO 105GR/CAJA 24PZAS</td>
                <td><img src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/catalogos-php/build/img/producto.png" alt="" class="imagen-small"></td>
                <td>ABARROTES</td>
                <td>opciones</td>
            </tr> 
                   
        </table>
    </section>
        
    </main>

    <footer class="footer__catalogo">
        <div class="headercatalogo-tabla contenedor-footer--catalogo">
            <table class="tabla tabla-footer ">
                <tr>
                    <td class="celda--icono"><img  src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/catalogos-php/build/img/logo cima.jpg" alt="" class="footer__icono footer__icono--logo"></td>
                    <td class="celda celda--texto"><p class="parrafo-footer">CIMA DISTRIBUCIONES</p></td>
                    
                    <td class="celda--icono"><img  src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/catalogos-php/build/img/icono_telefono.png" alt="" class="footer__icono"></td>
                    <td class="celda celda--texto"><p class="parrafo-footer">951 123 4567</p></td>

                    <td class="celda--icono"><img  src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/catalogos-php/build/img/icono_email.png" alt="" class="footer__icono"></td>
                    <td class="celda celda--texto"><p class="parrafo-footer">correo@correo.com</p></td>
                </tr>
            </table>
        </div>
    </footer>

    <!-- <?php //include './includes/templates/footer-catalogo.php'; ?> -->

    

    <!--  -->

</body>
</html>

<?php

$html= ob_get_clean();
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
$dompdf->stream("catalogo.pdf", array("Attachment"=>true));
?>