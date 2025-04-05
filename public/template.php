<!DOCTYPE html>
<html lang="es-ES">
<head>
    <!-- META -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- TITLE -->
    <title><?=$tituloHead?></title>

    <!-- CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/styles.css">

    <!-- JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <!-- global container -->
    <div class="global-container">
        <!-- header -->
        <div class="container">
          <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
            <div class="col-md-3 mb-2 mb-md-0">
              <a href="/" class="d-inline-flex link-body-emphasis text-decoration-none">
                LOGO
              </a>
            </div>

            <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
              <!-- <li><a href="#" class="nav-link px-2 link-secondary">Home</a></li> -->
              <div class="btn-group align-items-center justify-content-center">
                <a type="button" class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                  Prácticas
                </a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="./productos.php">Productos</a></li>
                  <li><a class="dropdown-item" href="./adivinarNumero.php">Adivinar número</a></li>
                  <li><a class="dropdown-item" href="./NumeroParImpar.php">Num par/impar</a></li>
                  <li><a class="dropdown-item" href="./NumeroPrimoNoprimo.php">Número primo</a></li>
                  <li><a class="dropdown-item" href="./validacionesForm.php">Validaciones form</a></li>
                  <li><a class="dropdown-item" href="./piramide.php">Pirámide</a></li>
                </ul>
              </div>

              <li><a href="#" class="nav-link px-2">Link</a></li>
            </ul>

            <div class="col-md-3 text-end">
              <a href="./login.php" class="btn btn-outline-primary me-2">Login</a>
              <a href="./register.php" class="btn btn-primary">Registro</a>
            </div>
          </header>
        </div>

        <!-- body (central container) -->
        <main class="container">
          <!-- contenido para el template -->
          <?=$content?>
        </main>

        <!-- footer -->
        <div class="container">
          <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
            <p class="col-md-4 mb-0 text-body-secondary">&copy; 2024 Company, Inc</p>

            <a href="/" class="col-md-4 d-flex align-items-center justify-content-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
              LOGO
            </a>

            <ul class="nav col-md-4 justify-content-end">
              <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">Home</a></li>
              <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">Features</a></li>
              <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">Pricing</a></li>
              <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">FAQs</a></li>
              <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">About</a></li>
            </ul>
          </footer>
        </div>
    </div>
</body>
</html>