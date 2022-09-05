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