<?php
$pagina = 'registrarServicio';
require_once('../includes/config.php');
require_once('../includes/conexion.php');
require_once('../includes/header.php');

/* LISTAR CATEGORIAS  */
$stmt = $conexion->prepare("SELECT * FROM categorias");
$stmt->execute();

$categorias = $stmt->fetchAll();

/* PROCESAR FORMULARIO */

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $nombreCompleto = $_POST['nombreCliente'];
    $correoCliente = $_POST['correoCliente'];
    $telefonoCliente = $_POST['telefonoCliente'];
    $dniCliente = $_POST['dniCliente'];
    $direccionCliente = $_POST['direccionCliente'];
    $fechaNacimiento = $_POST['fechaNacimiento'];
    $pass = $_POST['pass'];
    $passConfirm = $_POST['passConfirm'];
    $img = $_FILES['imgPerfil']['name'];
    $imgTmpName = $_FILES['imgPerfil']['tmp_name'];
    $maxEdad = 95;
    $minEdad = 16;
        
        function obtener_edad_segun_fecha($fechaNacimiento)
        {
            $nacimiento = new DateTime($fechaNacimiento);
            $ahora = new DateTime(date("Y-m-d"));
            $diferencia = $ahora->diff($nacimiento);
            return $diferencia->format("%y");
        }
        function validarTelefono($telefonoCliente){
            $reg = "#^[\s\.-]?\d{4}[\s\.-]?\d{6}$#";
            return preg_match($reg, $telefonoCliente);
        }

    if(empty($nombreCompleto) || empty($correoCliente) || empty($telefonoCliente) || empty($dniCliente) || empty($direccionCliente) || empty($fechaNacimiento) || empty($img) || empty($pass)){
        $notificacion = "Error: no puede dejar campos vacios.";
    }else if(strlen($nombreCompleto) <= 5){
        $notificacion = "Error: El nombre debe contener almenos 6 caracteres.";
    }else if($pass != $passConfirm){
        $notificacion = "Error: Las contraseñas deben coincidir.";
    }else if (obtener_edad_segun_fecha($fechaNacimiento) < $minEdad || obtener_edad_segun_fecha($fechaNacimiento) > $maxEdad ){
        $notificacion = "Error: La edad ingresada no es correcta.";
    }else if(filter_var($correoCliente, FILTER_VALIDATE_EMAIL) === false ){
        $notificacion = "Error: El correo ingresado no es correcto.";
    }else if(validarTelefono($telefonoCliente) != true ){
        $notificacion = "Error: El teléfono ingresado no es correcto.";

    }else{
        /* LISTAR USUARIO POR CORREO  */

        $stmt = $conexion->prepare("SELECT * FROM usuarios WHERE correo = :correo");
        $stmt->execute(array(':correo' => $correoCliente));

        if($stmt->rowCount() > 0){
            $notificacion = "Error: El correo ya está registrado.";
        }else{
            /* LISTAR USUARIO POR CORREO  */
            
            $stmt = $conexion->prepare("INSERT INTO usuarios(imgUsuario, nombreCompleto, correo, password, telefono, dni, direccion, fechaNacimiento, idRol) VALUES (:imgUsuario,:nombre,:correo,:password,:telefono,:dni,:direccion,:fecha,1)");
            $passHash = password_hash($_POST['pass'], PASSWORD_BCRYPT);
            $resultado = $stmt->execute(array(':imgUsuario' => $img, ':nombre' => $nombreCompleto, ':correo' => $correoCliente,':password' => $passHash,':telefono'=> $telefonoCliente, ':dni' => $dniCliente, ':direccion' => $direccionCliente, ':fecha' => $fechaNacimiento));

            if($resultado){
                $notificacionExito = "Éxito: se ha registrado correctamente.";
            }
        }
    }

}

?>

<main class="registrar-servicio">

    <seccion class="formulario py-5">
        <div class="container">
            <div class="row">

                <div class="col-md-5">
                    <h1><b>Formá parte de la nueva app de servicios de la Ciudad de Chivilcoy</b></h1>
                    <p><br>Registrá tu servicio, cumplí con nuestros requisitos y ganá dinero. Aplica únicamente para aquellos que completen el proceso de registro exitosamente.</p>
                </div>

                <div class="offset-md-1 col-md-6">

                <form action="registro.php" method="POST" enctype="multipart/form-data">

                    <div class="mb-3">
                        <label for="nombreProveedor">Nombre y Apellido:</label>
                        <input type="text" class="form-control" id="nombreProveedor" name="nombreCliente" required>
                    </div>
                    <div class="mb-3">
                        <label for="imgPerfil">Imagen de perfil:</label>
                        <input type="file" class="form-control" id="imgPerfil" name="imgPerfil" required>
                    </div>
                    <div class="mb-3">
                        <label for="correoProveedor">Correo electrónico:</label>
                        <input type="email" class="form-control" id="correoProveedor" name="correoCliente" required>
                    </div>
                    <div class="mb-3">
                        <label for="telefonoProveedor">Teléfono (Ej. 2346-xxxxxx):</label>
                        <input type="text" class="form-control" id="telefonoProveedor" name="telefonoCliente" required>
                    </div>
                    <div class="mb-3">
                        <label for="dniCliente">DNI (sin puntos):</label>
                        <input type="number" class="form-control" id="dniCliente" name="dniCliente" required>
                    </div>
                    <div class="mb-3">
                        <label for="telefonoProveedor">Dirección:</label>
                        <input type="text" class="form-control" id="telefonoProveedor" name="direccionCliente" required>
                    </div>
                    <div class="mb-3">
                    <label for="fechaNacimiento">Fecha de nacimiento:</label>
                        <input type="date" class="form-control" id="fechaNacimiento" name="fechaNacimiento" required>
                    </div>
                    <div class="mb-3">
                    <label for="pass">Contraseña:</label>
                        <input type="password" class="form-control" id="pass" name="pass" required>
                    </div>
                    <div class="mb-3">
                    <label for="passConfirm">Repita su contraseña:</label>
                        <input type="password" class="form-control" id="passConfirm" name="passConfirm" required>
                    </div>
                    <div class="mb-3">
                        <label for="servicioProveedor">Tipo de servicio:</label>
                        <select name="tipoServicio" id="servicioProveedor" class="form-select">
                            <?php 
                              foreach($categorias as $fila){
                                echo '<option value="'.$fila['idCategoria'].'">'.ucfirst($fila['categoria']).'</option>';
                              }
                            ?>
                        </select>
                    </div>
                    <?php 
                        if(isset($notificacion)){
                            echo '<p class="bg-danger text-white text-center">'.$notificacion.'</p>';
                        }                    
                    ?>
                    <button type="submit" class="btn d-grid gap-2 col-6 mx-auto boton-servicio">Enviar solicitud</button>

                </form>

                </div>
            </div>
        </div>
    </seccion>

</main>

<?php
  require_once('../includes/footer.php');
?>