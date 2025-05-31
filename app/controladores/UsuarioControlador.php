<?php

// Incluye el archivo de configuración que contiene los datos de conexión a la base de datos.
require_once '../config/config.php';
// Incluye el archivo de modelo que contiene la clase Usuario.
require_once '../modelos/Usuario.php';

// Define la clase UsuarioControlador.
class UsuarioControlador
{
    // Declara una propiedad privada para el modelo de usuario.
    private $usuarioModelo;

    // Constructor de la clase UsuarioControlador.
    public function __construct()
    {
        // Crea una nueva instancia del modelo Usuario y la asigna a la propiedad usuarioModelo.
        $this->usuarioModelo = new Usuario();
    }

    // Método para registrar un nuevo usuario.
    public function registrar()
    {
        // Comprueba si el método de solicitud es POST.
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Recupera los datos del formulario enviados a través de POST.
            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];
            $email = $_POST['email'];
            // Hashea la contraseña usando md5.
            $password = md5($_POST['password']);
            $telefono = $_POST['telefono'];
            $direccion = $_POST['direccion'];

            // Llama al método registrar del modelo de usuario y pasa los datos del formulario.
            if ($this->usuarioModelo->registrar($nombre, $apellido, $email, $password, $telefono, $direccion)) {
                // Si el registro es exitoso, redirige al usuario a la página de inicio de sesión.
                header('Location: ../../public/login.php');
            } else {
                // Si ocurre un error, termina el script y muestra un mensaje de error.
                die('Error al registrar el usuario');
            }
        }
    }
}

// Crea una nueva instancia del controlador de usuario.
$controlador = new UsuarioControlador();
// Llama al método registrar del controlador de usuario.
$controlador->registrar();