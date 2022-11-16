<?php 
session_start();

include_once '../includes/conexion.php';

$stmt = $conexion->prepare("SELECT verificacion FROM likes
    WHERE idUsuarioOrigen = :idUsuario AND idUsuarioDestino = :idServicio");
    $stmt->execute(array(':idUsuario' => $_SESSION['idUsuario'], ':idServicio' => $_POST['idServicio']));
    $resultado = $stmt->fetchAll();
    $resultado = $resultado[0]['verificacion'];
    print$resultado;


?>