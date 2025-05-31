<?php
// Cargar la autoload de las dependencias instaladas
require '../vendor/autoload.php';

// Incluir archivo de configuración para la conexión a la base de datos
include "../app/config/config.php";

// Importar la clase Carbon para manejar fechas y horas
use Carbon\Carbon; // Asegúrate de tener instalado Carbon

// Variable para almacenar el mensaje de error si ocurre algún problema
$error = "";

// Verificar si la solicitud es de tipo POST (cuando se envía el formulario)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener el correo electrónico enviado desde el formulario
    $email = $_POST['email'];

    // Preparar la consulta SQL para verificar si el correo existe en la base de datos
    $sql = "SELECT id_cliente FROM clientes WHERE email = ?";
    $stmt = $conexion->prepare($sql);
    // Vincular el parámetro del correo electrónico a la consulta
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    // Verificar si se encontró un cliente con el correo proporcionado
    if ($stmt->num_rows > 0) {
        // Si el correo existe, generar un token único y una fecha de expiración para el enlace de restablecimiento
        $token = bin2hex(random_bytes(32));
        $expiration = Carbon::now()->addHour()->toDateTimeString();

        // Preparar una consulta para actualizar el cliente con el token y la fecha de expiración
        $updateSql = "UPDATE clientes SET reset_token = ?, reset_expiration = ? WHERE email = ?";
        $updateStmt = $conexion->prepare($updateSql);
        // Vincular los parámetros a la consulta de actualización
        $updateStmt->bind_param("sss", $token, $expiration, $email);
        $updateStmt->execute();

        // Redirigir al usuario al formulario de cambio de contraseña con el token en la URL
        header("Location: cambiar_contrasena.php?token=" . urlencode($token));
        exit();
    } else {
        // Si el correo no se encuentra, mostrar un mensaje de error
        $error = "CORREO NO ENCONTRADO";
    }

    // Cerrar la declaración y la conexión con la base de datos
    $stmt->close();
    $conexion->close();
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <!-- Meta tag para establecer la codificación del documento y el diseño adaptativo -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restablecer Contraseña</title>

    <!-- Enlace a archivo CSS personalizado -->
    <link rel="stylesheet" href="css/estiles.css">
    
    <!-- Icono de acceso rápido en la pestaña -->
    <link rel="shortcut icon" href="../public/img/acceso.png" type="image/x-icon">

    <!-- Enlace a la librería de iconos Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body id="fondo" style="background-image: url('img/imagen22.png')">
    <!-- Icono para regresar a la página de inicio -->
    <a href="index.php" class="home-icon"><i class="fas fa-home"></i></a>
    <br><br><br><br>

    <!-- Formulario para ingresar el correo electrónico -->
    <form id="form1" action="validar_email.php" method="post">
        <br><br>
        <h2>RESTABLECER CONTRASEÑA</h2>

        <!-- Mensaje para redirigir al login si ya tiene cuenta -->
        <div class="register-container">
            <p>¿Ya tienes una cuenta? <a href="login.php">Inicia sesión aquí</a></p>
        </div>

        <!-- Mostrar mensaje de error si existe -->
        <?php if (!empty($error)): ?>
            <div style="color: grey; font-weight: bold; padding: 10px; border: 1px solid grey; 
                        border-radius: 5px; background-color: #f2f2f2; font-size: 14px;">
                <?php echo htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>

        <!-- Campo de entrada para el correo electrónico -->
        <input type="email" id="email" name="email" placeholder="Dirección de correo electrónico" required>

        <br><br>

        <!-- Botón para enviar el formulario -->
        <div class="submit-container">
            <input style="background-color: #134914;color:white;padding: 10px 15px;margin: 8px 0;
            cursor: pointer;width: 75%;border-radius: 30px;border: none;"
            onmouseover="this.style.backgroundColor='#0f3b0e'; this.style.opacity='0.8';"
            onmouseout="this.style.backgroundColor='#134914'; this.style.opacity='1';" 
            type="submit" class="btn" name="btningresar" value="Validar">
        </div>
    </form>
</body>

</html>
