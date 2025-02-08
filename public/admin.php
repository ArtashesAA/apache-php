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
        <h2>Administrador</h2>
        <p>Bienvenido</p>
    </div>
</body>
</html>