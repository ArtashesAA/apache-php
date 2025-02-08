<?php
require 'conexion.php';

$username = 'wawa';
$password = '123456';
$role = 'admin'; 

// Contraseña encriptada
$options = ['cost' => 12];
$hash = password_hash($password, PASSWORD_BCRYPT, $options);

$query = "INSERT INTO usuarios (usuario_nombre, usuario_passwd, role) VALUES (?, ?, ?)";

try {
    $res = $pdo->prepare($query);
    $res->execute([$username, $hash, $role]);
    echo "Usuario insertado correctamente";
} catch (PDOException $e) {
    echo "Error al insertar el usuario";
    die();
}
?>
