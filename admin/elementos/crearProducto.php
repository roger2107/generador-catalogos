<?php
    $volver = 'productos';

    require '../../includes/funciones.php';
    
    incluirTemplate('header-doc');
    incluirTemplate('header-user');

    incluirTemplate('barra-menu', $agregarElemento=false, $elemento='' , $volver);
?>
    
    