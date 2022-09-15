<?php
session_start();

if(!isset($_SESSION['idUsuario']) || $_SESSION['idRol'] != 3){
    header('Location:../index.php');
}

$pagina = 'listado-categorias';
require_once('../../includes/config.php');
require_once('../../includes/conexion.php');

if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])){
    $idCategoria = $_GET['id'];
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $idCategoria = $_POST['idCategoria'];

    if(empty($idCategoria)){
        $notificacion = "Error: ID de la categoria no es valido";
    }
    $stmt = $conexion->prepare("UPDATE categorias SET bajaCategoria = 1 WHERE idCategoria = :id");
    
        $resultado = $stmt->execute(array(':id' => $idCategoria));

        if($resultado){
            header('Location:listado.php');
        }
}

require_once('../../includes/header.php');
?>

<section class="alta-categorias">
    <div class="container">

        <h2 class="text-center">Eliminar Categorías</h2>

        <div class="row">
            <form action="eliminar.php" method="POST" class="col-md-6 mx-auto form-eliminar">
                <input type="hidden" name="idCategoria" value="<?php echo (isset($idCategoria)) ? $idCategoria : '' ?>">

                <p>Está seguro que desea eliminar la categoría seleccionada?</p>

                <?php 
                        if(isset($notificacion)){
                            echo '<p class="bg-danger text-white text-center">'.$notificacion.'</p>';
                        }                 
                    ?>

                <button type="submit" class="btn btn-danger">Eliminar</button>
                
            </form>
        </div>

    </div>
</section>

<?php
  require_once('../../includes/footer.php');
?>