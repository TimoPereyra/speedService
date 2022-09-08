<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- FONTAWESOME -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo RUTARAIZ; ?>/css/style.css">
    <link rel="shortcut icon" href="<?php echo RUTARAIZ; ?>/img/logo5.jpg" type="image/x-icon">
    
    <title>SpeedService</title>
</head>
<body>
    
    <!-- ENCABEZADO -->
    <header>

        <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">

            <div class="container">
              <img class="img-logo" src="<?php echo RUTARAIZ; ?>/img/logo5.jpg" alt="">
              <a class="navbar-brand" href="<?php echo RUTARAIZ; ?>">SpeedService</a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">

                  <li class="nav-item">
                    <a class="nav-link <?php echo ($pagina == 'inicio') ? 'active' : ''; ?>" aria-current="page" href="<?php echo RUTARAIZ; ?>">Inicio</a>
                  </li>

                  <li class="nav-item">
                    <a class="nav-link <?php echo ($pagina == 'servicios') ? 'active' : ''; ?>" href="<?php echo RUTARAIZ; ?>/paginas/servicios.php">Servicios</a>
                  </li>

                  <li class="nav-item">
                    <a class="nav-link" href="#">Nosotros</a>
                  </li>
                  
                  <li class="nav-item">
                    <a class="nav-link" href="#">Contacto</a>
                  </li>

                  <?php if(!isset($_SESSION['idUsuario'])) : ?>
                    <li class="nav-item">
                      <a class="nav-link" href="<?php echo RUTARAIZ; ?>/paginas/ingresar.php">Ingresar</a>
                    </li>
                  <?php else: ?>
                    <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="<?php echo RUTARAIZ.'/img/usuarios/'.$_SESSION['imgUsuario'] ?>" alt="avatar" class="img-avatar">
                      </a>
                      <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#">Action</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="<?php echo RUTARAIZ; ?>/procesos/cerrar-sesion.php">Cerrar Sesión</a></li>
                      </ul>
                    </li>

                    
                  <?php endif; ?>
                  <!-- 
                  <li class="nav-item">
                    <a class="nav-link cta" href="">Registrá tu servicio</a>
                  </li>
-->
                </ul>
              </div>
            </div>

          </nav>

    </header>
