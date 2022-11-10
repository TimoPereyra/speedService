<?php
session_start();
if(!isset($_SESSION['idRol'])){
    header('Location:../index.php');
}
$paginaTitulo = 'agenda';
$pagina = 1;
require_once('../includes/config.php');
require_once('../includes/conexion.php');

require_once('../includes/header.php');
if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['fecha'])){
    $fecha = $_GET['fecha'];
    echo($fecha);
    $stmt = $conexion->prepare("SELECT COUNT(*) as totalRegistro FROM solicitud_servicio 
    INNER JOIN notificaciones ON solicitud_servicio.idSolicitud = notificaciones.idSolicitud
    INNER JOIN servicios ON solicitud_servicio.idServicio = servicios.idServicio
    WHERE notificaciones.visto = 0 AND notificaciones.idProveedor = :idProveedor AND solicitud_servicio.fecha = :fecha;");
    $stmt->execute(array(':idProveedor' => $_SESSION['idUsuario'],':fecha' => $fecha));
    $resultado = $stmt->fetch();   
    $totalPaginas = 0;
    $totalRegistros = $resultado['totalRegistro'];

    $query = $conexion->prepare("SELECT * FROM solicitud_servicio
    INNER JOIN estado_servicio ON estado_servicio.idEstadoServicio = solicitud_servicio.idEstado 
    WHERE  solicitud_servicio.fecha = :fecha");
    $query->execute(array(':fecha' => $fecha) );
    $solicitudes = $query->fetchAll();
}
?>

<body>
<section class="alta-categorias">
    <div class="container">
        <h1 class="text-center py-5"> Listado de Solicitudes</h1>

        <div class="table-responsive bg-white">
            <?php
            
            $errorSolicitud = empty($solicitudes) ? true : false ;
            if(!$errorSolicitud){
            ?>

            <table class="table table-striped">
                <thead>
                    <tr class="table-danger">
                        <th scope="col">Fecha de solicitud</th>
                        <th scope="col">Hora</th>
                        <th scope="col">Descripción</th>
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
                                    
                            if ($fila['idEstado'] == 1){ 
                                echo '<td class="align-middle text-warning fw-bold">'.$fila['estadoServicio'].'</td>';
                            }else if ($fila['idEstado'] == 3){ 
                                echo '<td class="align-middle text-danger fw-bold">'.$fila['estadoServicio'].'</td>';
                            }else{ 
                                echo '<td class="align-middle text-success fw-bold">'.$fila['estadoServicio'].'</td>';
                            }
                            if($_SESSION['idRol']==1){
                                echo ' <td class="align-middle">
                                <a href="aceptarSoli.php?idSolicitud='.$fila['idSolicitud'].'"  class="icono-modificar"><i class="fa-solid fa-check"></i></a>
                            </td>
                                </tr>'; 
                            }
                            if($_SESSION['idRol']==2){
                                echo ' <td class="align-middle">
                                <a href="verMas.php?idSolicitud='.$fila['idSolicitud'].'" class="icono-modificar-verde"><i class="fa-solid fa-gear"></i></a>
                                <a href="aceptarSoli.php?idSolicitud='.$fila['idSolicitud'].'" class="icono-modificar"><i class="fa-solid fa-check"></i></a>
                            </td>
                                </tr>'; 
                            }
                        }
                    }else{
                        echo'
                            <div class="card-body tarjeta-servicio">
                                <h5 class="m-2">No tienes solicitudes registradas para esta fecha.</h5>
                                <div class="d-grid gap-2 d-md-block text-center">
                                    <a href="agenda.php" class="btn boton-servicios">Volver</a>    
                                </div>
                        </div>';
                        }
                    ?>
                </tbody>
                        
            </table>

            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center p-2">
                    <li class="page-item disabled">
                    <?php 
                if($pagina != 1){
                    echo $totalPaginas;
                    echo $pagina;
            ?>
                
                    <li class="page-item"><a class="page-link text-black" href="?pagina=<?php echo $pagina - 1; ?>" aria-label="Anterior"><span aria-hidden="true">&laquo;</span><b>Anterior</b></a></li>
            <?php                  
                }
            
                for ($i=1; $i <= $totalPaginas; $i++){
                   
                    echo ($pagina==$i) ? '<li class="page-item"><a class="page-link active" href="?pagina='.$i.'">'.$i.'</a></li>' : '<li class="page-item"><a class="page-link text-black" href="?pagina='.$i.'">'.$i.'</a></li>' ;
                  
                }
               
                
                if($pagina < $totalPaginas){
            ?>
                            <li class="page-item"><a class="page-link text-black" href="?pagina=<?php echo $pagina + 1; ?>" aria-label="Siguiente"><b>Siguiente</b><span aria-hidden="true">&raquo;</span></li></a>
                    <?php } ?>
                        </ul>
            </nav>

        </div>
    </div>
</section>
    
</body>


<?php
  require_once('../includes/footer.php');
?>