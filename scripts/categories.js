

window.onload = function(){
anims();
animate();
redirect();



    



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
    

  

    function animate(){
        var best_products = document.querySelectorAll('.card');
        best_products.forEach(element => {
    
            element.style.opacity = "0" ;
          element.style.transform = "scale(0.5, 0.5)" ;
        
           element.style.opacity = "1";
            element.style.transform = "scale(1, 1)" ;
        
        
        });
        

    }


    

function redirect(){
    products = document.querySelectorAll(".card");

    products.forEach(card => {
        
     card.addEventListener('click', function(event) {

var name = card.childNodes[3].textContent ;
console.log(name);


//send("name");

if(name = "сушка/рассев"){
    window.open('/pages/sushka.html','_self',false);
}





        });
    });
}

 async function send(name_page) {
    
    var name = encodeURIComponent('Hello, server!');
   indow.location.href = '/pages/category.php?name'+name;

   // window.location.href = '/pages/category.php?name' + name_page;
  
     window.open('/pages/sushka.html','_self',false);
};