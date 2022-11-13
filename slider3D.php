<?php

/* CSS DE ESTE SLIDER
.carousel{
    box-sizing: border-box;
}
.carouselAll{
    width: 210px;
    margin: auto;
    perspective: 800px;
    position: relative;
    margin-top: 50px;
}
.carouselItem{
    width: 100%;
    position: absolute;
    animation: rotar 10s infinite linear;
    transform-style: preserve-3d;
}
.carouselItem:hover{
    animation-play-state: paused;
    cursor: pointer;
}
.carouselItem figure{
    width: 100%;
    height: 110px;
    overflow: hidden;
    position: absolute;
    box-shadow: 0px 0px 10px 0px rgba(128, 128, 128, 0.767);
    transition: all 300ms;
}
.carouselItem figure:hover{
    box-shadow: 0px 0px 0px 0px rgba(128, 128, 128, 0.767);
    transition: all 300ms;
}

.carouselItem figure:nth-child(1){transform: rotateY(0deg) translateZ(190px);}
.carouselItem figure:nth-child(2){transform: rotateY(60deg) translateZ(190px);}
.carouselItem figure:nth-child(3){transform: rotateY(120deg) translateZ(190px);}
.carouselItem figure:nth-child(4){transform: rotateY(180deg) translateZ(190px);}
.carouselItem figure:nth-child(5){transform: rotateY(240deg) translateZ(190px);}
.carouselItem figure:nth-child(6){transform: rotateY(300deg) translateZ(190px);}
.carouselItem figure:nth-child(7){transform: rotateY(360deg) translateZ(190px);}

.carouselItem img{
    width: 100%;
    transition: all 300ms;
}
.carouselItem img:hover{
   transform: scale(1.2);
   transition: all 300ms;
}
.carouselItem .info{
    width: 270px;
    height: 150px;
    background-color: #b30039;
}
.carousel h2{
    color: #ff0050;
    margin-top: 80px;
}

/* para controlar la animación de cada item */
/*@keyframes rotar {
    from{
        transform: rotateY(0deg);
    }to{
        transform: rotateY(360deg);
    }
}
*/

session_start();

$pagina = 'carousel';
require_once('includes/config.php');
require_once('includes/conexion.php');

/* LISTAR PUBLICIDAD */ 
$stmt = $conexion->prepare("SELECT * FROM publicidad WHERE 1");
$stmt->execute();
$publicidad = $stmt->fetchAll();

require_once('includes/header.php');

/**<div class="">
        <h5 class="">'.ucfirst($fila['nombrePublicidad']).'</h5>
        <p class="">'.$fila['contacto'].'</p>
    </div>/ */
?>

<body class="carousel">
    <br><br><br><br><br>
    <h2 class="text-center mb-4">Publicitá aquí</h2>
    <div class="carouselAll">
        <div class="carouselItem">
        <?php
            foreach($publicidad as $fila){
                echo '
                    <figure><img src="img/sponsors/'.$fila['fotoPublicidad'].'" class=""></figure>';  
        }?>  
        </div>      
    </div>
</body>