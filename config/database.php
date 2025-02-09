<?php
    require 'pdo.php';

    // Función para registrar un nuevo usuario
    function registro($username, $password, $role = 'USER') {
        global $pdo;

        $hash = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);
        
        $query = "INSERT INTO usuarios (username, password, role) VALUES (?, ?, ?)";
            
        try {
            $stmt = $pdo->prepare($query);
            $stmt->execute([$username, $hash, $role]);
            return true;
        } catch (PDOException $e) {
            // Error, borrar luego
            error_log($e->getMessage());
            return false;
        }
    }

    // Verificar si el usuario ya existe
    function userExiste($username) {
        global $pdo;
        $query = 'SELECT username FROM usuarios WHERE username = ?';
        $stmt = $pdo->prepare($query);
        $stmt->execute([$username]);
        return $stmt->fetch() ? true : false;
    }

    // Obtener los datos de un usuario por nombre
    function abreConexion($username) {
        global $pdo;
        $query = 'SELECT * FROM usuarios WHERE username = ?';
        $stmt = $pdo->prepare($query);
        $stmt->execute([$username]);
        $usuario = $stmt->fetch();

        return $usuario;
    }

?>
