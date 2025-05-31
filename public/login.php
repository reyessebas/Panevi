<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/estiles.css">
    <link rel="shortcut icon" href="../public/img/acceso.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body id="fondo" style="background-image: url('img/imagen22.png')">
<a href="index.php" class="home-icon"><i class="fas fa-home"></i></a>
    <br><br>
    <br><br>
    <form id="form1" method="post"> 
        <h2>INGRESO USUARIOS REGISTRADOS</h2>
        <div class="register-container">
        <p>¿No tienes una cuenta? <a href="registro.php">Regístrate aquí</a></p>
    </div>
        <?php 
        include "../app/config/config.php";
        include "../app/controladores/AuthControlador.php";
        ?>
        <input type="email" id="email" name="email" placeholder="Dirección de correo electrónico">

        <input type="password" id="password" name="password" placeholder="Contraseña">
        <a href="validar_email.php" style="text-decoration: none;"><p>¿Contraseña olvidada?</p></a>
        

        <div class="submit-container">
        <input style="background-color: #134914;color:white;padding: 10px 15px;margin: 8px 0;
        cursor: pointer;width: 75%;border-radius: 30px;border: none;"
        onmouseover="this.style.backgroundColor='#0f3b0e'; this.style.opacity='0.8';"
        onmouseout="this.style.backgroundColor='#134914'; this.style.opacity='1';"
        type="submit" class="btn" name="btningresar"value="Iniciar Sesion">
        </div>
    </form>
    
</body>
</html>
