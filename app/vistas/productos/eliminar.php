<?php
// Incluye el archivo de configuración que contiene los datos de conexión a la base de datos.
include("../../config/config.php");

// Comprueba si se ha pasado el parámetro 'id' en la URL.
if (isset($_GET['id'])) {
    // Recupera el id del producto desde el parámetro 'id' de la URL.
    $id_producto = $_GET['id'];
    // Define la consulta SQL para eliminar un producto de la tabla productos.
    $sql = "DELETE FROM productos WHERE id_producto = $id_producto";

    // Ejecuta la consulta y comprueba si se realizó correctamente.
    if ($conexion->query($sql) === TRUE) {
        // Si la eliminación es exitosa, redirige al usuario a la página de productos del administrador.
        header("Location: ../../../public/productos_admin.php");
    } else {
        // Si ocurre un error, muestra un mensaje de error.
        echo "Error eliminando el producto: " . $conexion->error;
    }
}