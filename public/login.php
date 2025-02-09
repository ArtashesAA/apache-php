<?php
require '../config/conexion.php';

$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener y sanitizar las credenciales del formulario
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);
    $role = htmlspecialchars($_POST['role']);

    // Verificar si el usuario existe
    if (!userExiste($username)) {
        header('Location: index.php');
        $error = 'Credenciales incorrectas.';
        exit;
    }

    // Obtener los datos del usuario
    $usuario = abreConexion($username);

    // Verificar si la contraseña es correcta
    if (password_verify($password, $usuario['usuario_passwd'])) {
        // Iniciar sesión
        session_start();
        $_SESSION['usuario'] = $username;
        $_SESSION['role'] = $usuario['role'];

        // Redirigir según el rol del usuario
        if ($usuario['role'] == 'USER') {
            header('Location: principal.php');
        } elseif ($usuario['role'] == 'ADMIN') {
            header('Location: admin.php');
        }
        exit;
    } else {
        $error = 'Credenciales incorrectas.';
        exit;
    }
}

// Verificar sesión en la página principal
if (basename($_SERVER['PHP_SELF']) == "principal.php" && !isset($_SESSION['usuario'])) {
    header('Location: login.php');
    $error = 'Debes iniciar sesión.';
    exit;
}

// Verificar acceso a admin.php
if (basename($_SERVER['PHP_SELF']) == "admin.php" && (!isset($_SESSION['role']) || $_SESSION['role'] != 'ADMIN')) {
    header('Location: no-autorizado.php');
    exit;
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
    <?php if (!empty($error)): ?>
        <div class="error" style="color:red;"><?php echo $error; ?></div>
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
