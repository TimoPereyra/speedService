<?php
$pagina = 'listado-servicios';
require_once('../includes/config.php');
require_once('../includes/conexion.php');

if($_SERVER['REQUEST_METHOD'] == 'GET' && !isset($_GET['idServicio'])){
    header('Location:../index.php');
}
if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['idServicio'])){
    $idServicio = $_GET['idServicio'];
    $stmt = $conexion->prepare("SELECT idServicio, nombreServicio, descripcionServicio, categoria, fechaAltaServicio, alcance, imgUsuario, patente, capacidad, tipo, nombreCompleto, servicios.idVehiculo, categorias.idCategoria FROM servicios INNER JOIN categorias ON categorias.idCategoria = servicios.idCategoria INNER JOIN vehiculos ON vehiculos.idVehiculo = servicios.idVehiculo INNER JOIN usuarios ON usuarios.idUsuario = servicios.idUsuario INNER JOIN tipo_vehiculo ON tipo_vehiculo.idTipo = vehiculos.idTipo WHERE idServicio = :idServicio");
    $stmt->execute(array(':idServicio' => $idServicio));
    $datosServicio = $stmt->fetch();

    $nombreServicio = $datosServicio['nombreServicio'];
    $categoria = $datosServicio['idCategoria']; 
    $descripcionServicio = $datosServicio['descripcionServicio'];
    $tipoVehiculoServicio = $datosServicio['tipo'];


    /* ACCEDER A LAS IMÁGENES DEL VEHÍCULO */
    $stmt = $conexion->prepare('SELECT * FROM fotos_vehiculo WHERE idVehiculo = :idVehiculo');
    $stmt->execute(array(':idVehiculo' => $datosServicio['idVehiculo']));
    $fotosVehiculo = $stmt->fetchAll();
}


require_once('../includes/header.php');
?>

<section class="detalles-servicio py-5">
    <div class="container">

        <h1 class="text-center py-5">Detalle del Servicio</h1>
        <form action="detalleServicio.php" method="POST" class="bg-white p-4 form-detalle">
        <div class="row">
            
            <div class="col-6 col-md-12">
                <h4 class="mb-2 text-black"><i class="fa-solid fa-user icono-modificar"></i> Conductor </h4>
                <div class="mb-6 text-center">
                    <img src="../img/usuarios/<?php echo $datosServicio['imgUsuario'];?>" class="card-img-top img-fluid imagen-servicios-usuario mb-3" alt="imgUsuario"> 
                    <h5 class="text-dark text-center"><?php echo $datosServicio['nombreCompleto']; ?></h5>                             
                </div>
            
                <hr class="border border-danger border-2 opacity-40">
            </div>

            
            
            <div class="col-12 col-md-12">
                <h4 class="mt-2 mb-4 py-2 text-dark"><i class="fa-solid fa-car icono-modificar"></i> Vehículo </h4>
                    <div class="mb-4 mt-1">
                        <?php 
                            foreach ($fotosVehiculo as $foto) {
                                echo '
                                    <a href="../img/vehiculos/'.$foto['urlFoto'].'" data-lightbox="img-vehiculo"><img class="img-fluid img-detalle-servicio" src="../img/vehiculos/'.$foto['urlFoto'].'" alt=""></a> 
                                ';
                            }
                        ?>
                    </div>

                    <div class="mb-4 mt-2">
                        <p class="text-dark"><i class="fa-solid fa-check icono-viñeta"></i><b> Patente: </b><?php echo $datosServicio['patente'];?></p>

                        <p class="text-dark"><i class="fa-solid fa-check icono-viñeta"></i><b> Tipo: </b><?php echo $tipoVehiculoServicio;?></p>

                        <p class="text-dark"><i class="fa-solid fa-check icono-viñeta"></i><b> Capacidad (en kg.): </b><?php echo $datosServicio['capacidad'];?></p>
                    </div>
                
                    <hr class="border border-danger border-2 opacity-40">
                </div>
                
            <div class="col-12 col-md-12">
                <h4 class="mt-1 mb-4 py-2 text-dark"><i class="fa-solid fa-circle-info icono-modificar"></i> Acerca del servicio </h4>
                <div class="mb-2">
                
                <p class="text-dark"><i class="fa-solid fa-check icono-viñeta"></i><b> Nombre: </b><i><?php echo $datosServicio['nombreServicio']; ?></i></p>

                <p class="text-dark"><i class="fa-solid fa-check icono-viñeta"></i><b> Categoría: </b><?php echo $datosServicio['categoria'];?></p>
                
                <p class="text-dark"><i class="fa-solid fa-check icono-viñeta"></i><b> Activo desde: </b><?php echo $fechaSolicitud = date("d-m-Y", strtotime($datosServicio['fechaAltaServicio'])); ?></p>

                <p class="text-dark"><i class="fa-solid fa-check icono-viñeta"></i><b> Alcance (en km.): </b><?php echo $datosServicio['alcance'];?></p>

                <p class="text-dark"><i class="fa-solid fa-check icono-viñeta"></i><b> Descripción: </b><i><?php echo $datosServicio['descripcionServicio'];?></i></p>               
            </div>
               
            <div class="text-center p-3">
                    <button type="submit" class="btn boton-servicios"> Solicitar Servicio </button>
                </div>
            
        </form>     
    </div>
    
</section>

<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

<?php
  require_once('../includes/footer.php');
?>