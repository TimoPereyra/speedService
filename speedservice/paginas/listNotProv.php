<?php
session_start();



$pagina = 'listado-solicitudes';
require_once('../includes/config.php');
require_once('../includes/conexion.php');

if(isset ($_SESSION['idRol']) && $_SESSION['idRol']==1){
$stmt = $conexion->prepare("SELECT * FROM solicitud_servicio
 INNER JOIN notificaciones ON solicitud_servicio.idSolicitud = notificaciones.idSolicitud
 WHERE notificaciones.visto = 0
 ORDER BY fecha ASC;");
$stmt->execute();
$solicitudes = $stmt->fetchAll();
}
if(isset ($_SESSION['idRol']) && $_SESSION['idRol']==2){
    $stmt = $conexion->prepare("SELECT * FROM solicitud_servicio
     INNER JOIN notificaciones ON solicitud_servicio.idSolicitud = notificaciones.idSolicitud
     WHERE notificaciones.visto = 1
     ORDER BY fecha ASC;");
    $stmt->execute();
    $solicitudes = $stmt->fetchAll();
    }
require_once('../includes/header.php');
?>
<?php if(isset ($_SESSION['idRol'])) :?>
<section class="alta-categorias">
    <div class="container">
        <h1 class="text-center py-5">Listado de solicitudes</h1>

        <div class="table-responsive bg-white">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Fecha de solicitud</th>
                        <th scope="col">Hora</th>
                        <th scope="col">Descripcion</th>
                        <th scope="col">Precio del servicio</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Acción</th>
                    </tr>
                    
                </thead>
                <tbody>
                    <?php
                        foreach ($solicitudes as $fila) {
                            $originalDate = $fila['fecha'];
                            $newDate = date("d-m-Y", strtotime($originalDate));
                            echo '
                                <tr>
                                    <td class="align-middle">'.$newDate.'</td>
                                    <td class="align-middle">'.$fila['hora'].'</td>
                                    <td class="align-middle">'.$fila['descripcion'].'</td>
                                    <td class="align-middle">'.$fila['precioServicio'].'</td>';
                                    
                                    if ($fila['idEstado'] == 2){ 
                                        echo '<td class="align-middle text-warning fw-bold">'.$fila['idEstado'].'</td>';
                                    }else if ($fila['idEstado'] == 3){ 
                                        echo '<td class="align-middle text-danger fw-bold">'.$fila['idEstado'].'</td>';
                                    }else{ 
                                        echo '<td class="align-middle text-success fw-bold">'.$fila['idEstado'].'</td>';
                                    }
                             if($_SESSION['idRol']==1){
                                echo ' <td class="align-middle">
                                    
                                   <a href="aceptarSoli.php?idSolicitud='.$fila['idSolicitud'].'"  class="icono-aceptar"><i class="fa-solid fa-trash"></i></a>
                            </td>
                                </tr>'; 
                             }
                             if($_SESSION['idRol']==2){
                                echo ' <td class="align-middle">
                                    <a href="verMas.php?idSolicitud='.$fila['idSolicitud'].'" class="icono-modificar-verde"><i class="fa-solid fa-gear"></i></a>
                                   <a href="aceptarSoli.php?idSolicitud='.$fila['idSolicitud'].'"  class="icono-aceptar"><i class="fa-solid fa-trash"></i></a>
                            </td>
                                </tr>'; 
                             }

                               
                        }                       
                    ?>
                </tbody>

            </table>
        </div>
    </div>
</section>
<?php endif;  ?>


<?php
  require_once('../includes/footer.php');
?>