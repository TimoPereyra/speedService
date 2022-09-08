<?php
session_start();

if(!isset($_SESSION['idUsuario']) || $_SESSION['idRol'] != 3){
    header('Location:../index.php');
}

$pagina = 'listado-categorias';
require_once('../../includes/config.php');
require_once('../../includes/conexion.php');
require_once('../../includes/header.php');

$stmt = $conexion->prepare("SELECT * FROM categorias ORDER BY categoria");
$stmt->execute();
$categorias = $stmt->fetchAll();

?>

<section class="alta-categorias">
    <div class="container">
        <h2 class="text-center">Listado de categorías</h2>

        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Imágen</th>
                        <th scope="col">Categoría</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Acción</th>
                    </tr>
                    
                </thead>
                <tbody>
                    <?php
                        foreach ($categorias as $fila) {
                            echo '
                                <tr>
                                    <td><img src="'.RUTARAIZ.'/img/categorias/'.$fila['imgCategoria'].'" alt="imágen de la categoría" style="max-width:100px"></td>
                                    <td>'.$fila['categoria'].'</td>
                                    <td>'.$fila['descripcionCategoria'].'</td>
                                    <td>
                                        <a href="modificar.php?id='.$fila['idCategoria'].'">Modificar</a>
                                        <a href="eliminar.php?id='.$fila['idCategoria'].'">Eliminar</a>
                                    </td>
                                </tr>
                            ';
                        }
                    ?>
                </tbody>

            </table>
        </div>
    </div>
</section>


<?php
  require_once('../../includes/footer.php');
?>