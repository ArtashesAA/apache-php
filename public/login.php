<?php
require '../config/conexion.php';
require '../config/database.php';

$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener y sanitizar las credenciales del formulario
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);

    // Verificar si el usuario existe
    if (!userExiste($username)) {
        $error = 'Credenciales incorrectas. ';
    }else{
        // Obtener los datos del usuario
        $usuario = abreConexion($username);
        $hash_bd = $usuario['password'];

        if(!$usuario){
            $error = "Credenciales incorrectas";
        }else{
            // Verificar si la contraseña es correcta
            if (password_verify($password, $usuario['password'])) {
                error_log("Contraseña verificada");

                
            } else {
                $error = 'Credenciales incorrectas. ';
            }
        }
    }
}

function iniciarSesion($usuario){
    session_start();
    // Iniciar sesión
    $_SESSION['username'] = $usuario['username'];
    $_SESSION['role'] = $usuario['role'];

    // Redirigir según el rol del usuario
    if ($usuario['role'] == 'USER') {
        header('Location: principal.php');
    } elseif ($usuario['role'] == 'ADMIN') {
        header('Location: admin.php');
    }
    exit;
}

function actualizarPassword($username, $nuevo_hash){
    global $pdo;
    $query = "UPDATE usuarios SET password = ? WHERE username = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$nuevo_hash, $username]);
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
    <a href="registro.php">Registrate</a>
</body>
</html>
