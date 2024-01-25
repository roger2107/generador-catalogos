<?php

    require 'app.php';

    function incluirTemplate($nombre, $agregarElemento=false, $elemento='', $volver='', $nombrePagina='', $nombreUsuario =''){
        include TEMPLATES_URL . "/$nombre.php";
    }

    function estaAutenticado() : bool{
        session_start();

        $auth = $_SESSION['login'];
        if($auth){
           return true; 
        }
        return false;
    }
?>