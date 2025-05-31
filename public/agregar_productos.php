<?php
// Obtiene el archivo de imagen subido desde el formulario.
$imagen = $_FILES["imagen"]["tmp_name"];
// Obtiene el nombre del archivo de imagen subido.
$Nombre_imagen = $_FILES["imagen"]["name"];
// Obtiene la extensión del archivo de imagen y la convierte a minúsculas.
$tipoImagen = strtolower(pathinfo($Nombre_imagen, PATHINFO_EXTENSION));
// Define la carpeta donde se almacenarán las imágenes de los productos.
$carpeta = "imagenes_productos/";

// Comprueba si el tipo de imagen es JPG, JPEG o PNG.
if ($tipoImagen == "jpg" || $tipoImagen == "jpeg" || $tipoImagen == "png") {
    // Recupera el nombre del producto desde el formulario y elimina los espacios en blanco al inicio y al final.
    $nombre = trim($_POST["Nombre_producto"]);
    // Recupera el precio del producto desde el formulario.
    $precio = $_POST["Precio"];

    // Incluye el archivo de configuración que contiene los datos de conexión a la base de datos.
    include "../app/config/config.php";

    // Comprueba si la conexión a la base de datos ha fallado.
    if ($conexion->connect_error) {
        // Si la conexión falla, muestra un mensaje de error y detiene la ejecución del script.
        die("La conexión falló: " . $conexion->connect_error);
    }

    // Inserta un nuevo producto en la tabla productos con el nombre y el precio proporcionados.
    $registro = $conexion->query("INSERT INTO productos(nombre, precio) VALUES ('$nombre', '$precio')");

    // Comprueba si la inserción del producto fue exitosa.
    if ($registro === true) {
        // Obtiene el ID del último registro insertado.
        $idregistro = $conexion->insert_id;
        // Define la ruta donde se almacenará la imagen del producto.
        $ruta = $carpeta . $idregistro . "." . $tipoImagen;
        // Actualiza la tabla productos para agregar la ruta de la imagen al registro del producto.
        $actualizarImagenes = $conexion->query("UPDATE productos SET imagen = '$ruta' WHERE id_producto = $idregistro");

        // Comprueba si la actualización de la imagen fue exitosa.
        if ($actualizarImagenes === true) {
            // Mueve el archivo de imagen subido a la ruta definida.
            if (move_uploaded_file($imagen, $ruta)) {
                // Si la imagen se movió correctamente, redirige al usuario a la página de productos del administrador.
                header("Location: productos_admin.php");
            } else {
                // Si la imagen no se pudo mover, muestra un mensaje de error (comentado).
            }
        } else {
            // Si la actualización de la imagen falló, muestra un mensaje de error (comentado).
        }
    } else {
        // Si la inserción del producto falló, muestra un mensaje de error (comentado).
    }

    // Cierra la conexión a la base de datos.
    $conexion->close();
} else {
    // Si el tipo de imagen no es soportado, muestra un mensaje de error.
    echo "Tipo de imagen no soportado. Solo se permiten archivos JPG, JPEG y PNG.";
}