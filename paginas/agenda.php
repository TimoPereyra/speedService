<?php
session_start();
if(!isset($_SESSION['idRol'])){
    header('Location:../index.php');
}
$pagina = 'agenda';
require_once('../includes/config.php');
require_once('../includes/conexion.php');

require_once('../includes/header.php');
?>
<body>
    <section class="agenda">
        <div class="container bg-white">

            <div class="row p-5">
                <div class="col-md-2">

                </div>
                <div class="col-md-8" id="agenda">
                    
                </div>
                <div class="col-md-2">
                    
                </div>
            </div>
        </div>
        
    </section> 
    <script src='../js/agenda.js'></script>
</body>


<?php
  require_once('../includes/footer.php');
?>