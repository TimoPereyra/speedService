<?php
session_start();

if(!isset($_SESSION['idUsuario']) || $_SESSION['idRol'] != 3){
    header('Location:../index.php');
}

$pagina = 'listado-servicios';
require_once('../../includes/config.php');
require_once('../../includes/conexion.php');

if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])){
    $idServicio = $_GET['id'];
    $stmt = $conexion->prepare("SELECT idServicio, nombreServicio, descripcionServicio, categoria, fechaAltaServicio, alcance, estadoServicio, patente, img_seguro, img_vtv, capacidad, tipo, nombreCompleto, telefono, correo FROM servicios INNER JOIN categorias ON categorias.idCategoria = servicios.idCategoria INNER JOIN estado_servicio ON estado_servicio.idEstadoServicio = servicios.idEstadoServicio INNER JOIN vehiculos ON vehiculos.idVehiculo = servicios.idVehiculo INNER JOIN usuarios ON usuarios.idUsuario = servicios.idUsuario INNER JOIN tipo_vehiculo ON tipo_vehiculo.idTipo = vehiculos.idTipo WHERE idServicio = :idServicio");
    $stmt->execute(array(':idServicio' => $idServicio));
    $datosServicio = $stmt->fetch();
}



require_once('../../includes/header.php');
?>

<section class="alta-categorias">
    <div class="container">
        <h1 class="text-center py-5">Detalle del Servicio</h1>

        <form action="detalle.php" method="POST" class="bg-white p-4 form-detalle">
        <div class="row">

            <div class="col-12 col-md-6">
                <h4 class="mb-4 py-2 bg-secondary text-white">Datos del Proveedor</h4>
                <div class="mb-2">
                    <label for="" class="text-dark"><b>Nombre</b>:</label> <input type="text" value="<?php echo $datosServicio['nombreCompleto']; ?>">
                </div>
                <div class="mb-2">
                    <label for="" class="text-dark"><b>Correo</b>:</label> <input type="text" value="<?php echo $datosServicio['correo']; ?>">
                </div>
                <div class="mb-2">
                    <label for="" class="text-dark"><b>Teléfono</b>:</label> <input type="text" value="<?php echo $datosServicio['telefono']; ?>">
                </div>
            </div>

            <div class="col-12 col-md-6">
                <h4 class="mb-4 py-2 bg-secondary text-white">Datos del Servicio</h4>
                <div class="mb-2">
                    <label for="" class="text-dark me-2"><b>Fecha de solicitud</b>:</label> <input type="text" value="<?php 
                    $fechaSolicitudServicio = $datosServicio['fechaAltaServicio'];
                    $fechaSolicitudNueva = date("d-m-Y", strtotime($fechaSolicitudServicio));
                    echo $fechaSolicitudNueva; ?>">
                </div>
                <div class="mb-2">
                    <label for="" class="text-dark"><b>Nombre</b>:</label> <input type="text" value="<?php echo $datosServicio['nombreServicio']; ?>">
                </div>
                <div class="mb-2">
                    <label for="" class="text-dark"><b>Categoría</b>:</label> <input type="text" value="<?php echo $datosServicio['categoria']; ?>">
                </div>
                <div class="mb-2">
                    <label for="" class="text-dark"><b>Alcance</b>:</label> <input type="text" value="<?php echo $datosServicio['alcance']; ?>">
                </div>
                <div class="mb-2">
                    <label for="" class="text-dark"><b>Descripción</b>:</label> <textarea value="<?php echo $datosServicio['descripcionServicio']; ?>" class="form-control"><?php echo $datosServicio['descripcionServicio']; ?></textarea>
                </div>
            </div>

            <div class="col-12 col-md-6">
                <h4 class="mt-4 mb-4 py-2 bg-secondary text-white">Datos del Vehículo</h4>
                <div class="mb-2">
                    <label for="" class="text-dark"><b>Patente</b>:</label> <input type="text" value="<?php echo $datosServicio['patente']; ?>">
                </div>
                <div class="mb-2">
                    <label for="" class="text-dark"><b>Tipo</b>:</label> <input type="text" value="<?php echo $datosServicio['tipo']; ?>">
                </div>
                <div class="mb-2">
                    <label for="" class="text-dark"><b>Seguro</b>:</label> <input type="text" value="<?php echo $datosServicio['img_seguro']; ?>"> 
                </div>
                <div class="mb-2">
                    <label for="" class="text-dark"><b>VTV</b>:</label> <input type="text" value="<?php echo $datosServicio['img_vtv']; ?>">
                </div>
                <div class="mb-2">
                    <label for="" class="text-dark"><b>Capacidad</b>:</label> <textarea value="<?php echo $datosServicio['capacidad']; ?>" class="form-control"><?php echo $datosServicio['capacidad']; ?></textarea>
                </div>
            </div>

            <div class="col-12 col-md-6">
                <h4 class="mt-4 mb-4 py-2 bg-secondary text-white">Estado del Servicio</h4>
                <div class="mb-2">
                    <label for="" class="text-dark"><b>Estado</b>:</label> 
                    
                    <?php 
                    if ($datosServicio['estadoServicio'] == 'Aprobado'){ 
                        echo '<p class="align-middle text-success">'.$datosServicio['estadoServicio'].'</p>';
                    }else if ($datosServicio['estadoServicio'] == 'Rechazado'){ 
                        echo '<p class="align-middle text-danger">'.$datosServicio['estadoServicio'].'</p>';
                    }else{ 
                        echo '<p class="align-middle text-warning">'.$datosServicio['estadoServicio'].'</p>';
                    }            
                    
                    ?>

                </div>
            </div>
        </form>   
    </div>
</section>


<?php
  require_once('../../includes/footer.php');
?>