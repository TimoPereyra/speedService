let btnSiguiente = document.querySelector('#btnSiguiente');
let btnEnviar = document.querySelector('#btnEnviar');



btnSiguiente.addEventListener('click', (e) => {
    e.preventDefault();
    
        let formularioRegistroFletes = document.querySelector('#formRegistroFletes');
        let arrayInputs = formularioRegistroFletes.querySelectorAll('input');
        let arrayErrores = formularioRegistroFletes.querySelectorAll('.msj-error');
        var pat=/^[A-ZÑ]{3}\d{3}$/;
        console.log(arrayInputs);
        arrayErrores.forEach(element => {
            element.style.display = "none";
        });
        arrayInputs.forEach(element => {
            element.style.border = '1px solid #ced4da';
        });
        let banderaForm = true;

        if(arrayInputs[0].value.length <= 5){
            arrayInputs[0].style.border = "3px solid red";
           
            banderaForm = false;  
        }
        if(arrayInputs[1].value == ""){
            arrayInputs[1].style.border = "3px solid red";
            
            banderaForm = false;
        
            }
        if(arrayInputs[2].value >2000){
            arrayInputs[2].style.border = "3px solid red";
            
            banderaForm = false;
        
            }
        if(banderaForm == true)
           {
                let datosServicio = document.querySelector('#datosServicio');
                let datosVehiculo = document.querySelector('#datosVehiculo');

                datosServicio.classList.toggle('opacity-0');
                
                
                setTimeout(() => {
                    datosServicio.classList.toggle('d-none');
                },"300")

                setTimeout(() => {
                    datosVehiculo.classList.toggle('d-none');
                },"470")
                
                setTimeout(() => {
                    datosVehiculo.classList.toggle('opacity-0');
                    datosVehiculo.classList.toggle('opacity-100');
                    e.target.remove();
                    btnEnviar.classList.toggle('d-none'); 
                },"500") 
                btnEnviar.addEventListener('click', (e) => {
                    if(arrayInputs[3].value != pat){
                        arrayInputs[3].style.border = "3px solid red";
                            
                        banderaForm = false;
                        
                    }
                    if(arrayInputs[4].value == ""){
                            arrayInputs[4].style.border = "3px solid red";
                            
                            banderaForm = false;
                        
                    }
                    if(arrayInputs[5].value == ""){
                            arrayInputs[5].style.border = "3px solid red";
                            
                            banderaForm = false;
                        
                    }
                    if(arrayInputs[6].value == ""){
                            arrayInputs[6].style.border = "3px solid red";
                            
                            banderaForm = false;
                        
                    }
                    if(banderaForm){
                        formularioRegistroFletes.submit();
                    }
                });
            }            
            

        

});