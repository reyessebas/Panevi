<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Artículos de Panela</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .card {
      border: none;
      border-radius: 15px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .card:hover {
      transform: translateY(-10px);
      box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    }
    .card img {
      border-radius: 15px 15px 0 0;
      max-height: 250px;
      object-fit: cover;
    }
    .card-title {
      color: #1b5e20; /* Verde oscuro */
      font-size: 1.5rem;
      font-weight: bold;
    }
    .card-text {
      font-size: 1.1rem;
      line-height: 1.5;
    }
    .btn-custom {
      background-color: #1b5e20; /* Verde oscuro */
      color: #fff;
      border-radius: 30px;
      padding: 10px 20px;
      transition: background-color 0.3s ease;
      margin-right: 10px; /* Espacio entre botones */
    }
    .btn-custom:hover {
      background-color: #155d1a; /* Verde más oscuro */
    }
    .container {
      margin-top: 30px;
    }
    .section-title {
      text-align: center;
      font-size: 2.5rem;
      color: #343a40;
      margin-bottom: 50px;
    }
    /* Opcional: Alinear los botones en dispositivos pequeños */
    @media (max-width: 576px) {
      .btn-custom {
        width: 100%;
        margin-bottom: 10px;
      }
    }
  </style>
</head>
<body>

  <div class="container">
    <h1 class="section-title">Conoce la Panela y Nuestros Productos</h1>
    <div class="row">
      <!-- Artículo 1 -->
      <div class="col-md-4">
        <div class="card">
          <img src="img/panelas_unidad.jpg" alt="Panela tradicional" class="card-img-top">
          <div class="card-body">
            <h5 class="card-title">Panela Tradicional</h5>
            <p class="card-text">La panela es un endulzante natural que proviene de la caña de azúcar, sin procesos químicos. Es ideal para endulzar bebidas y postres de manera saludable.</p>
            <a href="#" class="btn btn-custom">Leer más</a>
            <a href="#" class="btn btn-custom">Comprar</a>
          </div>
        </div>
      </div>
      <!-- Artículo 2 -->
      <div class="col-md-4">
        <div class="card">
          <img src="img/vari.jpg" alt="Panela en polvo" class="card-img-top">
          <div class="card-body">
            <h5 class="card-title">Panela en Polvo</h5>
            <p class="card-text">La presentación en polvo de la panela es ideal para disolver rápidamente en líquidos, perfecta para preparar bebidas calientes o batidos naturales.</p>
            <a href="#" class="btn btn-custom">Leer más</a>
            <a href="#" class="btn btn-custom">Comprar</a>
          </div>
        </div>
      </div>
      <!-- Artículo 3 (Actualizado: Miel de Panela) -->
      <div class="col-md-4">
        <div class="card">
          <img src="img/miell.jpg" alt="Miel de Panela" class="card-img-top">
          <div class="card-body">
            <h5 class="card-title">Miel de Panela</h5>
            <p class="card-text">Nuestra Miel de Panela combina la dulzura natural de la panela con las propiedades nutritivas de la miel, ofreciendo un producto único y saludable.</p>
            <a href="#" class="btn btn-custom">Leer más</a>
            <a href="#" class="btn btn-custom"><i class="fas fa-shopping-cart"></i></a>
            </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS (opcional) -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
