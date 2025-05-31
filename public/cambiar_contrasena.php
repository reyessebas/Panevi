<?php
// Cargar las dependencias necesarias, como Carbon para manejar las fechas
require '../vendor/autoload.php';
include "../app/config/config.php";
use Carbon\Carbon; // Asegúrate de tener instalado Carbon

// Variables para almacenar mensajes de error o éxito
$error = "";
$success = "";

// Verificar si la solicitud es POST (se ha enviado el formulario)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si se ha recibido el token y la nueva contraseña
    if (isset($_POST['token']) && isset($_POST['new_password'])) {
        $token = $_POST['token']; // Token enviado desde el formulario
        $new_password = md5($_POST['new_password']); // Hashear la contraseña con md5 (se recomienda usar password_hash en lugar de md5)

        // Consulta SQL para verificar el token y que la fecha de expiración no haya pasado
        $sql = "SELECT email FROM clientes WHERE reset_token = ? AND reset_expiration > ?";
        $stmt = $conexion->prepare($sql);
        $current_time = Carbon::now()->toDateTimeString(); // Obtener la hora actual con Carbon
        $stmt->bind_param("ss", $token, $current_time); // Pasar los parámetros a la consulta
        $stmt->execute();
        $stmt->store_result();

        // Si se encuentra un resultado (el token es válido)
        if ($stmt->num_rows > 0) {
            $stmt->bind_result($email); // Obtener el correo asociado al token
            $stmt->fetch();

            // Actualizar la contraseña en la base de datos y eliminar el token y la fecha de expiración
            $updateSql = "UPDATE clientes SET password = ?, reset_token = NULL, reset_expiration = NULL WHERE email = ?";
            $updateStmt = $conexion->prepare($updateSql);
            $updateStmt->bind_param("ss", $new_password, $email); // Vincular los parámetros para actualizar la contraseña

            // Si la actualización es exitosa, mostrar un mensaje de éxito
            if ($updateStmt->execute()) {
                $success = "CONTRASEÑA CAMBIADA CON ÉXITO";
            } else {
                $error = "Error al cambiar la contraseña: " . $updateStmt->error; // Mostrar mensaje de error si la actualización falla
            }

            $updateStmt->close(); // Cerrar el statement
        } else {
            // Si el token no es válido o ha expirado, mostrar un mensaje de error
            $error = "Token de restablecimiento inválido o expirado.";
        }

        $stmt->close(); // Cerrar el statement
    } else {
        // Si faltan campos, mostrar un mensaje de error
        $error = "Todos los campos son requeridos.";
    }
}

$conexion->close(); // Cerrar la conexión a la base de datos
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambiar Contraseña</title>
    <link rel="stylesheet" href="css/estiles.css">
    <link rel="shortcut icon" href="../public/img/acceso.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body id="fondo" style="background-image: url('img/imagen22.png')">
    <a href="index.php" class="home-icon"><i class="fas fa-home"></i></a>
    <br><br>
    <br><br>
    <form id="form1" action="cambiar_contrasena.php" method="post">
        <br><br>
        <h2>CAMBIAR<br>CONTRASEÑA</h2>

        <!-- Mostrar mensajes de error o éxito si existen -->
        <?php if (!empty($error)): ?>
            <div style="color: grey; font-weight: bold; padding: 10px; border: 1px solid grey; 
                        border-radius: 5px; background-color: #f2f2f2; font-size: 14px;">
                <?php echo htmlspecialchars($error); ?> <!-- Mostrar el mensaje de error -->
            </div>
        <?php elseif (!empty($success)): ?>
            <div style="color: #28a745; font-weight: bold; padding: 10px; border: 1px solid #28a745; 
                        border-radius: 5px; background-color: #eafaf1; font-size: 14px;">
                <?php echo htmlspecialchars($success); ?> <!-- Mostrar el mensaje de éxito -->
                <br><br>
                <a href="login.php" style="color: #155724; font-weight: normal; text-decoration: underline;">
                    INICIA SESIÓN AQUÍ <!-- Enlace para iniciar sesión -->
                </a>
            </div>
        <?php endif; ?>

        <!-- Campo oculto para enviar el token -->
        <input type="hidden" name="token" value="<?php echo htmlspecialchars($_GET['token'] ?? ''); ?>">

        <!-- Campo para la nueva contraseña -->
        <input type="password" id="new_password" name="new_password" placeholder="Nueva Contraseña" required>

        <br><br>
        <!-- Botón para enviar el formulario -->
        <div class="submit-container">
            <input style="background-color: #134914;color:white;padding: 10px 15px;margin: 8px 0;
            cursor: pointer;width: 75%;border-radius: 30px;border: none;"
            onmouseover="this.style.backgroundColor='#0f3b0e'; this.style.opacity='0.8';"
            onmouseout="this.style.backgroundColor='#134914'; this.style.opacity='1';" 
            type="submit" class="btn" name="btningresar" value="Cambiar Contraseña">
        </div>
    </form>

</body>

</html>
