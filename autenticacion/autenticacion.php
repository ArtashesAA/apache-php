<?php
    session_start();
    require '../config/conexion.php';

    function comprobarAutenticacion(){
        if(!isset($_SESSION['username'])){
            header("Location: login.php?error=Inicia sesión");
            exit();
        }
    }

    function comprobarRole($role){
        if(!isset($_SESSION['role']) || $_SESSION['role'] !== $role){
            header("Location: no-autenticado.php");
            exit();
        }
    }

?>