<?php

    require 'app.php';

    function incluirTemplate($nombre, $agregarElemento=false, $elemento='', $volver='', $nombrePagina=''){
        include TEMPLATES_URL . "/$nombre.php";
    }

?>