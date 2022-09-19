<?php
session_start();

if(!isset($_SESSION['idUsuario'])){
    header('Location:../index.php');
}

$pagina = 'elegir-proveedor';
require_once('../includes/config.php');
require_once('../includes/conexion.php');
require_once('../includes/header.php');

/* LISTAR CATEGORIAS */
$stmt = $conexion->prepare("SELECT * FROM categorias");
$stmt->execute();

$categorias = $stmt->fetchAll();?>

<main class="cardProvedor">
<div class="container">
    <h1 class="text-center mb-4 text-light">¿Qué servicio querés ofrecer?</h1>
      
    <div class="row py-5">

        <?php
            foreach($categorias as $fila)
            {

                if($fila['idCategoria']== 1 || $fila['idCategoria'] == 3){
                    echo '
                        <div class="col-md-4 mb-3">
                        <div class="card">
                            <img src="../img/categorias/'.$fila['imgCategoria'].'" class="card-img-top imagen-servicios" alt="">
                            <div class="card-body">
                            <h4 class="card-title text-center py-1 mb-3">'.ucfirst($fila['categoria']).'</h4>
                            <a href="#" class="btn d-grid gap-2 col-8 mx-auto boton-servicios">Completar formulario</a>
                            </div>
                        </div>
                        </div>
                    ';
                    
                }
                if($fila['idCategoria']== 2){
                    echo '
                        <div class="col-md-4 mb-3">
                        <div class="card">
                            <img src="../img/categorias/'.$fila['imgCategoria'].'" class="card-img-top imagen-servicios" alt="">
                            <div class="card-body">
                            <h4 class="card-title text-center py-1 mb-3">'.ucfirst($fila['categoria']).'</h4>
                            <a href="#" class="btn d-grid gap-2 col-8 mx-auto boton-servicios">Completar formulario</a>
                            </div>
                        </div>
                        </div>
                    ';
                    }
            }
            

        ?>

    </div>
</div>
  

</main>
<?php 
require_once('../includes/footer.php');?>
