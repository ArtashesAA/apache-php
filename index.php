<?php
    require 'autenticacion/autenticacion.php';

    if(isset($_SESSION['usuario'])){
        header('Location: ../public/principal.php');
    }else{
        header('Location: ../public/login.php');
    }
?>