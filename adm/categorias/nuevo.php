<?php
session_start();

if(!isset($_SESSION['idUsuario']) || $_SESSION['idRol'] != 3){
    header('Location:../index.php');
}

$pagina = 'alta-categorias';
require_once('../../includes/config.php');
require_once('../../includes/conexion.php');
require_once('../../includes/header.php');


if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $categoria = $_POST['categoria'];
    $img = $_FILES['imagen']['name'];
    $imgTmpName = $_FILES['imagen']['tmp_name'];
    $descripcion = $_POST['descripcion'];

    if(empty($categoria) || empty($img) || empty($descripcion)){
        $notificacion = "Error: No puede dejar campos vacíos";
    }else{
        $archivo_destino = '../../img/categorias/'.$_FILES['imagen']['name'];
        move_uploaded_file($imgTmpName,$archivo_destino);

        /* LISTAR USUARIO POR CORREO  */
            
        $stmt = $conexion->prepare("INSERT INTO categorias (categoria, descripcionCategoria, imgCategoria) VALUES (:categoria, :descripcion, :img)");
    
        $resultado = $stmt->execute(array(':categoria' => $categoria, ':descripcion' => $descripcion, ':img' => $img));

        if($resultado){
            header('Location:listado.php');
        }
    }
}

?>

<section class="alta-categorias">
    <div class="container py-3">
        <h1 class="text-center">Nueva Categoría</h1>

        <div class="row">
            <form action="nuevo.php" method="POST" class="col-md-6 mx-auto" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="categoria">Nombre de la categoría:</label>
                    <input class="form-control" type="text" name="categoria" id="categoria">
                </div>

                <div class="mb-3">
                    <label for="imagen">Imágen:</label>
                    <input class="form-control" type="file" name="imagen" id="imagen">
                </div>

                <div class="mb-3">
                    <label for="descripcion">Descripción de la categoría:</label>
                    <textarea class="form-control" name="descripcion" id="descripcion" rows="5"></textarea>
                </div>

                <button class="btn btn-success" type="submit">Crear</button>
            </form>
        </div>
    </div>
</section>

<?php
  require_once('../../includes/footer.php');
?>