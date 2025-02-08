<?php
require 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener y sanitizar las credenciales del formulario
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);
    $role = htmlspecialchars($_POST['role']);

    // Verificar si el usuario existe
    if (!userExiste($username)) {
        header('Location: index.php?error=2'); // Usuario no encontrado
        exit;
    }

    // Obtener los datos del usuario
    $usuario = abreConexion($username);

    // Verificar si la contraseña es correcta
    if (password_verify($password, $usuario['usuario_passwd'])) {
        // Iniciar sesión
        session_start();
        $_SESSION['usuario'] = $username;
        header('Location: dashboard.php'); // Redirigir a una página de usuario
        exit;
    } else {
        header('Location: index.php?error=3'); // Contraseña incorrecta
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión</title>
</head>
<body>
    <?php if ($mensaje): ?>
        <p style="color: red;"><?php echo $mensaje; ?></p>
    <?php endif; ?>

    <div class="container">
        <h2>Iniciar sesión</h2>
        <form method="POST" action="login.php">
            <input type="text" name="username" class="input-field" placeholder="Usuario" required>
            <input type="password" name="password" class="input-field" placeholder="Contraseña" required>
            <button type="submit" class="button">Iniciar sesión</button>
        </form>
    </div>
</body>
</html>
