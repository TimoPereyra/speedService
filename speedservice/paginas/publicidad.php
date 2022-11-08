<?php
session_start();

function validarFecha($fechaAlta,$fechaBaja){
    $alta = new DateTime($fechaAlta);
    $baja = new DateTime($fechaBaja);
    $ahora = new DateTime(date("Y-m-d"));

    if($ahora > $alta || $ahora >$baja || $alta > $baja){
        return -1;
    }else{
        $plazo = $baja->diff($alta);

       return $plazo->format("%d"); 
    }
}


$pagina = 'registro';
require_once('../includes/config.php');
require_once('../includes/conexion.php');
require_once('../includes/header.php');


if($_SERVER['REQUEST_METHOD'] == 'POST'){


    $nombrePublicidad = $_POST['nombrePublicidad'];
    $fotoPublicidad = $_FILES['imgPublicidad']['name'];
    $fotoTmpName = $_FILES['imgPublicidad']['tmp_name'];
    $contacto = $_POST['contactoPublicidad'];
    $direccionPublicidad = $_POST['direccionPublicidad'];
    $fechaAlta = $_POST['fechaAlta'];
    $fechaBaja = $_POST['fechaBaja'];
    $idUsuario = $_SESSION['idUsuario'];
    $plazo = validarFecha($fechaAlta,$fechaBaja);
    if(empty($nombrePublicidad) || empty($fotoPublicidad) || empty($contacto) || empty($fechaAlta) || empty($fechaBaja)|| $plazo == -1){
        $notificacion = "Error: no puede dejar campos vacíos o las fechas ingresadas son incorrectas.";
    }
    else{
        $archivo_destino = '../img/publicidad/'.$_FILES['imgPublicidad']['name'];
        move_uploaded_file($fotoTmpName,$archivo_destino);

        /* LISTAR USUARIO POR CORREO  */
        
        $stmt = $conexion->prepare("INSERT INTO publicidad(nombrePublicidad, fotoPublicidad, contacto, direccionPublicidad, fechaAlta, fechaBaja, idUsuario) VALUES (:nombre, :imgPublicidad,:contacto,:direccion, :fechaAlta, :fechaBaja, :idUsuario);");
        $resultado = $stmt->execute(array(':nombre'=>$nombrePublicidad,':imgPublicidad' => $fotoPublicidad, ':contacto' => $contacto,':direccion' => $direccionPublicidad, ':fechaAlta'=> $fechaAlta, ':fechaBaja' => $fechaBaja, ':idUsuario' => $idUsuario));

    }

}



?>
<main class="registrar-servicio">

    <seccion class="formulario py-1">
       
        <div class="container">
            <div class="row align-items-center">
            
                <div class="col-4">
                    <h2 class="mb-1 text-center"><b>Publicitá en la nueva app de servicios de la ciudad de Chivilcoy</b></h2>
                    <p class="text-center">Registrá tu publicidad, cumplí con nuestros requisitos y ganá dinero.</p>
                </div>

                <div class="col-8">
            <?php 
            if(isset($notificacion)){
                echo '<p class="bg-danger text-white text-center">'.$notificacion.'</p>';
            }else {

            }

            ?>

                <form action="publicidad.php" method="POST" enctype="multipart/form-data" id="formRegistro" class="row">

                    <div class="col-12 col-md-6 arregloForm">
                        <div class="mb-3">
                            <label for="nombrePublicidad">Nombre de la empresa:</label>
                            <input type="text" class="form-control" id="nombrePublicidad" name="nombrePublicidad" required>
                            <p class="text-white bg-danger msj-error">Error: El nombre debe tener al menos 6 caracteres.</p>
                        </div>
                        <div class="mb-3">
                            <label for="imgPublicidad">Imagen que desea publicar:</label>
                            <input type="file" class="form-control" id="imgPublicidad" name="imgPublicidad">
                            <p class="text-white bg-danger msj-error">Error: Debe elegir una imagen publicitaria.</p>
                        </div>
                        
                        <div class="mb-3">
                            <label for="contactoPublicidad">Contacto (teléfono, correo o red social):</label>
                            <input type="text" class="form-control" id="contactoPublicidad" name="contactoPublicidad" required>
                        </div>

                       
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="mb-3">
                            <label for="direccionPublicidad">Dirección:</label>
                            <input type="text" class="form-control" id="direccionPublicidad" name="direccionPublicidad" required>
                        </div>
                        <div class="mb-3">
                            <label for="fechaAlta">Fecha de alta (desde):</label>
                            <input type="date" class="form-control" id="fechaAlta" name="fechaAlta" required>
                        </div>
                        <div class="mb-3">
                            <label for="fechaBaja">Fecha de baja (hasta):</label>
                            <input type="date" class="form-control" id="fechaBaja" name="fechaBaja" required>
                        </div>
                       
                        
                    </div>

                                       
                    <button type="submit" id="btnEnviar" class="btn d-grid gap-2 col-5 mx-auto boton-servicios">Enviar solicitud</button>
                    

                </form>

                </div>
            </div>
        </div>
    </seccion>

</main>

<?php
  require_once('../includes/footer.php');
?>