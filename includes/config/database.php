<?php

    function conectarDB(){
        $db = mysqli_connect('localhost', 'root', 'root','generador_catalogos');

        if(!$db){
            echo 'no se pudo conectar a DB';
            exit;
        }

        return $db;
    }
?>