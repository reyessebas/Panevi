# Panevi
Tienda en linea enfocada en productos elaborados con panela. Incluye catalogo público, carrito, procesamiento de pedidos y generación de reportes en PDF.

## Caracteristicas
- Catalogo de productos con carrito y botones de compra [public/productos.php](public/productos.php).
- Registro e inicio de sesión para clientes, almacenamiento de datos de contacto y direccion [app/controladores/UsuarioControlador.php](app/controladores/UsuarioControlador.php) / [app/modelos/Usuario.php](app/modelos/Usuario.php).
- Inicio de sesión para administradores y clientes desde [app/controladores/AuthControlador.php](app/controladores/AuthControlador.php).
- Procesamiento de pedidos: crea pedido, detalle, envio y factura a partir del carrito [public/procesar_compra.php](public/procesar_compra.php).
- Reportes PDF de clientes, productos, pedidos, detalles, envios y facturacion usando FPDF [public/reporte_pdf.php](public/reporte_pdf.php).

## Requisitos
- PHP 8.x con extensiones mysqli y gd habilitadas.
- Servidor MySQL/MariaDB.
- Composer para instalar dependencias PHP (usa nesbot/carbon).
- Servidor web apuntando al directorio `public/` (o `php -S localhost:8000 -t public`).

## Instalacion y configuracion
1) Instala dependencias PHP
```bash
composer install
```
2) Configura la conexion a base de datos en [app/config/config.php](app/config/config.php) (host, usuario, contraseña, nombre de base de datos). No compartas credenciales reales en el repositorio.
3) Crea la base de datos con las tablas que usa la app:
	- administradores (email, password en texto plano segun código actual, nombre, apellido)
	- clientes (id_cliente, nombre, apellido, email, password md5, telefono, direccion)
	- productos (id_producto, nombre, precio, imagen)
	- pedidos (id_pedido, id_cliente, fecha_pedido, total, estado)
	- detalle_pedido (id_detalle_pedido, id_pedido, id_producto, precio_unitario, cantidad, subtotal)
	- envios (id_envio, id_pedido, nombre_completo, direccion, ciudad, telefono)
	- facturacion (id_factura, id_pedido, id_cliente, fecha_emision, monto_total)
4) Coloca las imagenes de productos en la ruta usada en la columna `imagen` (por ejemplo `public/Imagenes_productos/`).
5) Ejecuta el servidor de desarrollo (ejemplo con el servidor embebido de PHP):
```bash
php -S localhost:8000 -t public
```

## Flujo rapido
- Visitante navega a `productos.php`, añade items al carrito y presiona "Pagar". Si no ha iniciado sesión se le solicita registro/login.
- Clientes registrados realizan checkout en [public/procesar_compra.php](public/procesar_compra.php), que crea pedido, detalle, envio y factura.
- Administradores pueden autenticarse y generar el reporte consolidado en PDF desde [public/reporte_pdf.php](public/reporte_pdf.php).

## Notas de seguridad pendientes
- Las contraseñas de clientes se almacenan con md5 y las de administradores sin hash: conviene migrar a password_hash() y usar HTTPS.
- Valida y sanea entradas en formularios y consultas SQL para evitar inyecciones.

