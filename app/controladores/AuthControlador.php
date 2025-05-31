<?php
// Inicia una nueva sesión o reanuda la sesión existente.
session_start();

// Comprueba si se ha enviado el formulario de inicio de sesión.
if (!empty($_POST['btningresar'])) {
    // Comprueba si los campos de email y contraseña están vacíos.
    if (empty($_POST['email']) and empty($_POST['password'])) {
        // Muestra un mensaje de error si los campos están vacíos.
        echo '<div style="color: grey; font-weight: bold; padding: 10px; border: 1px solid grey; border-radius: 5px; background-color: #f2f2f2; font-size: 14px;">LOS CAMPOS ESTÁN VACÍOS</div>';
    } else {
        // Recupera el email y la contraseña enviados a través del formulario.
        $email = $_POST['email'];
        $password = md5($_POST['password']); // Encripta la contraseña con md5.
        $password1 = $_POST['password']; // La contraseña sin encriptar.

        // Consulta la base de datos para comprobar las credenciales del administrador.
        $sql = $conexion->query("SELECT * FROM administradores WHERE email='$email' AND password='$password1'");
        
        // Comprueba si se encontró un administrador con las credenciales proporcionadas.
        if ($sql->num_rows > 0) {
            // Recupera los datos del administrador.
            $datos = $sql->fetch_object();
            // Guarda los datos del administrador en la sesión.
            $_SESSION['nombre'] = $datos->nombre;
            $_SESSION['apellido'] = $datos->apellido;
            $_SESSION['email'] = $datos->email; 
            $_SESSION['tipo_usuario'] = 'administrador';
            // Redirige al administrador a la página de inicio del administrador.
            header("Location: ../public/inicio_admi.php");
            exit();
        } else {
            // Si no se encontró un administrador, comprueba las credenciales del cliente.
            $sql = $conexion->query("SELECT * FROM clientes WHERE email='$email'");
            if ($sql->num_rows > 0) {
                // Comprueba si se encontró un cliente con las credenciales proporcionadas.
                $sql = $conexion->query("SELECT * FROM clientes WHERE email='$email' AND password='$password'");
                if ($datos = $sql->fetch_object()) {
                    // Guarda los datos del cliente en la sesión.
                    $_SESSION['nombre'] = $datos->nombre;
                    $_SESSION['apellido'] = $datos->apellido;
                    $_SESSION['email'] = $datos->email; 
                    $_SESSION['id_cliente'] = $datos->id_cliente;
                    // Redirige al cliente a la página de perfil del cliente.
                    header("Location: ../public/perfil_cli.php");
                    exit();
                } else {
                    // Muestra un mensaje de error si las credenciales del cliente son incorrectas.
                    echo '<div style="color: red; font-weight: bold; padding: 10px; border: 1px solid red; border-radius: 5px; background-color: #f8d7da; font-size: 14px;">DATOS INCORRECTOS O INVÁLIDOS</div>';
                }
            } else {
                // Muestra un mensaje de error si las credenciales del cliente son incorrectas.
                echo '<div style="color: red; font-weight: bold; padding: 10px; border: 1px solid red; border-radius: 5px; background-color: #f8d7da; font-size: 14px;">DATOS INCORRECTOS O INVÁLIDOS</div>';
            }
        }
    }
}