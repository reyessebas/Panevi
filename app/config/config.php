<?php
// Definición de las credenciales de la base de datos.
$Server = "localhost"; // Nombre del servidor
$user = "root"; // Nombre de usuario de la base de datos
$pass = ""; // Contraseña de la base de datos
$db = "propaneviv1"; // Nombre de la base de datos

// Establecimiento de la conexión con la base de datos.
$conexion = new mysqli($Server, $user, $pass, $db);

// Verificación de la conexión.
if ($conexion->connect_errno) {
    // Si la conexión falla, se imprime un mensaje de error.
    echo "no se conecto <br>";
}

// Función para obtener la conexión a la base de datos.
function conectar() {
    // Se utiliza la variable global $conexion dentro de la función.
    global $conexion;
    // Se devuelve la conexión establecida.
    return $conexion;
}
