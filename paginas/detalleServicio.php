<?php
session_start();
$pagina = 'listado-servicios';
require_once('../includes/config.php');
require_once('../includes/conexion.php');

if($_SERVER['REQUEST_METHOD'] == 'GET' && !isset($_GET['idServicio'])){
    header('Location:../index.php');
}
if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['idServicio'])){
    $idServicio = $_GET['idServicio'];
    $stmt = $conexion->prepare("SELECT idServicio, servicios.idUsuario, nombreServicio, descripcionServicio, categoria, fechaAltaServicio, alcance, imgUsuario, patente, capacidad, tipo, nombreCompleto, servicios.idVehiculo, categorias.idCategoria FROM servicios INNER JOIN categorias ON categorias.idCategoria = servicios.idCategoria INNER JOIN vehiculos ON vehiculos.idVehiculo = servicios.idVehiculo INNER JOIN usuarios ON usuarios.idUsuario = servicios.idUsuario INNER JOIN tipo_vehiculo ON tipo_vehiculo.idTipo = vehiculos.idTipo WHERE idServicio = :idServicio");
    $stmt->execute(array(':idServicio' => $idServicio));
    $datosServicio = $stmt->fetch();

    $nombreServicio = $datosServicio['nombreServicio'];
    $categoria = $datosServicio['idCategoria']; 
    $descripcionServicio = $datosServicio['descripcionServicio'];
    $tipoVehiculoServicio = $datosServicio['tipo'];
    $idProveedor = $datosServicio['idUsuario'];

    /* ACCEDER A LAS IMÁGENES DEL VEHÍCULO */
    $stmt = $conexion->prepare('SELECT * FROM fotos_vehiculo WHERE idVehiculo = :idVehiculo');
    $stmt->execute(array(':idVehiculo' => $datosServicio['idVehiculo']));
    $fotosVehiculo = $stmt->fetchAll();
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $fecha = $_POST['fecha'];
    $hora = $_POST['hora'];
    $idProveedor = $_POST['idProveedor'];
    $descripcion = $_POST['descripcion'];
    $idCliente = $_SESSION['idUsuario'];
    $idServicio = $_POST['idServicio']; 
    





    if(empty($fecha) || empty($hora) || empty($descripcion) || empty($idCliente) || empty($idServicio)){
        $notificacion = 'Error: no puede haber campos vacíos.';
    }else{

        $stmt = $conexion->prepare("INSERT INTO solicitud_servicio(fecha, hora, descripcion, idCliente, idEstado, idServicio) VALUES (:fecha, :hora, :descripcion, :idCliente, 1, :idServicio)");

        $resultado = $stmt->execute(array(':fecha' => $fecha, ':hora' => $hora, ':descripcion' => $descripcion, ':idCliente' => $idCliente, ':idServicio' => $idServicio));

        if($resultado){

            $notificacion = "Éxito: se ha registrado la solicitud correctamente.";

            $idSolicitud = trim($conexion->lastInsertId());

            $stmt = $conexion->prepare("INSERT INTO notificaciones(descripcion, idUsuarioNotificado, idSolicitud, idProveedor, visto) VALUES (:descripcionNotificacion, :idClienteNotificado, :idSolicitud, :idProveedorNotificado, 0)");

            $stmt->execute(array(':descripcionNotificacion' => $descripcion, ':idClienteNotificado' => $idCliente, ':idSolicitud' => $idSolicitud, ':idProveedorNotificado' => $idProveedor));
            header('Location:../index.php');

        }
    }

}

require_once('../includes/header.php');
?>

<section class="detalles-servicio py-5">
    <div class="container">
        <h1 class="text-center py-5">Detalle del Servicio</h1>  

        <?php 
            if(isset($notificacion)){
                echo '<p class="bg-danger text-white text-center">'.$notificacion.'</p>';
            }else {

            }

            ?>

        <form action="detalleServicio.php" method="POST" class="bg-white p-4 form-detalle">
        <div class="row">
            <div class="col-4 col-conductor">
                <h4 class="py-1 text-black"><i class="fa-solid fa-user icono-modificar"></i> Conductor </h4>
            <div class="col-4 col-md-12 text-center">
                <img src="../img/usuarios/<?php echo $datosServicio['imgUsuario'];?>" class="card-img-top img-fluid imagen-servicios-usuario mb-2 text-center" alt="imgUsuario"> 
                <h5 class="text-dark text-center"><?php echo $datosServicio['nombreCompleto']; ?></h5>                             
            </div>
            </div>
            
        <div class="col-8">
            <div class="col-12 col-md-12">
                <h4 class="py-2 text-dark"><i class="fa-solid fa-car icono-modificar"></i> Vehículo </h4>
                    <div class="text-center">
                        <?php 
                            foreach ($fotosVehiculo as $foto) {
                                echo '
                                    <a href="../img/vehiculos/'.$foto['urlFoto'].'" data-lightbox="img-vehiculo"><img class="img-fluid img-detalle-servicio" src="../img/vehiculos/'.$foto['urlFoto'].'" alt=""></a> 
                                ';
                            }
                        ?>
                    </div>

                    <div class="mb-1 mt-1">
                        <p class="text-dark"><i class="fa-solid fa-check icono-viñeta"></i><b> Patente: </b><?php echo $datosServicio['patente'];?></p>

                        <p class="text-dark"><i class="fa-solid fa-check icono-viñeta"></i><b> Tipo: </b><?php echo $tipoVehiculoServicio;?></p>

                        <p class="text-dark"><i class="fa-solid fa-check icono-viñeta"></i><b> Capacidad (en kg): </b><?php echo $datosServicio['capacidad'];?></p>
                    </div>
                
                <hr class="border border-danger border-2 opacity-40">

            </div>
                
            <div class="col-12 col-md-12">
                <h4 class="py-1 text-dark"><i class="fa-solid fa-circle-info icono-modificar"></i> Acerca del servicio </h4>
                <div class="mb-1">
                
                <p class="text-dark"><i class="fa-solid fa-check icono-viñeta"></i><b> Nombre: </b><i><?php echo $datosServicio['nombreServicio']; ?></i></p>

                <p class="text-dark"><i class="fa-solid fa-check icono-viñeta"></i><b> Categoría: </b><?php echo $datosServicio['categoria'];?></p>
                
                <p class="text-dark"><i class="fa-solid fa-check icono-viñeta"></i><b> Activo desde: </b><?php echo $fechaSolicitud = date("d-m-Y", strtotime($datosServicio['fechaAltaServicio'])); ?></p>

                <p class="text-dark"><i class="fa-solid fa-check icono-viñeta"></i><b> Alcance (en km): </b><?php echo $datosServicio['alcance'];?></p>

                <p class="text-dark"><i class="fa-solid fa-check icono-viñeta"></i><b> Descripción: </b><i><?php echo $datosServicio['descripcionServicio'];?></i></p>               
                </div>
            </div>
            
        </form> 
           
    </div>

    <input type="hidden" name="idServicio" value="<?php echo (isset($idServicio)) ? $idServicio : '' ?>">
    <input type="hidden" name="idServicio" value="<?php echo (isset($idServicio)) ? $idServicio : '' ?>">
    <input type="hidden" name="idProveedor" value="<?php echo (isset($idProveedor)) ? $idProveedor : '' ?>">

    <div class="mt-3 col-12 col-md-6 fondo-formulario"> 
        <label for="" class="text-dark"><b>Fecha:</b></label>
        <input type="date" class="form-control" name="fecha">
        <label for="" class="text-dark"><b>Hora:</b></label>
        <input type="text" class="form-control" name="hora">
    </div>
    <div class="mt-3 col-8 col-md-6 fondo-formulario">
        <label for="" class="text-dark"><b>Descripción</b> (ej. domicilio, destino...)<b>:</b></label>
        <textarea id="" cols="30" rows="10" class="form-control" name="descripcion"></textarea>
    </div>
               
    <div class="mt-3 col-12 col-md-12 " id="form" >   
            <button type="submit" class="btn boton-servicios d-grid gap-2 col-4 mx-auto"> Solicitar servicio </button>
    </div> 
</section>

<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

<?php
  require_once('../includes/footer.php');
?>