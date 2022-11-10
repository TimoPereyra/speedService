
<?php 

$pagina = 'factura-proveedor';
require_once('../includes/config.php');
require_once('../includes/conexion.php');
$ahora = new DateTime(date("Y-m-d"));


 
$stmt = $conexion->prepare("SELECT usuarios.nombreCompleto,servicios.idServicio, solicitud_servicio.idSolicitud, solicitud_servicio.fecha, notificaciones.descripcion, solicitud_servicio.hora, servicios.nombreServicio, solicitud_servicio.precioServicio FROM solicitud_servicio
 INNER JOIN usuarios ON usuarios.idUsuario = idCliente 
 INNER JOIN servicios ON servicios.idServicio = solicitud_servicio.idServicio 
 INNER JOIN notificaciones ON notificaciones.idSolicitud = solicitud_servicio.idSolicitud 
 WHERE solicitud_servicio.idSolicitud = :idSolicitud AND notificaciones.visto = 2;");
$stmt->execute(array(':idSolicitud' => $_GET['idSolicitud']));

$factura = $stmt->fetchAll();

$originalDate = $factura[0]['fecha'];
$newDate = date("d-m-Y", strtotime($originalDate));

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Factura de SpeedService</title>
    <link rel="stylesheet" href="../css/facturaStyle.css">
</head>

<body>
    <div class="control-bar">
    <div class="container">
        <div class="row">
        <div class="col-2-4">
            <div class="slogan">Facturación </div>         
        </div>
        <div class="col-4 text-right">
            <a href="javascript:window.print()">Imprimir</a>
        </div>
        </div>
    </div>
    </div>

    <header class="row">

    <div class="encabezadoFactura">

        <div class="logoholder text-center" >
                <img src="../img/LOGO5.jpg">
            </div>

            <div class="info">
                <p >
                Web: <a href="http://www.speedservice.com.ar">www.speedservice.com.ar</a><br>
                
                Correo: <a href="mailto:speedservicetym@gmail.com">speedservicetym@gmail.com</a><br>
                </p>
            </div>
    </div>
   

    </header>


<div class="row section">
        <div class="col-2">
            <h1 >FACTURA</h1>
        </div>

    <div class="col-2 text-right details">
        <p >
        <b>Fecha:</b> <p><?php echo $ahora->format("d-m-Y"); ?></p><br>
        <b>Factura N°:</b> <p> <?php echo time(); ?></p><br>
        </p>
    </div>
    
    <div class="col-2">
        <p class="client">
        <b>Facturar a:</b>
        <?php echo $factura[0]['nombreCompleto']; ?><br>
        <br>
        <b>De: </b><a href="www.speedservice.com.ar">SpeedService</a><br>
        </p>
    </div>

</div>

<div class="row section" style="margin-top:-1rem">
    <div class="col-1">
        <table style='width:100%'>
        <thead>
        <tr class="invoice_detail">
            <th width="25%">N° de orden</th>
            <th width="30%">Modo de pago</th>
        </tr> 
        </thead>
        <tbody>
        <tr class="invoice_detail">
            <td width="25%"><?php echo $factura[0]['idServicio']; ?> </td>
            <td width="30%">Contado</td>
        </tr>
        </tbody>
        </table>
    </div>
</div>

<div class="invoicelist-body">
    <table>
        <thead>
            <th width="25%">N° solicitud</th>
            <th width="20%">Fecha</th>
            <th width="30%">Descripción</th>
            <th width="20%">Hora</th>
            <th class="">Servicio</th>
            <th width="15%">Precio</th>
        </thead>
        <tbody>
        <tr>
            <td width='5%'><?php echo $factura[0]['idSolicitud']; ?></td>
            <td width='30%'><?php echo $newDate ?></td>
            <td width='30%'><?php echo $factura[0]['descripcion']; ?></td>
            <td width='30%'><?php echo $factura[0]['hora']; ?></td>
            <td class=""> <?php echo $factura[0]['nombreServicio']; ?></td>
            <td class="rate"><?php echo $factura[0]['precioServicio']; ?></td>
        </tr>
        </tbody>
    </table>
</div>

<div class="invoicelist-footer">
    <table>
        <tr>
        <td><b>Total: </b></td>
        <td class="totalFactura" id="total_price"> <?php echo $factura[0]['precioServicio']; ?></td>
        </tr>
    </table>
    </div>

<footer class="row">
    <div class="col-1 text-center">
        <p class="notaxrelated">Copyright © 2022. Todos los derechos reservados.</p>
    </div>
</footer>

</body>
</html>


