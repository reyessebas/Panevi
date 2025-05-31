<?php
// Inicia una nueva sesión o reanuda la sesión existente.
session_start();

// Incluye el archivo de configuración que contiene los datos de conexión a la base de datos.
require '../../config/config.php';

// Comprueba si el método de solicitud es POST.
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Comprueba si se ha pasado el parámetro 'id_envio' en la solicitud POST.
    if (isset($_POST['id_envio'])) {
        // Recupera el id del envío desde el parámetro 'id_envio' de la solicitud POST y lo convierte en un entero.
        $id_envio = intval($_POST['id_envio']);

        // Define la consulta SQL para eliminar un envío de la tabla envios utilizando un parámetro.
        $query = "DELETE FROM envios WHERE id_envio = ?";
        // Prepara la consulta SQL.
        $stmt = $conexion->prepare($query);
        // Vincula el parámetro del id del envío a la consulta preparada.
        $stmt->bind_param('i', $id_envio);
        // Ejecuta la consulta.
        $stmt->execute();

        // Comprueba si se ha eliminado alguna fila.
        if ($stmt->affected_rows > 0) {
            // Si la eliminación es exitosa, redirige al usuario a la página de facturación y envíos.
            header("Location: ../../../public/factu_envios.php");
        } else {
            // Si ocurre un error, muestra una alerta y redirige al usuario.
            echo '<script>
            alert("Error al eliminar el detalle.");
            window.location.href = "ruta_a_tu_pagina.php"; // Reemplaza con la ruta a tu página
            </script>';
        }

        // Cierra la declaración preparada.
        $stmt->close();
    }
} else {
    // Muestra un mensaje de error si el método de solicitud no es válido.
    echo "Método de solicitud no válido.";
}

// Cierra la conexión a la base de datos.
$conexion->close();