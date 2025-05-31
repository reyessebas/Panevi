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
	<title>Gracias</title>
</head>

<body>

	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
	<nav class="custom-navbar navbar navbar navbar-expand-md navbar-dark bg-dark" arial-label="Furni navigation bar">
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
	<br>
	<br>
	<div
		style="text-align: center; background: linear-gradient(to right, #f9f9f9, #f1f1f1); padding: 50px; border-radius: 10px; box-shadow: 0 0 20px rgba(0, 0, 0, 0.1); position: relative; overflow: hidden;">
		<h1 style="font-size: 5em; font-weight: bold; color: #275d1e; margin-bottom: 20px;">¡Gracias por tu Compra!</h1>
		<p style="font-size: 1.5em; color: #333333; margin-bottom: 20px;">Tu apoyo nos permite seguir ofreciendo
			productos de calidad. Esperamos que disfrutes de tus compras y te invitamos a seguir explorando nuestras
			ofertas y productos únicos.</p>
		<p style="font-size: 1.2em; color: #555555;">Si necesitas más información o tienes alguna pregunta, no dudes en
			contactarnos.</p>
		<?php
		if (isset($_GET['id_pedido'])) {
			$id_pedido = intval($_GET['id_pedido']);
		} else {
			echo "No se ha encontrado el ID del pedido.";
			exit();
		}
		?>

		<a href="generar_factura.php?id_pedido=<?php echo $id_pedido; ?>"
			style="display: inline-block; font-weight: bold; margin-top: 20px; padding: 10px 20px; font-size: 1.2em; color: white; background-color: #275d1e; text-decoration: none; border-radius: 5px; transition: background-color 0.3s ease, transform 0.3s ease;"
			onmouseover="this.style.backgroundColor='#000'; this.style.transform='scale(1.05)';"
			onmouseout="this.style.backgroundColor='#275d1e'; this.style.transform='scale(1)';">
			<i class="fas fa-file-download" style="margin-right: 5px;"></i> ¡Descarga tu factura aquí!
		</a>

		<a href="productos_cli.php"
			style="display: inline-block; font-weight: bold; margin-top: 20px; margin-left: 20px; padding: 10px 20px; font-size: 1.2em; color: white; background-color: #275d1e; text-decoration: none; border-radius: 5px; transition: background-color 0.3s ease, transform 0.3s ease;"
			onmouseover="this.style.backgroundColor='#000'; this.style.transform='scale(1.05)';"
			onmouseout="this.style.backgroundColor='#275d1e'; this.style.transform='scale(1)';">
			<i class="fas fa-shopping-cart" style="margin-right: 5px;"></i> ¡Explora más delicias!
		</a>

		<p style="font-size: 1.2em; color: #555555; margin-top: 30px;">¡Nos encantaría verte de nuevo pronto!</p>

		<i class="fas fa-star"
			style="position: absolute; top: 10px; left: 20px; font-size: 5em; color: rgba(255, 215, 0, 0.2);"></i>
		<i class="fas fa-heart"
			style="position: absolute; top: 50px; right: 30px; font-size: 4em; color: rgba(255, 0, 0, 0.2);"></i>
		<i class="fas fa-gift"
			style="position: absolute; bottom: 40px; left: 40px; font-size: 6em; color: rgba(0, 128, 0, 0.2);"></i>
		<i class="fas fa-shopping-bag"
			style="position: absolute; bottom: 10px; right: 10px; font-size: 5em; color: rgba(0, 0, 255, 0.2);"></i>
		<i class="fas fa-thumbs-up"
			style="position: absolute; top: 70px; left: 60px; font-size: 5em; color: rgba(0, 255, 0, 0.2);"></i>
		<i class="fas fa-smile"
			style="position: absolute; bottom: 70px; right: 60px; font-size: 4em; color: rgba(255, 165, 0, 0.2);"></i>
		<i class="fas fa-check-circle"
			style="position: absolute; top: 210px; left: 160px; font-size: 6em; color: rgba(0, 0, 128, 0.2);"></i>
		<i class="fas fa-hand-holding-heart"
			style="position: absolute; bottom: 150px; right: 200px; font-size: 6em; color: rgba(255, 20, 147, 0.2);"></i>
	</div>

	<br><br>
</body>
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
						<script>document.write(new Date().getFullYear());</script>. Todos los derechos reservados.<br>
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

<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/tiny-slider.js"></script>
<script src="js/custom.js"></script>
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

</html>