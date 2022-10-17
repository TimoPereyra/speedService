<?php
session_start();

if(!isset($_SESSION['idUsuario'])){
    header('Location:../index.php');
}

$pagina = 'listado-categorias';
require_once('../includes/config.php');
require_once('../includes/conexion.php');

if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['idSolicitud'])){
    $idSolicitud = $_GET['idSolicitud'];
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $idSolicitud = $_POST['idSolicitud'];

    if(empty($idSolicitud)){
        $notificacion = "Error: ID de la categoria no es valido";
    }
    $stmt = $conexion->prepare("UPDATE solicitud_servicio SET idEstado=2 WHERE solicitud_servicio.idSolicitud = :idSolicitud;");
    
        $resultado = $stmt->execute(array(':idSolicitud' => $idSolicitud));

        if($resultado){
            header('Location:listNotProv.php');
        }
}

require_once('../includes/header.php');
?>

<section class="alta-categorias">
    <div class="container py-5">

        <h1 class="text-center">Aceptar solicitud</h1>

        <div class="row py-4">
            <form action="aceptarSoli.php" method="POST" class="col-md-6 mx-auto form-eliminar">
                <input type="hidden" name="idSolicitud" value="<?php echo (isset($idSolicitud)) ? $idSolicitud : '' ?>">

                <p>¿Está seguro que desea aceptar la solicitud seleccionada?</p>

                <?php 
                        if(isset($notificacion)){
                            echo '<p class="text-white text-center">'.$notificacion.'</p>';
                        }                 
                    ?>

                <button type="submit" class="btn d-grid gap-2 col-4 mx-auto boton-eliminar-categoria">Aceptar</button>
                
            </form>
        </div>

    </div>
</section>

<?php
  require_once('../includes/footer.php');
?>