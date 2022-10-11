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

<section class="detalles-servicio">
    <div class="container">
        <h1 class="text-center py-5">Detalle del Servicio</h1>


        <form action="detalleServicio.php" method="POST" class="bg-white p-4 form-detalle">
        <div class="row">
            
            <div class="col-12 col-md-6">
                <h4 class="mb-4 py-2 bg-secondary text-white text-center">Datos del Proveedor</h4>
                <div class="mb-2">
                    <label for="" class="text-dark"><b>Foto de perfil</b>:</label> 
                    <img src="../img/usuarios/<?php echo $datosServicio['imgUsuario'];?>" class="card-img-top img-fluid imagen-servicios-usuario" alt="imgUsuario">                              
                </div>
                <div class="mb-2">
                    <label for="" class="text-dark"><b>Nombre</b>:</label> <input type="text" value="<?php echo $datosServicio['nombreCompleto']; ?>">
                </div>
            </div>

            <div class="col-12 col-md-6">
                <h4 class="mb-4 py-2 bg-secondary text-white text-center">Datos del Servicio</h4>
                <div class="mb-2">
                    <label for="" class="text-dark me-2"><b>En actividad desde</b>:</label> <input type="text" value="<?php echo $fechaSolicitud = date("d-m-Y", strtotime($datosServicio['fechaAltaServicio'])); ?>">
                </div>
                <div class="mb-2">
                    <label for="" class="text-dark"><b>Nombre</b>:</label> <input type="text" value="<?php echo $nombreServicio; ?>" name="nombreServicio" class="form-control">
                </div>
                
                <div class="mb-2">
                    <label for="" class="text-dark"><b>Categoría</b>:</label>
                    <div class="d-flex">                  
                        <div class="form-check d-flex align-items-center">
                            <input class="form-check-input" type="radio" name="categoriaServicio" id="flete" <?php echo ($categoria == 1) ? 'checked' : '' ?> value="1">
                            <label class="form-check-label text-black" for="flete"> Flete </label>
                        </div>
                        
                        <div class="form-check d-flex align-items-center">
                            <input class="form-check-input" type="radio" name="categoriaServicio" id="remis" <?php echo ($categoria == 3) ? 'checked' : '' ?> value="3">
                            <label class="form-check-label text-black" for="remis"> Remis </label>
                        </div>

                        <div class="form-check d-flex align-items-center">
                            <input class="form-check-input" type="radio" name="categoriaServicio" id="mandado" <?php echo ($categoria == 2) ? 'checked' : '' ?> value="2">
                            <label class="form-check-label text-black" for="mandado"> Mandado </label>
                        </div>                      
                    </div>
                </div>

                <div class="mb-2">
                    <label for="" class="text-dark"><b>Alcance (en km.)</b>:</label> <input type="text" value="<?php echo $datosServicio['alcance']; ?>">
                </div>
                <div class="mb-2">
                    <label for="" class="text-dark"><b>Descripción</b>:</label> <textarea value="<?php echo $datosServicio['descripcionServicio']; ?>" class="form-control" name="descripcionServicio"><?php echo $descripcionServicio; ?></textarea>
                </div>
            </div>

            <div class="col-12 col-md-6">
                <h4 class="mt-4 mb-4 py-2 bg-secondary text-white text-center">Datos del Vehículo</h4>
                <div class="mb-2">
                    <label for="" class="text-dark"><b>Patente</b>:</label> <input type="text" value="<?php echo $datosServicio['patente']; ?>">
                </div>
                <div class="mb-2">
                    <label for="" class="text-dark"><b>Tipo</b>:</label> <input type="text" value="<?php echo $tipoVehiculoServicio; ?>"name="tipoVehiculoServicio" >
                </div>
                
                <div class="mb-2">
                    <label for="" class="text-dark"><b>Imágenes del vehículo</b>:</label>

                    <?php 
                        foreach ($fotosVehiculo as $foto) {
                            echo '
                                <a href="../img/vehiculos/'.$foto['urlFoto'].'" data-lightbox="img-vehiculo"><img class="img-fluid img-detalle-servicio" src="../img/vehiculos/'.$foto['urlFoto'].'" alt=""></a> 
                            ';
                        }
                    ?>

                </div>

                <div class="mb-2">
                    <label for="" class="text-dark"><b>Capacidad (en kg.)</b>:</label> <textarea value="<?php echo $datosServicio['capacidad']; ?>" class="form-control"><?php echo $datosServicio['capacidad']; ?></textarea>
                </div>
            </div>
            <button type="submit" class="btn boton-servicios"> Solicitar Servicio </button>
        </form>     
    </div>
    
</section>

<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

<?php
  require_once('../includes/footer.php');
?>