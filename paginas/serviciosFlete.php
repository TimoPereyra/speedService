<?php
$pagina = 'servicios-flete';
require_once('../includes/config.php');

require_once('../includes/conexion.php');
$stmt = $conexion->prepare("SELECT nombreServicio, imgUsuario,urlFoto,idServicio FROM servicios INNER JOIN usuarios ON usuarios.idUsuario = servicios.idUsuario INNER JOIN vehiculos ON vehiculos.idVehiculo = servicios.idVehiculo INNER JOIN fotos_vehiculo ON fotos_vehiculo.idVehiculo = vehiculos.idVehiculo WHERE idCategoria = 1;");
$stmt->execute();
$servicios = $stmt->fetchAll();

require_once('../includes/header.php');

?>

<main class="pagina-servicios py-5">
    <section class="servicios">
        <div class="container">
            <div class="row">
                <!-- COLUMNA SERVICIOS -->
                <div class="col-12 col-md-12 columna-servicios">
                    <h3>Fletes</h3>
                    <div class="row fila-servicios">

                        <?php
                            foreach($servicios as $fila){
                            
                                echo '
                                <div class="col-md-4 mb-3">
                                    <div class="card">
                                    <img src="../img/vehiculos/'.$fila['urlFoto'].'" class="card-img-top img-fluid imagen-servicios-vehiculo" alt="imgVehiculo">
                                        <div class="text-center">
                                            <img src="../img/usuarios/'.$fila['imgUsuario'].'" class="card-img-top img-fluid imagen-servicios-usuario" alt="imgUsuario">
                                        </div>
                                        <div class="card-body tarjeta-servicio">
                                            <h5 class="card-title">'.ucfirst($fila['nombreServicio']).'</h5>
                                            <div class="d-grid gap-2 d-md-block text-center">
                                                <a href="#" class="ov-btn-slide-left">Solicitar servicio</a>    
                                                <a href="detalleServicio.php?idServicio='.$fila['idServicio'].'" class="btn boton-servicios2">Detalle</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                ';
                            }
                        
                        ?>

                    </div>
                </div>
            </div>
        </div>
    </section>            
</main>

<?php
  require_once('../includes/footer.php');
?>