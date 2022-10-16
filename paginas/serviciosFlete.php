<?php
$pagina = 'servicios-flete';
require_once('../includes/config.php');

require_once('../includes/conexion.php');

$busqueda = empty ($_REQUEST['busqueda']) ? '' : $_REQUEST['busqueda'];
if(empty($busqueda)){
    $stmt = $conexion->prepare("SELECT nombreServicio, imgUsuario,urlFoto,idServicio FROM servicios
    INNER JOIN usuarios ON usuarios.idUsuario = servicios.idUsuario
    INNER JOIN vehiculos ON vehiculos.idVehiculo = servicios.idVehiculo
    INNER JOIN fotos_vehiculo ON fotos_vehiculo.idVehiculo = vehiculos.idVehiculo
    WHERE idCategoria = 1
    GROUP BY idServicio;");
    $stmt->execute();
    $servicios = $stmt->fetchAll();
}else{
    $stmt = $conexion->prepare("SELECT nombreServicio, imgUsuario,urlFoto,idServicio FROM servicios INNER JOIN usuarios ON usuarios.idUsuario = servicios.idUsuario INNER JOIN vehiculos ON vehiculos.idVehiculo = servicios.idVehiculo INNER JOIN fotos_vehiculo ON fotos_vehiculo.idVehiculo = vehiculos.idVehiculo WHERE nombreServicio LIKE '%$busqueda%' AND idCategoria = 1 GROUP BY idServicio;");
    $stmt->execute();
    $servicios = $stmt->fetchAll();
    $errorBusqueda = empty($servicios) ? true : false ;

}


require_once('../includes/header.php');

?>

<?php

//Paginador
    //$sql = mysqli_query($conexion, "SELECT COUNT(*) as totalRegistro FROM servicios WHERE idCategoria = 1");
    //$resultado = mysqli_fetch_array($sql);
    //$totalRegitro = $resultado['totalRegistro'];

    //$porPagina = 3; 

    //if(empty($_GET['pagina'])){
        //$pagina = 1; 
    //}else{
        //$pagina = $_GET['pagina'];
    //}

    //$desde = ($pagina-1) * $porPagina; 
    //$totalPaginas = ceil($totalRegitro / $porPagina);
    
    //$query = mysqli_query($conexion, "SELECT * FROM servicios WHERE idCategoria = 1 ORDER BY idServicio ASC LIMIT $desde, $porPagina");


?>


<main class="pagina-servicios py-5">
    <section class="servicios">
        <div class="container">
            <section class="mt-2 mb-3"> 
                <form method="get">
			        <input type="text" id="busqueda" name="busqueda" placeholder=" Buscar servicio por nombre..." class="buscador">
			        <input type="submit" value="Buscar" class="boton-buscador-buscar">
		        </form>
	        </section>                    

            <div class="row">
                <div class="col-12 col-md-12 columna-servicios">
                    <h3>Fletes</h3>
                    <div class="row">
                  
                        <?php
                            foreach($servicios as $fila){
                            
                                echo '
                                <div class="col-md-3 mb-3">
                                    <div class="card" style="width: 300px">
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

    <div>
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
            <?php 
                //if($pagina != 1){
            ?>
                    <li class="page-item"><a class="page-link" href="?pagina=<?php// echo 1; ?>" aria-label="<<"><span aria-hidden="true">&laquo;</span></a></li>

                    <li class="page-item"><a class="page-link" href="?pagina=<?php// echo $pagina - 1; ?>" aria-label="|<"><span aria-hidden="true">&raquo;</span></a></li>
            <?php                  
                //}
            
                //for ($i=0; $i < $porPagina; $i++){
                    //if($i == $pagina){
                       //echo '<li class="page-item selected">'.$i.'</li>';
                    //}
                    //echo '<li class="page-item"><a class="page-link" href="?pagina='.$i.'">'.$i.'</a></li>';
                //}

                //if($pagina != $totalPaginas)
                //{
            ?>
                <li class="page-item"><a class="page-link" href="?pagina=<?php// echo $pagina + 1; ?>" aria-label=">>"><span aria-hidden="true">&raquo;</span></a></li>

                <li class="page-item"><a class="page-link" href="?pagina=<?php// echo $totalPaginas; ?>" aria-label=">|"><span aria-hidden="true">&raquo;</span></a></li>
        <?php//   } ?>
        </ul>
    </nav>
    </div> 

</main>

<script>
    let errorServidor = "<?php echo (isset($errorBusqueda)) ? $errorBusqueda : '' ;?>";
    
    if(errorServidor){
        alert('Error: no existen resultados para su búsqueda.'); 
        window.location.href = 'serviciosFlete.php';
    }
</script>

<?php
  require_once('../includes/footer.php');
?>
