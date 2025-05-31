<?php
// Inicia una nueva sesión o reanuda la sesión existente.
session_start();

// Verifica si no se han establecido las variables de sesión 'nombre' o 'apellido'.
if (!isset($_SESSION['nombre']) || !isset($_SESSION['apellido'])) {
    // Si no se han establecido, redirige al usuario a la página de inicio de sesión.
    header("Location: login.php");
    exit();
}

// Incluye el archivo de configuración que contiene los datos de conexión a la base de datos.
require '../app/config/config.php'; 

// Verifica el método de solicitud HTTP.
switch ($_SERVER["REQUEST_METHOD"]) {
    case "POST":
        // Decodifica el carrito de compras enviado en formato JSON.
        $carrito = json_decode($_POST['carrito'], true);

        // Comprueba si el carrito no está vacío.
        if (!empty($carrito)) {
            // Escapa los datos del formulario para prevenir inyecciones XSS.
            $nombre = htmlspecialchars($_POST['nombre']);
            $direccion = htmlspecialchars($_POST['direccion']);
            $ciudad = htmlspecialchars($_POST['ciudad']);
            $telefono = htmlspecialchars($_POST['telefono']);

            // Calcula el total del carrito.
            $total = 0;
            foreach ($carrito as $item) {
                $subtotal = $item['precio'] * $item['cantidad'];
                $total += $subtotal;
            }

            // Obtiene el id del cliente desde la sesión y establece la fecha del pedido.
            $id_cliente = $_SESSION['id_cliente']; 
            $fecha_pedido = date('Y-m-d H:i:s'); 

            // Inserta un nuevo pedido en la base de datos.
            $query_pedido = "INSERT INTO pedidos (id_cliente, fecha_pedido, total, estado) VALUES (?, ?, ?, 'Pendiente')";
            $stmt_pedido = $conexion->prepare($query_pedido);
            $stmt_pedido->bind_param('isd', $id_cliente, $fecha_pedido, $total);
            $stmt_pedido->execute();
            // Obtiene el id del pedido recién insertado.
            $id_pedido = $stmt_pedido->insert_id;

            // Inserta los detalles del pedido en la base de datos.
            foreach ($carrito as $item) {
                $subtotal = $item['precio'] * $item['cantidad'];
                $query_detalle = "INSERT INTO detalle_pedido (id_pedido, id_producto, precio_unitario, cantidad, subtotal) VALUES (?, ?, ?, ?, ?)";
                $stmt_detalle = $conexion->prepare($query_detalle);
                $stmt_detalle->bind_param('iidid', $id_pedido, $item['id'], $item['precio'], $item['cantidad'], $subtotal);
                $stmt_detalle->execute();
            }

            // Inserta la información del envío en la base de datos.
            $query_envio = "INSERT INTO envios (id_pedido, nombre_completo, direccion, ciudad, telefono) VALUES (?, ?, ?, ?, ?)";
            $stmt_envio = $conexion->prepare($query_envio);
            $stmt_envio->bind_param('issss', $id_pedido, $nombre, $direccion, $ciudad, $telefono);
            $stmt_envio->execute();

            // Establece la fecha de emisión de la factura.
            $fecha_emision = date('Y-m-d H:i:s');
            // Inserta la factura en la base de datos.
            $query_factura = "INSERT INTO facturacion (id_pedido, id_cliente, fecha_emision, monto_total) VALUES (?, ?, ?, ?)";
            $stmt_factura = $conexion->prepare($query_factura);
            $stmt_factura->bind_param('iisd', $id_pedido, $id_cliente, $fecha_emision, $total);
            $stmt_factura->execute();

            // Muestra una alerta de agradecimiento y redirige al usuario a la página de agradecimiento.
            echo '<script>
            alert("Gracias por su compra. Pronto le enviaremos sus productos.");
            setTimeout(function() {
                window.location.href = "gracias.php?id_pedido=' . $id_pedido . '"; 
            });
        </script>';
        
        } else {
            // Si el carrito está vacío, muestra un mensaje de advertencia.
            echo "<p class='alert alert-warning text-center'>El carrito está vacío.</p>";
        }
        break;
    default:
        // Si el método de solicitud no es POST, muestra un mensaje de solicitud inválida.
        echo "<p class='alert alert-danger text-center'>Solicitud inválida.</p>";
        break;
}