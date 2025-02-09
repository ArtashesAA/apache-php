<?php

    session_start();

    // Verificar si el usuario ha iniciado sesión
    if (!isset($_SESSION['usuario'])) {
        header('Location: login.php');
        exit;
    }

    $username = $_SESSION['usuario'];
    $role = $_SESSION['role'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Principal</title>
</head>
<body>
    <h2>Bienvenido</h2>
    <p>Usuario: <?php echo htmlspecialchars($username); ?></p>
    <p>Rol: <?php echo htmlspecialchars($role); ?></p>
    <a href="logout.php">Cerrar sesión</a>
</body>
</html>
