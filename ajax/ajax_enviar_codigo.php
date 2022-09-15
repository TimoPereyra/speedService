<?php
session_start();
include_once '../libs/enviar_correo.php';
$env =  sendemail($_POST['codigo'],$_POST['correo']);
if($env == 'Tu mensaje ha sido enviado!'){
    $_SESSION['codigo'] = $_POST['codigo'];
    echo $env;
}else{
    echo $env;
}
//print_r($_POST['codigo']);
?>