const likeBtn = document.querySelector(".like_btn");
let icon = document.querySelector("#icon");



let clicked = false;





$(document).ready(function(){
    
    let idServicio = $('#idServicio').val();
    $.ajax({
        
        url: "../ajax/verificacionLike.php",
        type: "POST",
        data:{'idServicio' : idServicio},
        success: function(data) {
            
            if(data == 'T'){
                icon.innerHTML = `<i class="fa-solid fa-thumbs-up"></i>`;
            }else if(data == 'F'){
                icon.innerHTML = `<i class="fa-solid fa-thumbs-down"></i>`;
            }
        },
        error: function(e) {
            //Fallo al buscar datos
            console.log('Fallo carga de datos'); 
            console.log(e); 
        }
    })  
console.log('jquery funcionando');

likeBtn.addEventListener("click", (e) => {
   
    let idServicio = $('#idServicio').val();
    let count = $('#count').text();
    console.log(count);
    
    $.ajax({
        
        url: "../ajax/controladorLike.php",
        type: "POST",
        data:{'idServicio' : idServicio},
        success: function(data) {
            console.log(data);
            if(data == 'T'){
                
                
                icon.innerHTML = `<i class="fa-solid fa-thumbs-up"></i>`;
                count++;
                console.log(count);
                $('#count').text(count);
            }else if(data == 'F'){
                
                icon.innerHTML = `<i class="fa-solid fa-thumbs-down"></i>`;
                count--;
                console.log(count);
                $('#count').text(count);
            }
        },
        error: function(e) {
            //Fallo al buscar datos
            console.log('Fallo carga de datos'); 
            console.log(e); 
        }
    }) 




    // if(!clicked){
    //     clicked = true;
    //     icon.innerHTML = `<i class="fas fa-thumbs-up"></i>`;
    //     count.textContent++;
        
    //     sendRequest(count.textContent,idServicio);
    // }else{
    //     clicked = false;
    //     icon.innerHTML = `<i class="far fa-thumbs-up"></i>`;
    //     count.textContent--;
        
    //     sendRequest(count.textContent, idServicio);
        
    // }
    
    

})



});





function sendRequest(bandera,idServicio) {


    var theObjetct = new XMLHttpRequest();
    theObjetct.open('GET','../ajax/controladorLike.php?like='+bandera+'&idServicio='+idServicio+'',true);
    theObjetct.setRequestHeader('Content-Type', 'aplication/x-ww-form-urlencoded');
    theObjetct.onreadystatechange = function () {
        console.log(theObjetct.responseText);
    }
    theObjetct.send();
}
