<?php

    session_start();
    var_dump($_SESSION);

    $_SESSION = [];

    header('Location: /catalogos-php/index.php');

?>