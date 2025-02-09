<?php
    require '../autenticacion/autenticacion.php';
    comprobarAutenticacion();
    comprobarRole('ADMIN');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
</head>
<body>
    <div class="container">
        <h2>Bienvenido</h2>
        <p>Eres Administrador</p>
    </div>
    <a href="logout.php">Cerrar sesión</a>
</body>
</html>