<?php
$pagina = 'registrarServicio';
require_once('../includes/config.php');
require_once('../includes/header.php');
?>

<main class="registrar-servicio">

    <seccion class="formulario py-5">
        <div class="container">
            <div class="row">

                <div class="col-md-5">
                    <h1>Súmate a la app de delivery online más grande de América Latina</h1>
                    <p>Aplica únicamente para socios comerciales que completen el proceso de registro exitosamente</p>
                    <p>Aplica únicamente para socios comerciales que completen el proceso de registro exitosamente</p>
                </div>

                <div class="offset-md-1 col-md-6">

                <form action="registrar-servicio.php" method="POST">
                    <div class="mb-3">
                        <label for="nombreProveedor">Nombre Completo</label>
                        <input type="text" class="form-control" id="nombreProveedor" name="nombreProveedor" required>
                    </div>
                    <div class="mb-3">
                        <label for="correoProveedor">Correo electronico</label>
                        <input type="email" class="form-control" id="correoProveedor" name="correoProveedor" required>
                    </div>
                    <div class="mb-3">
                        <label for="telefonoProveedor">Teléfono</label>
                        <input type="text" class="form-control" id="telefonoProveedor" name="telefonoProveedor" required>
                    </div>
                    <div class="mb-3">
                    <label for="edadProveedor">Edad</label>
                        <input type="number" class="form-control" id="edadProveedor" name="nombreProveedor" required>
                    </div>
                    <div class="mb-3">
                        <label for="servicioProveedor">Tipo de servicio:</label>
                        <select name="tipoServicio" id="servicioProveedor" class="form-select">
                            <option value="1">Flete</option>
                            <option value="2">Remis</option>
                            <option value="3">Mandado</option>
                        </select>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Procesar información</button>

                </form>

                </div>
            </div>
        </div>
    </seccion>

</main>

<?php
  require_once('../includes/footer.php');
?>