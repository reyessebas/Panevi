<?php

// Incluye el archivo de configuración que contiene los datos de conexión a la base de datos.
require_once '../config/config.php';

// Define la clase Usuario.
class Usuario
{
    // Declara una propiedad privada para la conexión a la base de datos.
    private $conexion;

    // Constructor de la clase Usuario.
    public function __construct()
    {
        // Establece la conexión a la base de datos utilizando la función conectar().
        $this->conexion = conectar();
    }

    // Método para registrar un nuevo usuario.
    public function registrar($nombre, $apellido, $email, $passwordEncriptado, $telefono, $direccion)
    {
        // Define la consulta SQL para insertar un nuevo registro en la tabla clientes.
        $sql = "INSERT INTO clientes (nombre, apellido, email, password, telefono, direccion) 
                VALUES (?, ?, ?, ?, ?, ?)";
        
        // Prepara la consulta SQL.
        $stmt = $this->conexion->prepare($sql);
        
        // Vincula los parámetros a la consulta preparada.
        $stmt->bind_param("ssssss", $nombre, $apellido, $email, $passwordEncriptado, $telefono, $direccion);

        // Ejecuta la consulta y devuelve true si tiene éxito, de lo contrario, devuelve false.
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}