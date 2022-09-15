let formularioRegistro = document.querySelector('#formRegistro');



formularioRegistro.addEventListener('submit',(e) => {
    e.preventDefault();
    let arrayInputs = formularioRegistro.querySelectorAll('input');
    let arrayErrores = formularioRegistro.querySelectorAll('.msj-error');
    arrayErrores.forEach(element => {
        element.style.display = "none";
    });
    arrayInputs.forEach(element => {
        element.style.border = '1px solid #ced4da';
    });

    let banderaForm = true;

    if(arrayInputs[0].value.length <= 5){
        arrayInputs[0].style.border = "1px solid red";
        arrayInputs[0].nextElementSibling.style.display = "block";
        banderaForm = false;
    }

    if(arrayInputs[1].value == ""){
        arrayInputs[1].style.border = "1px solid red";
        arrayInputs[1].nextElementSibling.style.display = "block";
        banderaForm = false;
    }



    if(banderaForm){
        formularioRegistro.submit();
    }

    

});

/***************************************/
/******** VALIDACION DEL CORREO *******/

function validacionCorreo(){
    var codigo = rand_code('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ',6),
    correo = document.getElementById('correoProveedor').value;

    if(correo == ''){
        alert('Tiene que completar el correo que va a ser enviado el codigo.');
        return false;
    }
    console.log(codigo+' Y CORREO '+correo);
    var param = {'correo' : correo,
                'codigo' : codigo}
    console.log(param);
    $.ajax({
        url: '../ajax/ajax_enviar_codigo.php',
        type: 'POST',
        data: param,
        beforeSend: function (){
        },
        success: function(data){
            console.log(data);
            alert(data);
        },
        error: function(){
        }
    })
}

  // FUNCION PARA ARMAR UN CODIGO RANDOM  
function rand_code(chars, lon){
    code = "";
    for (x=0; x < lon; x++){
    rand = Math.floor(Math.random()*chars.length);
    code += chars.substr(rand, 1);
    }
    return code;
}