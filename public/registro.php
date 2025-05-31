<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/css/estiles.css">
    <link rel="shortcut icon" href="../public/img/acceso.png" type="image/x-icon">
    <title>Registro</title>
    <script type="text/javascript" src="../public/js/valida1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
</head>
<body id="fondo" style="background-image: url('../public/img/imagen22.png')">
<a href="index.php" class="home-icon"><i class="fas fa-home"></i></a>
    <br>
    <form id="form2" name="miniformulario" class="formulario" method="post" onsubmit="return validarDatos()" action="../app/controladores/UsuarioControlador.php">
        <h2>FORMULARIO DE REGISTRO</h2>
        <div class="register-container">
        <p>¿Ya tienes una cuenta? <a href="login.php">Inicia sesión aquí</a></p>
    </div>
        <input type="text" id="nombre" name="nombre" placeholder="Nombre" />
        <span id="error-nombre" class="error"></span>

        <input type="text" id="apellido" name="apellido" placeholder="Apellidos" />
        <span id="error-apellido" class="error"></span>

        <input type="email" id="email" name="email" placeholder="E-mail" />
        <span id="error-email" class="error"></span>

        <input type="password" id="password" name="password" placeholder="Contraseña" />
        <span id="error-password" class="error"></span>

        <input type="text" id="telefono" name="telefono" placeholder="Teléfono" />
        <span id="error-telefono" class="error"></span>

        <input type="text" id="direccion" name="direccion" placeholder="Dirección" />
        <span id="error-direccion" class="error"></span>

        <button type="submit" id="botones">Registrarse</button>
    </form>
</body>
</html>
