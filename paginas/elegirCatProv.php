<?php
session_start();

if(!isset($_SESSION['idUsuario'])){
    header('Location:../index.php');
}

$pagina = 'elegir-proveedor';
require_once('../includes/config.php');
require_once('../includes/conexion.php');
require_once('../includes/header.php');

/* LISTAR CATEGORIAS  */
$stmt = $conexion->prepare("SELECT * FROM categorias");
$stmt->execute();

$categorias = $stmt->fetchAll();?>

<main class="cardProvedor">
<div class="container">
      <h2 class="text-center mb-4">Elegi una categoria rey</h2>
      
    <div class="row">

        <?php
            foreach($categorias as $fila)
            {

                if($fila['idCategoria']== 1 || $fila['idCategoria'] == 3){
                    echo '
                        <div class="col-md-4 mb-3">
                        <div class="card">
                            <img src="../img/categorias/'.$fila['imgCategoria'].'" class="card-img-top imagen-servicios" alt="remis">
                            <div class="card-body">
                            <h5 class="card-title">'.ucfirst($fila['categoria']).'</h5>
                            <p class="card-text"><i>'.$fila['descripcionCategoria'].'</i></p>
                            <a href="ser-proveedor.php" class="btn d-grid gap-2 col-10 mx-auto boton-servicios">Completar formulario</a>
                            </div>
                        </div>
                        </div>
                    ';
                    
                }
                if($fila['idCategoria']== 2){
                    echo '
                        <div class="col-md-4 mb-3">
                        <div class="card">
                            <img src="../img/categorias/'.$fila['imgCategoria'].'" class="card-img-top imagen-servicios" alt="remis">
                            <div class="card-body">
                            <h5 class="card-title">'.ucfirst($fila['categoria']).'</h5>
                            <p class="card-text"><i>'.$fila['descripcionCategoria'].'</i></p>
                            <a href="#" class="btn d-grid gap-2 col-10 mx-auto boton-servicios">Completar formulario</a>
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
