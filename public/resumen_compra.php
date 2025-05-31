<?php
// Inicia una nueva sesión o reanuda la sesión existente.
session_start();

// Comprueba si no se han establecido las variables de sesión 'nombre' o 'apellido'.
if (!isset($_SESSION['nombre']) || !isset($_SESSION['apellido'])) {
	// Si no se han establecido, redirige al usuario a la página de inicio de sesión.
	header("Location: login.php");
	// Finaliza la ejecución del script para asegurarse de que no se ejecute código adicional.
	exit();
}
?>
<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="author" content="Untree.co">
	<link rel="shortcut icon" href="img/logo_nav (1).png">

	<meta name="description" content="" />
	<meta name="keywords" content="bootstrap, bootstrap4" />

	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
	<link href="css/tiny-slider.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
	<script src="js/app1.js" async></script>
	<title>Compras</title>
</head>

<body>

	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
	<nav class="custom-navbar navbar navbar-expand-md navbar-dark bg-dark" arial-label="Furni navigation bar">
		<div class="container-logo">

			<div class="header-images">
				<div style="display: flex; align-items: center; color: white; text-align: center; margin-right: 5px;">
					<span style="font-weight: bold; font-size: 17px; margin-right: 10px;">
						<?php echo htmlspecialchars($_SESSION['nombre'] . ' ' . $_SESSION['apellido']); ?>
					</span>
					<div class="dropdown">
						<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
							data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
							style="background: none; border: none; color: white;">
							<i class="fa fa-bars"></i>
						</button>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="font-size: 13px">
							<a class="dropdown-item" href="configuraciones.php" style="color: grey; font-weight: bold;">
								<i class="fa fa-key"></i> Cambiar Correo y Contraseña
							</a>
							<a class="dropdown-item" href="mis_pedidos.php" style="color: grey; font-weight: bold;">
								<i class="fa fa-shopping-cart"></i> Ver mis Pedidos y Compras
							</a>
							<a class="dropdown-item" href="logout.php" style="color: grey; font-weight: bold;">
								<i class="fa fa-sign-out-alt"></i> Cerrar Sesión
							</a>
						</div>
					</div>
				</div>
				<img src="img/logo_nav (1).png" id="logo">
				<img src="img/P.PNG" alt="Imagen 1">
				<img src="img/A.png" alt="Imagen 1">
				<img src="img/N.png" alt="Imagen 1">
				<img src="img/E.png" alt="Imagen 1">
				<img src="img/V.png" alt="Imagen 1">
				<img src="img/I.png" alt="Imagen 1">
			</div>
		</div>

		<div class="container">
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsFurni"
				aria-controls="navbarsFurni" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarsFurni">
				<ul class="custom-navbar-nav navbar-nav ms-auto mb-2 mb-md-0">
					<div class="busqueda">
						<input type="text" id="bus" placeholder="Buscar...">
						<div class="buttonb" onclick="buscarProducto()">
							<!-- Ejecuta la función buscarProducto al hacer clic -->
							<i class="fa fa-search"></i>
						</div>
					</div>
					<script>
						function buscarProducto() {
							// Obtener el valor ingresado en la barra de búsqueda
							var busqueda = document.getElementById("bus").value.toLowerCase().trim();

							// Verificar el término ingresado y redirigir a la página correspondiente

							// Búsqueda relacionada con productos
							if (busqueda.includes("panela") || busqueda.includes("productos") || busqueda.includes("productos de panela")) {
								window.location.href = "productos_cli.php"; // Redirige a la página de productos de panela
							}

							// Búsqueda relacionada con historia o beneficios de la panela
							else if (busqueda.includes("historia") || busqueda.includes("como se hace") || busqueda.includes("beneficios")) {
								window.location.href = "ver_mass.php"; // Redirige a la página con información sobre la historia o beneficios de la panela
							}

							// Búsqueda relacionada con pedidos o compras
							else if (busqueda.includes("mis pedidos") || busqueda.includes("mis compras") || busqueda.includes("compras") || busqueda.includes("pedidos")) {
								window.location.href = "mis_pedidos.php"; // Redirige a la página de pedidos realizados por el usuario
							}

							// Búsqueda relacionada con configuraciones de usuario
							else if (busqueda.includes("configuracion") || busqueda.includes("cambiar usuario") || busqueda.includes("cambiar contraseña") || busqueda.includes("perfil")) {
								window.location.href = "configuraciones.php"; // Redirige a la página de configuración del usuario
							}

							// Si no coincide ninguna opción, mostrar un mensaje de alerta
							else {
								alert("No se encontró ningún resultado relacionado con tu búsqueda. Intenta usar términos como 'panela', 'productos', 'beneficios', 'pedidos', 'configuración', etc.");
							}
						}
					</script>

					<li>
						<a class="nav-link" href="perfil_cli.php">Inicio</a>
					</li>
					<li><a style="text-align: center;" class="nav-link" href="quienes_somos.php">¿Quienes Somos?</a>
					</li>
					<li class="nav-item active"><a class="nav-link" href="productos_cli.php">Productos</a></li>
				</ul>
			</div>
		</div>
	</nav>

	<div class="container mt-5">
		<div class="row">
			<div class="col-md-6 resumen-carrito">
				<?php
				// Comprueba si el método de solicitud es POST.
				if ($_SERVER["REQUEST_METHOD"] == "POST") {
					// Decodifica el JSON del carrito enviado por POST.
					$carrito = json_decode($_POST['carrito'], true);

					// Comprueba si el carrito no está vacío.
					if (!empty($carrito)) {
						// Muestra el título "Resumen de Compra".
						echo "<h2 style='color: #113f0c'><b>Resumen de Compra</b></h2><br>";
						// Inicia una lista desordenada para los elementos del carrito.
						echo "<ul class='list-group mb-4 shadow-sm'>";

						// Inicializa la variable total.
						$total = 0;
						// Itera a través de cada elemento del carrito.
						foreach ($carrito as $item) {
							// Muestra cada elemento del carrito en una lista.
							echo "<li class='list-group-item d-flex justify-content-between align-items-center'>";
							echo "<div>";
							// Muestra el ID del producto de forma oculta.
							echo "<span class='oculto'><strong>ID:</strong> " . htmlspecialchars($item['id']) . "</span>";
							// Muestra el nombre del producto.
							echo "<strong>Producto:</strong> " . htmlspecialchars($item['titulo']) . "<br>";
							// Muestra el precio del producto.
							echo "<strong>Precio:</strong> $" . number_format($item['precio'], 2, ',', '.') . "<br>";
							// Muestra la cantidad del producto.
							echo "<strong>Cantidad:</strong> " . htmlspecialchars($item['cantidad']) . "<br>";
							// Calcula el subtotal del producto.
							$subtotal = $item['precio'] * $item['cantidad'];
							// Muestra el subtotal del producto.
							echo "<strong>Subtotal:</strong> $" . number_format($subtotal, 2, ',', '.') . "<br>";
							echo "</div>";
							echo "</li>";

							// Suma el subtotal al total general.
							$total += $subtotal;
						}
						// Cierra la lista desordenada.
						echo "</ul>";
						// Muestra el total general de la compra.
						echo "<h4 style='color: #113f0c'><b>Total: $" . number_format($total, 2, ',', '.') . "</b></h4>";
					} else {
						// Muestra un mensaje si el carrito está vacío.
						echo "<p class='alert alert-warning text-center'>El carrito está vacío.</p>";
					}
				} else {
					// Muestra un mensaje si la solicitud no es válida.
					echo "<p class='alert alert-danger text-center'>Solicitud inválida.</p>";
				}
				?>

			</div>
			<div class="col-md-6 formulario-pago">
				<h2 style="color: #113f0c"><b>Tipo de Pago</b></h2>
				<div class="form-check">
					<input class="form-check-input" type="radio" name="tipo_pago" id="pago_domicilio" value="domicilio"
						checked onclick="mostrarFormulario('domicilio')">
					<label class="form-check-label" for="pago_domicilio"><b>Contraentrega / Domicilio</b></label>
				</div>
				<br>
				<div id="formulario_pago_domicilio" class="formulario">
					<h4 style="color: #113f0c"><b>Datos de Envío</b></h4>
					<form class="shadow-sm p-4 rounded bg-light" method="POST" action="procesar_compra.php">
						<input type="hidden" name="carrito" value='<?php echo json_encode($carrito); ?>'>
						<div class="form-group">
							<label for="nombre" class="font-weight-bold">Nombre Completo</label>
							<input type="text" class="form-control" id="nombre" name="nombre"
								placeholder="Nombre Completo" required>
						</div>
						<div class="form-group">
							<label for="direccion" class="font-weight-bold">Dirección de Envío</label>
							<input type="text" class="form-control" id="direccion" name="direccion"
								placeholder="Dirección completa" required>
						</div>
						<div class="form-group">
							<label for="ciudad" class="font-weight-bold">Ciudad</label>
							<input type="text" class="form-control" id="ciudad" name="ciudad" placeholder="Ciudad"
								required>
						</div>
						<div class="form-group">
							<label for="telefono" class="font-weight-bold">Teléfono de Contacto</label>
							<input type="text" class="form-control" id="telefono" name="telefono"
								placeholder="Número de teléfono" required>
						</div>
						<button type="submit" class="btn btn-success btn-block mt-3 font-weight-bold" style="
			background-color: #164310;
			color: white;
			font-weight: bold;
			border-radius: 30px;
			border: none;
			cursor: pointer;
			width: 90%;
			transition: background-color 0.3s, transform 0.3s;"
							onmouseover="this.style.backgroundColor='black'; this.style.transform='scale(1.05)'; this.style.boxShadow='0 4px 10px rgba(0, 0, 0, 0.2)';"
							onmouseout="this.style.backgroundColor='#164310'; this.style.transform='scale(1)'; this.style.boxShadow='none';">
							Confirmar Compra
						</button>
					</form>
				</div>

			</div>
		</div>
	</div>

	<footer class="footer-section">
		<div class="container relative">

			<div class="row g-5 mb-5">
				<div class="col-lg-4">
					<div class="mb-4 footer-logo-wrap" style="font-size: 45px;color: white"><span>PANEVI</span></div>

					<p class="mb-4"></p>

					<ul class="list-unstyled custom-social">
						<li><a href="https://www.facebook.com/profile.php?id=61552234777986&locale=es_LA"><span
									class="fa fa-brands fa-facebook-f"></span></a></li>
						<li><a href="https://www.instagram.com/innovatech_4/"><span
									class="fa fa-brands fa-instagram"></span></a></li>
						<li><a href="https://wa.me/573102307944"><span class="fa fa-brands fa-whatsapp"></span></a></li>
					</ul>
				</div>

				<div class="col-lg-8">
					<div class="row links-wrap">
						<div style="margin-left: 15%;" class="col-6 col-sm-6 col-md-3">
							<ul class="list-unstyled">
								<li style="color: white; text-transform: uppercase;font-size: 20px">Información</li>
								<li><a href="#" style="color: grey">Acerca de Nosotros</a></li>
								<li><a href="#" style="color: grey">Politicas de Privacidad</a></li>
								<li><a href="#" style="color: grey">Términos y Condiciones</a></li>
							</ul>
						</div>

						<div class="col-6 col-sm-6 col-md-3">
							<ul class="list-unstyled">
								<li style="color: white; text-transform: uppercase;font-size: 20px">MI CUENTA</li>
								<li><a href="#" style="color: grey">Mi Cuenta</a></li>
								<li><a href="#" style="color: grey">Mi información</a></li>
							</ul>
						</div>

						<div class="col-6 col-sm-6 col-md-3">
							<ul class="list-unstyled">
								<li style="color: white; text-transform: uppercase;font-size: 20px">CONTACTO</li>
								<li>Teléfono: 3102307944</li>
								<li>Ciudad: Villeta</li>
								<li>Código postal: 253410</li>
							</ul>
						</div>

						<div class="col-6 col-sm-6 col-md-3">
							<ul class="list-unstyled">
								<li><a href="#"></a></li>
								<li><a href="#"></a></li>
							</ul>
						</div>
					</div>
				</div>

			</div>

			<div class="border-top copyright">
				<div class="row pt-4">
					<div class="col-lg-6">
						<p class="mb-2 text-center text-lg-start">Derechos de Autor &copy;
							<script>document.write(new Date().getFullYear());</script>. Todos los derechos
							reservados.<br>
							Correo: innovatech004@gmail.com</a>
							<!-- License information: https://untree.co/license/ -->
						</p>
					</div>


					<div class="col-lg-6 text-center text-lg-end">
						<ul class="list-unstyled d-inline-flex ms-auto">
							<li class="me-4" style="color: white; font-size: 18px">Panevi - Endulza tu vida</li>
						</ul>
					</div>

				</div>
			</div>

		</div>
	</footer>
	<!-- JavaScript Libraries -->
	<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
	<script src="lib/wow/wow.min.js"></script>
	<script src="lib/easing/easing.min.js"></script>
	<script src="lib/waypoints/waypoints.min.js"></script>
	<script src="lib/counterup/counterup.min.js"></script>
	<script src="lib/owlcarousel/owl.carousel.min.js"></script>
	<script src="lib/tempusdominus/js/moment.min.js"></script>
	<script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
	<script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

	<!-- Template Javascript -->
	<script src="js/main1.js"></script>
</body>

</html>