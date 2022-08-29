<?php
$pagina = 'inicio';
require_once('includes/config.php');
require_once('includes/header.php');
?>

  <section class="seccion-bienvenida">
    <div class="contenedor">
      <h1>SpeedService</h1>
      <p><i>El sitio que te permite generar ganancias al volante y pedir un servicio ahora.</i></p>
      <a href="#">Nuestros Servicios</a>
    </div>
  </section>

  <section class="seccion-servicios py-4">
    <div class="container">
      <h2 class="text-center mb-4">Nuestros Servicios</h2>
      
      <div class="row">

        <div class="col-md-4 mb-3">
          <div class="card">
            <img src="img/servicio_remis.jpg" class="card-img-top imagen-servicios" alt="remis">
            <div class="card-body">
              <h5 class="card-title">REMIS</h5>
              <p class="card-text"><i>Si querés moverte, nosotros te llevamos.</i></p>
              <a href="#" class="btn d-grid gap-2 col-10 mx-auto boton-servicio">Ir</a>
            </div>
          </div>
        </div>

        <div class="col-md-4 mb-3">
          <div class="card">
            <img src="img/servicio_flete.jpg" class="card-img-top imagen-servicios" alt="flete">
            <div class="card-body">
              <h5 class="card-title">FLETE</h5>
              <p class="card-text"><i>Dejá tu carga en buenas manos.</i></p>
              <a href="#" class="btn d-grid gap-2 col-10 mx-auto boton-servicio">Ir</a>
            </div>
          </div>
        </div>

        <div class="col-md-4 mb-3">
          <div class="card">
            <img src="img/servicio_mandado.jpg" class="card-img-top imagen-servicios" alt="mandado">
            <div class="card-body">
              <h5 class="card-title">MANDADO</h5>
              <p class="card-text"><i>Ahorrá tiempo, nuestro destino es tu confianza.</i></p>
              <a href="#" class="btn d-grid gap-2 col-10 mx-auto boton-servicio">Ir</a>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>

  <section class="info-servicios py-4 mt-3">
    <div class="container">

      <div class="row">

        <div class="col-md-4 text-center info-servicio">
          <div class="icono">
            <i class="fa-solid fa-id-card"></i>
          </div>
          <h5 class="encabezado-info">Seguridad</h5>
          <p class="descripcion-info">Nuestros choferes están registrados en bases de datos y cuentan con toda la documentación respaldatoria para circular.</p>
        </div>

        <div class="col-md-4 text-center info-servicio">
          <div class="icono">
            <i class="fa-solid fa-clock-rotate-left"></i>
          </div>
          
          <h5 class="encabezado-info">24hs</h5>
          <p class="descripcion-info">Solicita un servicio en cualquier momento del día y cualquier día del año.</p>
        </div>

        <div class="col-md-4 text-center info-servicio">
          <div class="icono">
            <i class="fa fa-money"></i>
          </div>
          
          <h5 class="encabezado-info">Transparencia</h5>
          <p class="descripcion-info">Observa el detalle de tu pedido. Compara viajes. <br>No te dejes engañar.</p>
        </div>

      </div>
    </div>
  </section>

<?php
  require_once('includes/footer.php');
?>