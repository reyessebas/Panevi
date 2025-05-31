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
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
	<link href="css/tiny-slider.css" rel="stylesheet">
	<script src="js/app11.js" async></script>
	<link href="css/style.css" rel="stylesheet">
	<title>Productos</title>
</head>
<body>
<nav class="custom-navbar navbar navbar navbar-expand-md navbar-dark bg-dark" arial-label="Furni navigation bar">
		<div class="container-logo"> 

			<div class="header-images"> 
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
						<input type="text" id="bus" placeholder="Buscar">
						<div class="buttonb">
							<i class="fa fa-search"></i>
						</div>
					</div>
						<li>
							<a class="nav-link" href="index.php">Inicio</a>
						</li>
						<li><a class="nav-link" href="login.php">Ingresar</a></li>
						<li><a class="nav-link" href="registro.php">Registrarse</a></li>
						<li class="nav-item active"><a class="nav-link" href="productos.php">Productos</a></li>


				</ul>


			</div>
		</div>

	</nav>
	<body>
		<br>
		<h3 style="text-align: center;color: #1a3e14; font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif"><b>Descubre nuestra selección de productos de alta calidad</b></h3>
		<section class="contenedor">
			<div class="contenedor-items">
			<?php
// Incluye el archivo de configuración que contiene los datos de conexión a la base de datos.
include("../app/config/config.php");

// Define la consulta SQL para seleccionar todos los campos de la tabla productos.
$tab_sql = "SELECT id_producto, nombre, precio, imagen FROM productos";
// Ejecuta la consulta SQL y almacena el resultado en la variable $result.
$result = $conexion->query($tab_sql);

// Comprueba si la consulta ha devuelto alguna fila.
if ($result->num_rows > 0) {
    // Itera a través de las filas devueltas por la consulta.
    while ($row = $result->fetch_assoc()) {
        // Genera un div con la clase 'item' para cada producto.
        echo "<div class='item'>";
        // Muestra el id del producto en un span oculto.
        echo "<span class='id-item' style='color: black; font-size: 16px; display:none'>" . $row["id_producto"] . "</span>";
        // Muestra el nombre del producto en un span.
        echo "<span class='titulo-item' style='color: black; font-size: 16.8px;'>" . $row["nombre"] . "</span>";
        // Muestra el precio del producto en un span.
        echo "<span class='precio-item' style='color: black; font-size: 16px'>$" . $row["precio"] . "</span>";
        // Muestra la imagen del producto en un img con la clase 'img-item'.
        echo "<img src='" . $row["imagen"] . "' alt='" . $row["nombre"] . "' class='img-item'>";
        // Genera un botón para agregar el producto al carrito con un evento onclick.
        echo "<button class='boton-item' onclick='agregarAlCarritoClicked(this, " . $row["id_producto"] . ")'><i class='fas fa-shopping-cart'></i>   Comprar</button>";
        echo "</div>";
    }
}
?>

    </div>

<div class="carrito" id="carrito">
    <div class="header-carrito">
        <h2>Tu Carrito</h2>
    </div>
    <div class="carrito-items" style="color: black"></div>
<div class="carrito-total" style="color: black">
    <div class="fila">
        <strong>Tu Total</strong>
        <span class="carrito-precio-total">$0.00</span>
    </div>
    <button class="btn-pagar">Pagar <i class="fa-solid fa-bag-shopping"></i></button>
</div>

<div id="alerta-compra" class="alerta oculto">
    <span class="mensaje-alerta">¡Ups! Necesitas registrarte o iniciar sesión para poder comprar.</span>
    <button class="btn-cerrar-alerta">&times;</button>
</div>
</div>
</section>
	</body>
<br>
<footer class="footer-section">
		<div class="container relative">

			<div class="row g-5 mb-5">
				<div class="col-lg-4">
					<div class="mb-4 footer-logo-wrap" style="font-size: 45px;color: white"><span>PANEVI</span></div>
			
					<p class="mb-4"></p>

					<ul class="list-unstyled custom-social">
						<li><a href="https://www.facebook.com/profile.php?id=61552234777986&locale=es_LA"><span class="fa fa-brands fa-facebook-f"></span></a></li>
						<li><a href="https://www.instagram.com/innovatech_4/"><span class="fa fa-brands fa-instagram"></span></a></li>
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
	<!-- End Footer Section -->


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
	
</body>

</html>