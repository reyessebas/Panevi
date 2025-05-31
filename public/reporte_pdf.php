<?php
// Incluye el archivo de configuración que contiene los datos de conexión a la base de datos.
require '../app/config/config.php';
// Incluye la librería FPDF para la generación de archivos PDF.
require '../app/librerias/FPDF/fpdf.php';  

// Define una clase PDF que extiende de FPDF.
class PDF extends FPDF {
    // Método para definir el encabezado del PDF.
    function Header() {
        // Añade una imagen en el encabezado.
        $this->Image('../public/img/logo_nav (1).png', 10, 10, 20); 
        // Establece la fuente a Arial, negrita, tamaño 16.
        $this->SetFont('Arial', 'B', 16);
        // Establece el color del texto a un verde oscuro.
        $this->SetTextColor(0, 100, 0); 
        // Añade una celda con el título del reporte.
        $this->Cell(0, 10, 'PANEVI. Reporte Completo de Ventas y Pedidos', 0, 1, 'C');
        // Añade una línea en blanco.
        $this->Ln(10); 
    }

    // Método para definir el pie de página del PDF.
    function Footer() {
        // Posiciona el pie de página a 15 mm del final.
        $this->SetY(-15);
        // Establece la fuente a Arial, cursiva, tamaño 8.
        $this->SetFont('Arial', 'I', 8);
        // Añade una celda con el número de página.
        $this->Cell(0, 10, 'Pagina ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }

   // Método para crear una tabla en el PDF.
   function CrearTabla($header, $data, $widths, $headerColor = [0, 100, 0], $rowColor = [230, 240, 230]) {
       // Calcula el ancho total de la tabla.
       $totalWidth = array_sum($widths);
       // Centra la tabla en la página.
       $this->SetX(($this->w - $totalWidth) / 2);

       // Establece el color de relleno del encabezado.
       $this->SetFillColor($headerColor[0], $headerColor[1], $headerColor[2]); 
       // Establece el color del texto del encabezado.
       $this->SetTextColor(255); 
       // Establece el color de los bordes del encabezado.
       $this->SetDrawColor(0, 50, 0); 
       // Establece el ancho de línea.
       $this->SetLineWidth(.3);
       // Establece la fuente a Arial, negrita, tamaño 12.
       $this->SetFont('Arial', 'B', 12);

       // Añade las celdas del encabezado.
       for ($i = 0; $i < count($header); $i++) {
           $this->Cell($widths[$i], 7, $header[$i], 1, 0, 'C', true); 
       }
       // Añade una línea en blanco.
       $this->Ln();

       // Establece el color de relleno de las filas.
       $this->SetFillColor($rowColor[0], $rowColor[1], $rowColor[2]); 
       // Establece el color del texto de las filas.
       $this->SetTextColor(0); 
       // Establece la fuente a Arial, tamaño 10.
       $this->SetFont('Arial', '', 10);

       // Variable para alternar el color de fondo de las filas.
       $fill = false;
       // Itera a través de los datos para crear las filas de la tabla.
       foreach ($data as $row) {
           // Centra cada fila en la página.
           $this->SetX(($this->w - $totalWidth) / 2);  
        for ($i = 0; $i < count($row); $i++) {
            $this->Cell($widths[$i], 6, $row[$i], 'LR', 0, 'C', $fill); 
        }
        $this->Ln();
        $fill = !$fill; 
    }
    $this->SetX(($this->w - $totalWidth) / 2);
    $this->Cell($totalWidth, 0, '', 'T');
    $this->Ln(10); 
}

// Función para generar un reporte de clientes
function ReporteClientes($conexion) {
    // Establece la fuente a Arial, negrita, tamaño 12.
    $this->SetFont('Arial', 'B', 12);
    // Añade un título centrado para la sección de clientes.
    $this->Cell(0, 10, 'Clientes', 0, 1, 'C');  

    // Define los encabezados de la tabla de clientes.
    $header = array('ID Cliente', 'Nombre', 'Email', 'Telefono', 'Direccion');
    // Define los anchos de las columnas de la tabla de clientes.
    $widths = array(20, 30, 60, 30, 50);

    // Consulta para seleccionar los campos necesarios de la tabla clientes.
    $query = "SELECT id_cliente, nombre, email, telefono, direccion FROM clientes";
    // Ejecuta la consulta y almacena el resultado en $result.
    $result = $conexion->query($query);

    // Inicializa un arreglo para almacenar los datos de la tabla.
    $data = [];
    // Itera a través de los resultados de la consulta.
    while ($row = $result->fetch_assoc()) {
        // Añade cada fila al arreglo de datos.
        $data[] = array($row['id_cliente'], $row['nombre'], $row['email'], $row['telefono'], $row['direccion']);
    }

    // Llama a la función CrearTabla para generar la tabla en el PDF.
    $this->CrearTabla($header, $data, $widths);
}

// Función para generar un reporte de productos
function ReporteProductos($conexion) {
    // Establece la fuente a Arial, negrita, tamaño 12.
    $this->SetFont('Arial', 'B', 12);
    // Añade un título centrado para la sección de productos.
    $this->Cell(0, 10, 'Productos', 0, 1, 'C');
    
    // Define los encabezados de la tabla de productos.
    $header = array('ID Producto', 'Nombre', 'Precio');
    // Define los anchos de las columnas de la tabla de productos.
    $widths = array(30, 90, 30); 

    // Consulta para seleccionar los campos necesarios de la tabla productos.
    $query = "SELECT id_producto, nombre, precio FROM productos";
    // Ejecuta la consulta y almacena el resultado en $result.
    $result = $conexion->query($query);

    // Inicializa un arreglo para almacenar los datos de la tabla.
    $data = [];
    // Itera a través de los resultados de la consulta.
    while ($row = $result->fetch_assoc()) {
        // Añade cada fila al arreglo de datos, formateando el precio.
        $data[] = array($row['id_producto'], $row['nombre'], '$' . number_format($row['precio'], 2));
    }

    // Llama a la función CrearTabla para generar la tabla en el PDF.
    $this->CrearTabla($header, $data, $widths);
}

    // Función para generar un reporte de pedidos
function ReportePedidos($conexion) {
    // Establece la fuente a Arial, negrita, tamaño 12.
    $this->SetFont('Arial', 'B', 12);
    // Añade un título centrado para la sección de pedidos.
    $this->Cell(0, 10, 'Pedidos', 0, 1, 'C');
    
    // Define los encabezados de la tabla de pedidos.
    $header = array('ID Pedido', 'ID Cliente', 'Fecha Pedido', 'Total', 'Estado');
    // Define los anchos de las columnas de la tabla de pedidos.
    $widths = array(30, 30, 40, 30, 40); 

    // Consulta para seleccionar los campos necesarios de la tabla pedidos.
    $query = "SELECT id_pedido, id_cliente, fecha_pedido, estado, total FROM pedidos";
    // Ejecuta la consulta y almacena el resultado en $result.
    $result = $conexion->query($query);

    // Inicializa un arreglo para almacenar los datos de la tabla.
    $data = [];
    // Itera a través de los resultados de la consulta.
    while ($row = $result->fetch_assoc()) {
        // Añade cada fila al arreglo de datos, formateando el total.
        $data[] = array($row['id_pedido'], $row['id_cliente'], $row['fecha_pedido'], '$' . number_format($row['total'], 2), $row['estado']);
    }

    // Llama a la función CrearTabla para generar la tabla en el PDF.
    $this->CrearTabla($header, $data, $widths);
}


// Función para generar un reporte de los detalles de pedidos
function ReporteDetallePedido($conexion) {
    // Establece la fuente a Arial, negrita, tamaño 12.
    $this->SetFont('Arial', 'B', 12);
    // Añade un título centrado para la sección de detalles de pedidos.
    $this->Cell(0, 10, 'Detalle de Pedidos', 0, 1, 'C');
    
    // Define los encabezados de la tabla de detalles de pedidos.
    $header = array('ID Detalle', 'ID Pedido', 'ID Producto', 'Cantidad', 'Precio Unitario', 'Subtotal');
    // Define los anchos de las columnas de la tabla de detalles de pedidos.
    $widths = array(30, 30, 30, 20, 40, 40);
    
    // Consulta para seleccionar los campos necesarios de la tabla detalle_pedido.
    $query = "SELECT id_detalle_pedido, id_pedido, id_producto, cantidad, precio_unitario, subtotal FROM detalle_pedido";
    // Ejecuta la consulta y almacena el resultado en $result.
    $result = $conexion->query($query);

    // Inicializa un arreglo para almacenar los datos de la tabla.
    $data = [];
    // Itera a través de los resultados de la consulta.
    while ($row = $result->fetch_assoc()) {
        // Añade cada fila al arreglo de datos, formateando el precio unitario y el subtotal.
        $data[] = array($row['id_detalle_pedido'], $row['id_pedido'], $row['id_producto'], $row['cantidad'], '$' . number_format($row['precio_unitario'], 2), '$' . number_format($row['subtotal'], 2));
    }

    // Llama a la función CrearTabla para generar la tabla en el PDF.
    $this->CrearTabla($header, $data, $widths);
}

    // Función para generar un reporte de envíos
function ReporteEnvios($conexion) {
    // Establece la fuente a Arial, negrita, tamaño 12.
    $this->SetFont('Arial', 'B', 12);
    // Añade un título centrado para la sección de envíos.
    $this->Cell(0, 10, 'Envios', 0, 1, 'C');
    
    // Define los encabezados de la tabla de envíos.
    $header = array('ID Envio', 'ID Pedido', 'Nombre Completo', 'Direccion', 'Ciudad');
    // Define los anchos de las columnas de la tabla de envíos.
    $widths = array(20, 30, 55, 50, 40); 

    // Consulta para seleccionar los campos necesarios de la tabla envios.
    $query = "SELECT id_envio, id_pedido, nombre_completo, direccion, ciudad FROM envios";
    // Ejecuta la consulta y almacena el resultado en $result.
    $result = $conexion->query($query);
    
    // Inicializa un arreglo para almacenar los datos de la tabla.
    $data = [];
    // Itera a través de los resultados de la consulta.
    while ($row = $result->fetch_assoc()) {
        // Añade cada fila al arreglo de datos.
        $data[] = array($row['id_envio'], $row['id_pedido'], $row['nombre_completo'], $row['direccion'], $row['ciudad']);
    }
    
    // Llama a la función CrearTabla para generar la tabla en el PDF.
    $this->CrearTabla($header, $data, $widths);
}

// Función para generar un reporte de facturación
    function ReporteFacturacion($conexion) {
            // Establece la fuente a Arial, negrita, tamaño 12.
        $this->SetFont('Arial', 'B', 12);
            // Añade un título centrado para la sección de facturación.
        $this->Cell(0, 10, 'Facturacion', 0, 1, 'C');
            // Define los encabezados de la tabla de facturación.
        $header = array('ID Factura', 'ID Pedido', 'ID Cliente', 'Fecha Emision', 'Monto Total');
            // Define los anchos de las columnas de la tabla de facturación.
        $widths = array(30, 30, 30, 40, 40); 
            // Consulta para seleccionar los campos necesarios de la tabla facturación.
        $query = "SELECT id_factura, id_pedido, id_cliente, fecha_emision, monto_total FROM facturacion";
            // Ejecuta la consulta y almacena el resultado en $result.
        $result = $conexion->query($query);
    // Inicializa un arreglo para almacenar los datos de la tabla.

        $data = [];
            // Itera a través de los resultados de la consulta.

        while ($row = $result->fetch_assoc()) {
                    // Añade cada fila al arreglo de datos, formateando el monto total.
            $data[] = array($row['id_factura'], $row['id_pedido'], $row['id_cliente'], $row['fecha_emision'], '$' . number_format($row['monto_total'], 2));
        }
    // Llama a la función CrearTabla para generar la tabla en el PDF.

        $this->CrearTabla($header, $data, $widths);
    }
}

// Crea una nueva instancia de la clase PDF.
$pdf = new PDF();
// AliasNbPages es una función que permite el uso de {nb} para el número total de páginas.
$pdf->AliasNbPages();
// Añadir una nueva página al documento PDF.
$pdf->AddPage();

// Genera el reporte de clientes.
$pdf->ReporteClientes($conexion);
// Genera el reporte de productos.
$pdf->ReporteProductos($conexion);
// Genera el reporte de pedidos.
$pdf->ReportePedidos($conexion);
// Genera el reporte de detalles de pedidos.
$pdf->ReporteDetallePedido($conexion);
// Genera el reporte de envíos.
$pdf->ReporteEnvios($conexion);
// Genera el reporte de facturación.
$pdf->ReporteFacturacion($conexion);

// Salida del documento PDF.
$pdf->Output();
