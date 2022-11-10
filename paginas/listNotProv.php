<?php
session_start();

if(!isset($_SESSION['idRol'])){
    header('Location:../index.php');
}

$paginaTitulo = 'listado-solicitudes';
$porPagina = 3; 

require_once('../includes/config.php');
require_once('../includes/conexion.php');

if(empty($_GET['pagina'])){
    $pagina = 1; 
    $desde = 0;
}else{
    $pagina = $_GET['pagina'];
    $desde = ($pagina-1) * $porPagina; 
}

// MODIFICAR CONSULTA PARA LISTAR NOTIFICACIONES DE UN USUARIO ESPECIFICO.
// REALIZAR FUNCION PARA LISTAR SOLICITUDES PASANDO POR PARAMETRO EL ROL Y EN BASE A ESTO DESARROLLAR LA PAGINACIÓN.

if(isset ($_SESSION['idRol']) && $_SESSION['idRol']==1){
    $stmt = $conexion->prepare("SELECT COUNT(*) as totalRegistro FROM solicitud_servicio 
    INNER JOIN notificaciones ON solicitud_servicio.idSolicitud = notificaciones.idSolicitud
    WHERE notificaciones.visto = 1;");
    $stmt->execute();
    $resultado = $stmt->fetch();

    $totalRegistros = $resultado['totalRegistro'];     
    $totalPaginas = ceil($totalRegistros / $porPagina);

   //No anda la pasada por parametros del limit
     $query = $conexion->prepare("SELECT * FROM solicitud_servicio 
     INNER JOIN notificaciones ON solicitud_servicio.idSolicitud = notificaciones.idSolicitud
     INNER JOIN estado_servicio ON estado_servicio.idEstadoServicio = solicitud_servicio.idEstado
     WHERE notificaciones.visto = 1
     LIMIT $desde, $porPagina");
    $query->execute();
    $solicitudes = $query->fetchAll();
    


}
if(isset ($_SESSION['idRol']) && $_SESSION['idRol']==2){

    /* LISTAR SOLICITUDES DEL PROVEEDOR LOGEADO ACTUALMENTE */

    //SELECT * FROM solicitud_servicio INNER JOIN servicios ON servicios.idServicio = solicitud_servicio.idServicio WHERE servicios.idUsuario = 
    $stmt = $conexion->prepare("SELECT COUNT(*) as totalRegistro FROM solicitud_servicio 
    INNER JOIN notificaciones ON solicitud_servicio.idSolicitud = notificaciones.idSolicitud
    INNER JOIN servicios ON solicitud_servicio.idServicio = servicios.idServicio 
    WHERE notificaciones.visto = 0 AND notificaciones.idProveedor = :idProveedor 
     ;");
    $stmt->execute(array(':idProveedor' => $_SESSION['idUsuario']));
    $resultado = $stmt->fetch();
    $totalRegistros = $resultado['totalRegistro'];  
    $totalPaginas = ceil($totalRegistros / $porPagina);

    $query = $conexion->prepare("SELECT * FROM solicitud_servicio 
    INNER JOIN notificaciones ON solicitud_servicio.idSolicitud = notificaciones.idSolicitud
    INNER JOIN servicios ON solicitud_servicio.idServicio = servicios.idServicio
    INNER JOIN estado_servicio ON estado_servicio.idEstadoServicio = solicitud_servicio.idEstado
    WHERE notificaciones.visto = 0 AND notificaciones.idProveedor = :idProveedor
    ORDER BY fecha DESC");
    $query->execute(array(':idProveedor' => $_SESSION['idUsuario'] ));
    $solicitudes = $query->fetchAll();
   



    
    }
require_once('../includes/header.php');
?>

<?php if(isset ($_SESSION['idRol'])) :?>
<section class="alta-categorias">
    <div class="container">
        <h1 class="text-center py-5">Listado de Notificaciones</h1>

        <div class="table-responsive bg-white">
            <table class="table table-striped">
                <thead>
                    <tr class="table-info">
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
<?php endif;  ?>


<?php
  require_once('../includes/footer.php');
?>