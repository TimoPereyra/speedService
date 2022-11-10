<?php
session_start();

if((!isset($_SESSION['idRol'])) && $_SESSION['idRol'] != 1) {
    header('Location:../index.php');
}

$paginaTitulo = 'listado-pedidos';
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

if($_SESSION['idRol']==1){
    

    $stmt = $conexion->prepare("SELECT COUNT(*) as totalRegistro FROM solicitud_servicio 
    INNER JOIN notificaciones ON solicitud_servicio.idSolicitud = notificaciones.idSolicitud 
    INNER JOIN estado_servicio ON estado_servicio.idEstadoServicio = solicitud_servicio.idEstado
    INNER JOIN usuarios ON usuarios.idUsuario = solicitud_servicio.idCliente
    WHERE notificaciones.visto = 2 AND solicitud_servicio.idCliente = :idUsuario");


    $stmt->execute(array(':idUsuario' => $_SESSION['idUsuario']));
    $resultado = $stmt->fetch();

    $totalRegistros = $resultado['totalRegistro'];     
    $totalPaginas = ceil($totalRegistros / $porPagina);

   //No anda la pasada por parametros del limit
     $query = $conexion->prepare("SELECT * FROM solicitud_servicio 
     INNER JOIN notificaciones ON solicitud_servicio.idSolicitud = notificaciones.idSolicitud 
     INNER JOIN estado_servicio ON estado_servicio.idEstadoServicio = solicitud_servicio.idEstado
     INNER JOIN usuarios ON usuarios.idUsuario = solicitud_servicio.idCliente
     WHERE notificaciones.visto = 2 AND solicitud_servicio.idCliente = :idUsuario
     ORDER BY fecha DESC");
    $query->execute(array(':idUsuario' => $_SESSION['idUsuario']));
    $solicitudes = $query->fetchAll();
    


}

require_once('../includes/header.php');
?>

<section class="listado-pedidos">
    <div class="container">
        <h1 class="text-center py-5">Mis Pedidos</h1>

        <div class="table-responsive bg-white">
            <table class="table table-striped">
                <thead>
                    <tr class="table-secondary">
                        <th scope="col" class="text-center">Fecha de solicitud</th>
                        <th scope="col" class="text-center">Hora</th>
                        <th scope="col" class="text-center">Descripción</th>
                        <th scope="col" class="text-center">Precio del servicio</th>
                        <th scope="col" class="text-center">Estado</th>
                        <th scope="col" class="text-center">Acción</th>
                    </tr>
                    
                </thead>
                <tbody>
                    <?php
                        foreach ($solicitudes as $fila) {
                            $originalDate = $fila['fecha'];
                            $newDate = date("d-m-Y", strtotime($originalDate));
                            echo '
                                <tr>
                                    <td class="align-middle text-center">'.$newDate.'</td>
                                    <td class="align-middle text-center">'.$fila['hora'].'</td>
                                    <td class="align-middle text-center">'.$fila['descripcion'].'</td>
                                    <td class="align-middle text-center">'.$fila['precioServicio'].'</td>';
                                    
                                    if ($fila['idEstado'] == 1){ 
                                        echo '<td class="align-middle text-warning fw-bold text-center">'.$fila['estadoServicio'].'</td>';
                                    }else if ($fila['idEstado'] == 3){ 
                                        echo '<td class="align-middle text-danger fw-bold text-center">'.$fila['estadoServicio'].'</td>';
                                    }else{ 
                                        echo '<td class="align-middle text-success fw-bold text-center">'.$fila['estadoServicio'].'</td>';
                                    }
                             
                                echo ' <td class="align-middle text-center">
                                <a href="factura.php?idSolicitud='.$fila['idSolicitud'].'" class="btn d-grid gap-2 col-9 mx-auto boton-servicios">Ver factura</a>

                            </td>
                                </tr>'; 
                             
                        

                             
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

<?php
  require_once('../includes/footer.php');
?>