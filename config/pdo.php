<?php
    require 'conexion.php';
    $dsn= 'mysql: host=' . HOST . ';dbname=' . DBNAME;
    try{
        $pdo = new PDO ($dsn, $USUARIOBD, $PASSWORD);
    }catch (PDOException $e){
        echo 'Falló la conexion';
        die();
    }
?>