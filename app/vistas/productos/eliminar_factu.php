<?php
// Inicia una nueva sesión o reanuda la sesión existente.
session_start();

// Incluye el archivo de configuración que contiene los datos de conexión a la base de datos.
require '../../config/config.php';

// Comprueba si el método de solicitud es POST.
if ($_SERVER["REQUEST_METHOD"] == "POST") 
    // Comprueba si se ha pasado el parámetro 'id_factura' en la solicitud POST.
    if (isset($_POST['id_factura'])) {
        // Recupera el id de la factura desde el parámetro 'id_factura' de la solicitud POST y lo convierte en un entero.
        $id_factura = intval($_POST['id_factura']);

        // Define la consulta SQL para eliminar una factura de la tabla facturacion utilizando un parámetro.
        $query = "DELETE FROM facturacion WHERE id_factura = ?";n
        // Prepara la consulta SQL.
        $stmt = $conexion->prepare($query);
        // Vincula el parámetro del id de la factura a la consulta preparada.
        $stmt->bind_param('i', $id_factura);
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