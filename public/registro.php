<?php
    require '../config/conexion.php';
    require '../config/database.php';

    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    $error = '';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Recuperar los datos del formulario
        $username = htmlspecialchars($_POST['username']);
        $password = htmlspecialchars($_POST['password']);
        
        // Verificar si el usuario ya existe en la base de datos
        if (!userExiste($username)) {
            registro($username, $password);
            header('Location: login.php');
        } else {
            $error = 'Error al registrar. Inténtalo de nuevo.';
        }
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
</head>
<body>
    <?php if (!empty($error)): ?>
        <div class="error" style="color:red;"><?php echo $error; ?></div>
    <?php endif; ?>

    <div class="container">
        <h2>Registrar Cuenta</h2>
        <form method="POST" action="registro.php">
            <input type="text" name="username" class="input-field" placeholder="Usuario" required>
            <input type="password" name="password" class="input-field" placeholder="Contraseña" required>
            <button type="submit" class="button">Registrar</button>
        </form>
        
    </div>
    <a href="login.php">Iniciar sesión</a>
</body>
</html>
