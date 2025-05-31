<?php
// Inicia una nueva sesión o reanuda la sesión existente.
session_start();

// Incluye el archivo de configuración que contiene los datos de conexión a la base de datos.
require '../app/config/config.php';
// Incluye la librería FPDF para generar archivos PDF.
require '../app/librerias/FPDF/fpdf.php'; 

// Comprueba si no se ha establecido la sesión 'id_cliente' o si no se ha pasado el parámetro 'id_pedido'.
if (!isset($_SESSION['id_cliente']) || !isset($_GET['id_pedido'])) {
    // Si la condición anterior se cumple, redirige al usuario a la página de inicio de sesión.
    header("Location: login.php");
    // Finaliza la ejecución del script para asegurarse de que no se ejecute código adicional.
    exit();
}

// Recupera el id del pedido desde el parámetro 'id_pedido' de la URL y lo convierte en un entero.
$id_pedido = intval($_GET['id_pedido']);
// Recupera el id del cliente desde la sesión.
$id_cliente = $_SESSION['id_cliente'];

// Define la consulta SQL para seleccionar la información del pedido y el cliente.
$query_pedido = "SELECT p.id_pedido, p.fecha_pedido, p.total, c.nombre, c.apellido, e.direccion, e.ciudad, e.telefono 
                FROM pedidos p 
                JOIN clientes c ON p.id_cliente = c.id_cliente 
                JOIN envios e ON p.id_pedido = e.id_pedido 
                WHERE p.id_pedido = ? AND p.id_cliente = ?";
                
// Prepara la consulta SQL.
$stmt = $conexion->prepare($query_pedido);
// Vincula los parámetros del id del pedido y del id del cliente a la consulta preparada.
$stmt->bind_param('ii', $id_pedido, $id_cliente);
// Ejecuta la consulta.
$stmt->execute();
// Almacena el resultado de la consulta.
$result_pedido = $stmt->get_result();
// Recupera los datos del pedido.
$pedido = $result_pedido->fetch_assoc();

// Comprueba si el pedido fue encontrado.
if (!$pedido) {
    // Si el pedido no fue encontrado, muestra un mensaje de error.
    echo "Pedido no encontrado.";
    exit();
}

// Crea una nueva instancia de FPDF.
$pdf = new FPDF();
// Agrega una nueva página al PDF.
$pdf->AddPage();

// Agrega una imagen (logo) al PDF.
$pdf->Image('../public/img/logo_nav (1).png', 10, 10, 20); 
// Establece la fuente y el tamaño del texto.
$pdf->SetFont('Arial', 'B', 16);

// Define los colores para el texto.
$verdeOscuro = array(0, 100, 0);
$grisClaro = array(245, 245, 245);

// Establece el color del texto a verde oscuro.
$pdf->SetTextColor($verdeOscuro[0], $verdeOscuro[1], $verdeOscuro[2]);
// Agrega un título al PDF.
$pdf->Cell(0, 10, 'PANEVI. Factura de Compra', 0, 1, 'C');
$pdf->Ln(10);

// Agrega la información del cliente al PDF.
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(100, 10, 'Informacion del Cliente', 0, 1);
$pdf->SetFont('Arial', '', 12);
$pdf->SetTextColor(0, 0, 0); 
$pdf->Cell(100, 10, 'Cliente: ' . $pedido['nombre'] . ' ' . $pedido['apellido'], 0, 1);
$pdf->Cell(100, 10, 'Direccion: ' . $pedido['direccion'], 0, 1);
$pdf->Cell(100, 10, 'Ciudad: ' . $pedido['ciudad'], 0, 1);
$pdf->Cell(100, 10, 'Telefono: ' . $pedido['telefono'], 0, 1);
$pdf->Ln(5);

// Establece el color del texto utilizando los valores RGB definidos en $verdeOscuro.
$pdf->SetTextColor($verdeOscuro[0], $verdeOscuro[1], $verdeOscuro[2]);
// Establece la fuente a Arial, negrita, tamaño 12.
$pdf->SetFont('Arial', 'B', 12);
// Añade una celda con el título "Información del Pedido".
$pdf->Cell(100, 10, 'Informacion del Pedido', 0, 1);
// Cambia la fuente a Arial, tamaño 12, sin negrita.
$pdf->SetFont('Arial', '', 12);
// Restablece el color del texto a negro.
$pdf->SetTextColor(0, 0, 0); 
// Añade una celda con la fecha del pedido.
$pdf->Cell(100, 10, 'Fecha del Pedido: ' . $pedido['fecha_pedido'], 0, 1);
// Añade una celda con el total a pagar.
$pdf->Cell(100, 10, 'Total a Pagar: $' . number_format($pedido['total'], 2), 0, 1);
// Añade una línea en blanco.
$pdf->Ln(10);

// Establece el color del texto utilizando los valores RGB definidos en $verdeOscuro.
$pdf->SetTextColor($verdeOscuro[0], $verdeOscuro[1], $verdeOscuro[2]);
// Establece la fuente a Arial, negrita, tamaño 16.
$pdf->SetFont('Arial', 'B', 16);
// Añade una celda con el título "Detalle del Pedido" centrado.
$pdf->Cell(0, 10, 'Detalle del Pedido', 0, 1, 'C'); 
// Añade una línea en blanco.
$pdf->Ln(5);

// Establece la fuente a Arial, negrita, tamaño 12.
$pdf->SetFont('Arial', 'B', 12);
// Establece el color de relleno para las celdas utilizando los valores RGB definidos en $grisClaro.
$pdf->SetFillColor($grisClaro[0], $grisClaro[1], $grisClaro[2]); 
// Establece el color del texto utilizando los valores RGB definidos en $verdeOscuro.
$pdf->SetTextColor($verdeOscuro[0], $verdeOscuro[1], $verdeOscuro[2]);

// Calcula la posición X para centrar la tabla en la página.
$x_center = ($pdf->GetPageWidth() - 140) / 2; 
// Establece la posición X para la celda.
$pdf->SetX($x_center); 
// Añade una celda con el título "Producto".
$pdf->Cell(50, 10, 'Producto', 1, 0, 'C', true);
// Añade una celda con el título "Cantidad".
$pdf->Cell(30, 10, 'Cantidad', 1, 0, 'C', true);
// Añade una celda con el título "Precio".
$pdf->Cell(30, 10, 'Precio', 1, 0, 'C', true);
// Añade una celda con el título "Subtotal".
$pdf->Cell(30, 10, 'Subtotal', 1, 1, 'C', true);

// Define la consulta SQL para seleccionar los detalles del pedido.
$query_detalles = "SELECT dp.id_producto, dp.cantidad, dp.precio_unitario, dp.subtotal, pr.nombre 
                   FROM detalle_pedido dp 
                   JOIN productos pr ON dp.id_producto = pr.id_producto 
                   WHERE dp.id_pedido = ?";
// Prepara la consulta SQL.
$stmt_detalle = $conexion->prepare($query_detalles);
// Vincula el parámetro del id del pedido a la consulta preparada.
$stmt_detalle->bind_param('i', $id_pedido);
// Ejecuta la consulta.
$stmt_detalle->execute();
// Obtiene el resultado de la consulta.
$result_detalle = $stmt_detalle->get_result();

// Establece la fuente a Arial, tamaño 12, sin negrita.
$pdf->SetFont('Arial', '', 12);
// Restablece el color del texto a negro.
$pdf->SetTextColor(0, 0, 0); 
// Itera a través de los detalles del pedido devueltos por la consulta.
while ($detalle = $result_detalle->fetch_assoc()) {
    // Establece la posición X para la celda.
    $pdf->SetX($x_center);
    // Añade una celda con el nombre del producto.
    $pdf->Cell(50, 10, $detalle['nombre'], 1, 0, 'C');
    // Añade una celda con la cantidad del producto.
    $pdf->Cell(30, 10, $detalle['cantidad'], 1, 0, 'C');
    // Añade una celda con el precio unitario del producto.
    $pdf->Cell(30, 10, '$' . number_format($detalle['precio_unitario'], 2), 1, 0, 'C');
    // Añade una celda con el subtotal del producto.
    $pdf->Cell(30, 10, '$' . number_format($detalle['subtotal'], 2), 1, 1, 'C');
}

// Establece la fuente a Arial, negrita, tamaño 12.
$pdf->SetFont('Arial', 'B', 12);
// Establece el color del texto utilizando los valores RGB definidos en $verdeOscuro.
$pdf->SetTextColor($verdeOscuro[0], $verdeOscuro[1], $verdeOscuro[2]);
// Establece la posición X para la celda.
$pdf->SetX($x_center); 
// Añade una celda con el título "Total a Pagar" y relleno.
$pdf->Cell(110, 10, 'Total a Pagar', 1, 0, 'C', true);
// Restablece el color del texto a negro.
$pdf->SetTextColor(0, 0, 0); 
// Añade una celda con el total a pagar.
$pdf->Cell(30, 10, '$' . number_format($pedido['total'], 2), 1, 1, 'C', true);

// Añade una línea en blanco.
$pdf->Ln(20);
// Establece la fuente a Arial, cursiva, tamaño 12.
$pdf->SetFont('Arial', 'I', 12);
// Restablece el color del texto a negro.
$pdf->SetTextColor(0, 0, 0); 
// Añade una celda con el mensaje de agradecimiento.
$pdf->Cell(0, 10, 'Gracias por su compra.', 0, 1, 'C');

// Genera el archivo PDF y fuerza la descarga con el nombre "factura_{id_pedido}.pdf".
$pdf->Output('D', 'factura_' . $id_pedido . '.pdf');