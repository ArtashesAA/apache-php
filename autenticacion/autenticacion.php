<?php
    require '../config/pdo.php';
    
    function comprobarAutenticacion() {
        if (!isset($_SESSION['username'])) {
            return false;
        }
        return true;
    }
    
    function comprobarRole($role) {
        if (!isset($_SESSION['role']) || $_SESSION['role'] !== $role) {
            header("Location: ../autenticacion/no-autenticado.php");
            exit();
        }
    }
?>