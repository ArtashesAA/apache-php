<?php
require 'conexion.php';

// Función para registrar un nuevo usuario
function registro($username, $password, $role){
    global $pdo;
    
    // Encriptar contraseña
    $options = ['cost' => 12];
    $hash = password_hash($password, PASSWORD_BCRYPT, $options);

    $query = "INSERT INTO usuarios (usuario_nombre, usuario_passwd, role) VALUES (?, ?, ?)";
    
    try {
        $stmt = $pdo->prepare($query);
        $stmt->execute([$username, $hash, $role]);
        return true;
    } catch (PDOException $e) {
        return false;
    }
}

// Función para verificar si el usuario ya existe
function userExiste($username){
    global $pdo;
    $query = 'SELECT username FROM usuarios WHERE usuario_nombre = ?';
    $stmt = $pdo->prepare($query);
    $stmt->execute([$username]);
    return $stmt->fetch(PDO::FETCH_ASSOC) ? true : false;
}

// Función para obtener los datos de un usuario por nombre
function abreConexion($username){
    global $pdo;
    $query = 'SELECT * FROM usuarios WHERE usuario_nombre = ?';
    $stmt = $pdo->prepare($query);
    $stmt->execute([$username]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
?>
