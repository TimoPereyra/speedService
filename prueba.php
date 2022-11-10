<?php 

require_once('includes/conexion.php');
session_start();
// echo($_SESSION['idRol']);
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
function obtener_edad_segun_fecha($fechaNacimiento){
    $nacimiento = new DateTime($fechaNacimiento);
    $ahora = new DateTime(date("Y-m-d"));
    if($ahora > $nacimiento){
        echo("no podes nacer despues rey");
    }else{
        echo("fechaCorrect");
    }
    
}

/* LISTAR PUBLICIDAD */ 
$stmt = $conexion->prepare("SELECT * FROM publicidad WHERE 1");
$stmt->execute();
$publicidad = $stmt->fetchAll();

 $hash = '$2y$10$nVxe6Px/FDVwNBd/ddiNZufV9bIgwxWS1TpAkOaINQCvt2YZR69x2';

//  if (password_verify('456', $hash)) {
//  echo 'La contraseña es válida!';
//  } else {
//   echo 'La contraseña no es válida.';
//  }
 

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $img = $_FILES['imgPerfil']['name'];
    $imgTmpName = $_FILES['imgPerfil']['tmp_name'];
    $extension = pathinfo($img, PATHINFO_EXTENSION);

    // switch ($extension) {
    //     case 'jpg':
    //         echo 'ES JPG';
    //     break;
            
    //     case 'png':
    //         echo 'ES PNG';
    //         break;
    //     case 'jpeg':
    //        echo 'ES JPEG';
    //         break;
        
    //     default:
    //         echo 'ERROR INVALIDO';
    //         break;
    // }
    // obtener_edad_segun_fecha($_POST['fechaAlta']);
    
    $plazo = validarFecha($_POST['fechaAlta'],$_POST['fechaBaja']); 
    echo($plazo);
}


?>

<section>
    <div class="container">
        
        <form action="prueba.php" id="formPrueba"  method="POST" enctype="multipart/form-data">


        <div class="mb-3">
            <label for="imgPerfil">Imagen de perfil:</label>
            <input type="file" class="form-control" id="imgPerfil" name="imgPerfil">
            
        </div>
            <div class="card">
                    
                <img src="img/sponsors/detalle-servicio.jpg" alt="">
                    
                    
            </div>
        <div class="mb-3">
            <label for="fechaAlta">Fecha de alta (Desde):</label>
            <input type="date" class="form-control" id="fechaAlta" name="fechaAlta" required>
        </div>
        <div class="mb-3">
            <label for="fechaBaja">Fecha de baja (Hasta):</label>
            <input type="date" class="form-control" id="fechaBaja" name="fechaBaja" required>
        </div>
        <?php
        foreach($publicidad as $fila){
        
            echo '
              <div class="col-md-4 mb-3">
                <div class="card">
                  <img src="img/sponsors/'.$fila['fotoPublicidad'].'" class="card-img-top imagen-servicios">
                  <div class="card-body">
                    <h5 class="card-title">'.ucfirst($fila['nombrePublicidad']).'</h5>
                    <p class="card-text"><i>'.$fila['contacto'].'</i></p>
                </div>
                    ';
                
        }?>
    <button type="submit" onclick="validar()">Enviar</button>
        </form>
    </div>
</section>

<script>
    function validar() {
  // Obtener nombre de archivo
  let archivo = document.getElementById('imgPerfil').value,
  // Obtener extensión del archivo
      extension = archivo.substring(archivo.lastIndexOf('.'),archivo.length);
      var tam= document.archivo.files[0].size;
      switch (extension) {
        case '.jpg':
           
            alert(tam) ;
        break;
            
        case '.png':
            alert('ES PNG') ;
            break;
        case '.jpeg':
            alert('ES JPEG') ;
            break;
        
        default:
            alert ('ERROR INVALIDO');
            break;
    }
 
      alert(extension);
 
}
    
   
</script>