<input type="hidden" name="idServicio" value="<?php echo (isset($idServicio)) ? $idServicio : '' ?>">
<input type="hidden" name="idServicio" value="<?php echo (isset($idServicio)) ? $idServicio : '' ?>">
    <input type="hidden" name="precioServicio" value="<?php echo (isset($precioServicio)) ? $precioServicio : '' ?>">
    <input type="hidden" name="idProveedor" value="<?php echo (isset($idProveedor)) ? $idProveedor : '' ?>">

    <div>
        <label for="" class="text-dark">Fecha </label>
        <input type="date" class="form-control" name="fecha">
    </div>
    <div>
        <label for="" class="text-dark">Hora </label>
        <input type="text" class="form-control" name="hora">
    </div>
    <div>
        <label for="" class="text-dark">Descripción </label>
        <textarea id="" cols="30" rows="10" class="form-control" name="descripcion"></textarea>
    </div>
               
    <div class="text-center p-3">   
        <button type="submit" class="btn boton-servicios"> Solicitar servicio </button>
    </div>