<?php

require 'funciones.php';

// Inicia la sesión
session_start();

// Variables para mensajes de error
$error = '';
$success = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtén las credenciales enviadas por el usuario
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validar que las contraseñas coincidan
    if ($password !== $confirm_password) {
        $error = 'Las contraseñas no coinciden.';
    } else {
        // Validación básica para asegurarse de que el nombre de usuario no esté vacío
        if (empty($username) || empty($password)) {
            $error = 'Por favor, ingrese un nombre de usuario y una contraseña.';
        } else {
            // Intentamos cargar el archivo de usuarios (puedes usar una base de datos real en lugar de esto)
            $usuarios_file = 'usuarios.json';
            $usuarios = [];

            if (file_exists($usuarios_file)) {
                $usuarios = json_decode(file_get_contents($usuarios_file), true);
            }

            // Verificar si el usuario ya existe
            if (isset($usuarios[$username])) {
                $error = 'Este nombre de usuario ya está registrado.';
            } else {
                // Guardar el nuevo usuario (deberías cifrar la contraseña antes de guardarla en producción)
                $usuarios[$username] = password_hash($password, PASSWORD_DEFAULT);

                // Guardar los usuarios en el archivo (en producción, guarda esto en una base de datos)
                file_put_contents($usuarios_file, json_encode($usuarios));

                // Mensaje de éxito
                $success = '¡Cuenta creada con éxito! Ahora puedes iniciar sesión.';
            }
        }
    }
}
?>

<!DOCTYPE html>
<body>

<div class="container">
    <h2>Registrar Cuenta</h2>

    <?php if ($error): ?>
        <div class="error"><?php echo $error; ?></div>
    <?php endif; ?>

    <?php if ($success): ?>
        <div class="success"><?php echo $success; ?></div>
    <?php endif; ?>

    <form method="POST" action="register.php">
        <input type="text" name="usuario" class="input-field" placeholder="Usuario" required>
        <input type="contra" name="contra" class="input-field" placeholder="Contraseña" required>
        <input type="contra" name="confirma_contra" class="input-field" placeholder="Confirmar Contraseña" required>
        <button type="submit" class="button">Registrar</button>
    </form>
</div>

</body>
</html>
