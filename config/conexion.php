<?php
    define ("DB_HOST", "localhost");
    define ("DB_NAME", "apachePhp");
    define ("DB_USER", "artashes");
    define ("DB_PASS", "123456");

    try{
        $pdo = new PDO("mysql:host=" . ";dbname=" .DB_NAME, DB_USER, DB_PASS, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
    }catch(PDOException $e){
        die("Error de conexion");
    }
?>