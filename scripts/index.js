

window.onload = function(){
anims();
sendForm();
go_to();

    let cat_prom = document.getElementById('prom'); 
    let cat_pishevoe = document.getElementById('pishevoe');



    cat_pishevoe.onclick = function(){

        window.open('../pages/pishevoe.html','_self',false);
 
     }

    cat_prom.onclick = function(){

       window.open('../pages/texnolog.html','_self',false);

    }

    document.getElementsByTagName("body")[0].style.overflow = "scroll";


};

function anims(){
cat = document.querySelectorAll(".pos");
best_products = document.querySelectorAll(".card");

cat.forEach(element => {
        
    element.addEventListener('mouseover', function(event) {
element.style.transform = "scale(0.94, 0.94)";
element.style.backgroundColor = "#e0e0e0";
    });


    element.addEventListener('mouseout', function(event) {
        element.style.transform = "scale(1,1)";
        element.style.backgroundColor = "#ffffff";
            });
});

best_products.forEach(element => {
        
    element.addEventListener('mouseover', function(event) {
element.style.transform = "scale(0.98, 0.98)";
//element.style.backgroundColor = "#e0e0e0";
element.childNodes[3].style.backgroundColor = "#8d0002"
    });


    element.addEventListener('mouseout', function(event) {
        element.style.transform = "scale(1,1)";
       // element.style.backgroundColor = "#ffffff";
        element.childNodes[3].style.backgroundColor = "#3fa480"
            });
});


};
      

function sendForm() {
    document.querySelector('#form').addEventListener('submit', async function(event) {
        event.preventDefault();

        const formData = Object.fromEntries(new FormData(event.target).entries());
        const {message, mail, phone, name} = formData;
        const body = `name=${name}&mail=${mail}&phone=${phone}&message=${message}`;

        url = '/php/mail.php';
        options = {
            method : 'POST',
            body,
            headers: {
                "Content-type": "application/x-www-form-urlencoded; charset=UTF-8"
            }
        };

        const response = await fetch(url, options);
        const status = await response.text();

        if (+status === 1) {
            alert('Заявка успешно отправлена!');
            document.querySelectorAll('.input').forEach(input => input.value = '');
            document.querySelector('textarea').value = '';
        }
        else alert('Произошла ошибка, пожалуйста попробуйте позже');
    });
};

window.addEventListener('scroll',(event) => {
    var cat = document.querySelectorAll('.cat');
    var best_products = document.querySelectorAll('.card');

    var y = scrollY;
    cof = 0;

    cof = 0.002 * y + cof;

    if(cof > 1){
        cof = 1;
    }
    
cat.forEach(element => {

    
    

    if (y<200) { element.style.opacity = "0"
}
    else {  
        element.style.opacity =  cof.toString();
    console.log(cof.toString())
    };

});


best_products.forEach(element => {
    
    if (y<550) { element.style.opacity = "0" ;
    element.style.transform = "scale(0.5, 0.5)" ;
}
    else {  element.style.opacity = "1";
    element.style.transform = "scale(1, 1)" ;
};

});

   
    });

    function go_to(){
        products = document.querySelectorAll(".card");
    
        products.forEach(card => {
            
         card.addEventListener('click', function(event) {
    
    var name = card.childNodes[3].childNodes[1].textContent;
    
    console.log(name);
    //console.log("сушка/рассев");
    
    
    //send("name");
    
    if(name === "реактор"){
        console.log(name);
        window.open('/pages/products/texnolog/reakt.html','_self',false);
    }
    
    if(name === "вибросита"){
        window.open('/pages/products/texnolog/vibro.html','_self',false);
    }
    
    if(name === "пилорама"){
        window.open('/pages/products/texnolog/derevo.html','_self',false);
    }
    
    if(name === "ёмкости"){
        window.open('/pages/products/pishevoe/emkost.html','_self',false);
    }
    
    

            });
        });
    }