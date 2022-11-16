<?php 
session_start();
include_once '../includes/conexion.php';

$stmt = $conexion->prepare("SELECT verificacion FROM likes
WHERE idUsuarioOrigen = :idUsuario AND idUsuarioDestino = :idServicio ");
$stmt->execute(array(':idUsuario' => $_SESSION['idUsuario'] , ':idServicio' => $_POST['idServicio']));
$verificacionLike = $stmt->fetchAll();

$stmt = $conexion->prepare("SELECT likes FROM servicios
WHERE idServicio = :idServicio");
$stmt->execute(array(':idServicio' => $_POST['idServicio']));
$cantidadLike = $stmt->fetchAll();
$cantidadLike = $cantidadLike[0]['likes'];

#SI LA CONSULTA VERIFICACIONLIKE NO ME TRAE NADA HAGO EL INSERT EN TRUE
if(empty($verificacionLike)){
    $cantidadLike =+ 1;
    
    $stmt = $conexion->prepare("INSERT INTO likes(idUsuarioOrigen, idUsuarioDestino, verificacion) VALUES ( :idUsuario,:idServicio,'T')");
    $stmt->execute(array(':idUsuario' => $_SESSION['idUsuario'], ':idServicio' => $_POST['idServicio']));
    // $like = $stmt->fetchAll();

    $stmt = $conexion->prepare("UPDATE servicios SET likes = :likes WHERE idServicio = :idServicio");
    $stmt->execute(array(':likes' => $cantidadLike, ':idServicio' => $_POST['idServicio']));
}else{
    
    #SI LA CONSULTA VERIFICACIONLIKE ME TRAE DATOS HAGO EL UPDATE
    #SI ESTA TRUE LO PONGO EN FALSE Y LE RESTO UNO DE LO CONTRARIO LO PONGO EN TRUE Y LE SUMO UNO
    if($verificacionLike[0]['verificacion'] == 'T'){
        
        $cantidadLike -= 1;
       
        $stmt = $conexion->prepare("UPDATE likes SET verificacion = 'F' 
        WHERE idUsuarioOrigen = :idUsuario AND idUsuarioDestino = :idServicio");
        $stmt->execute(array(':idUsuario' => $_SESSION['idUsuario'] , ':idServicio' => $_POST['idServicio']));

        
        $stmt = $conexion->prepare("UPDATE servicios SET likes = :likes WHERE idServicio = :idServicio");
        $stmt->execute(array(':likes' => $cantidadLike, ':idServicio' => $_POST['idServicio']));
    }else{
        
        $cantidadLike += 1;
        
        $stmt = $conexion->prepare("UPDATE likes SET verificacion = 'T' 
        WHERE idUsuarioOrigen = :idUsuario AND idUsuarioDestino = :idServicio");
        $stmt->execute(array(':idUsuario' => $_SESSION['idUsuario'] , ':idServicio' => $_POST['idServicio']));

        $stmt = $conexion->prepare("UPDATE servicios SET likes = :likes WHERE idServicio = :idServicio");
        $stmt->execute(array(':likes' => $cantidadLike, ':idServicio' => $_POST['idServicio']));

    }

}


$stmt = $conexion->prepare("SELECT verificacion FROM likes
WHERE idUsuarioOrigen = :idUsuario AND idUsuarioDestino = :idServicio ");
$stmt->execute(array(':idUsuario' => $_SESSION['idUsuario'] , ':idServicio' => $_POST['idServicio']));
$verificacionLike = $stmt->fetchAll();
print $verificacionLike[0]['verificacion'];