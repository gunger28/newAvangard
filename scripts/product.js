window.onload = function () {
  anims();
  animate();
  redirect();
  sendForm();
setStart();
info_btns();

};

var haract_text;
var dop_text;
var osob_text;

function info_btns(){

  haract = document.getElementById('haract');
  dop = document.getElementById('dop');
  osob = document.getElementById('osob');

  desc = document.getElementById("desc");

  haract.addEventListener("click", function (event) {

    console.log(haract_text);
     desc.textContent = haract_text;

     haract.style.backgroundColor = "#d12d2d" ;
    dop.style.backgroundColor = "#df5d5d" ;
    osob.style.backgroundColor = "#df5d5d" ;
   
  });

  dop.addEventListener("click", function (event) {

    console.log(dop_text);
     desc.textContent = dop_text;

      haract.style.backgroundColor = "#df5d5d" ;
    dop.style.backgroundColor = "#d12d2d" ;
    osob.style.backgroundColor = "#df5d5d" ;
  
   
  });

  osob.addEventListener("click", function (event) {

    console.log(osob_text);
     desc.textContent = osob_text;
  
   haract.style.backgroundColor = "#df5d5d" ;
   dop.style.backgroundColor = "#df5d5d" ;
   osob.style.backgroundColor = "#d12d2d" ;
  });


}

function anims() {

  best_products = document.querySelectorAll(".card");

  best_products.forEach((element) => {
    element.addEventListener("mouseover", function (event) {
      element.style.transform = "scale(0.98, 0.98)";
    });

    element.addEventListener("mouseout", function (event) {
      element.style.transform = "scale(1,1)";
    });
  });
}

function animate() {
  var best_products = document.querySelectorAll(".card");
  best_products.forEach((element) => {
    element.style.opacity = "0";
    element.style.transform = "scale(0.5, 0.5)";

    element.style.opacity = "1";
    element.style.transform = "scale(1, 1)";
  });
}

function redirect() {
  products = document.querySelectorAll(".card");
 

  products.forEach((card) => {
    card.addEventListener("click", function (event) {

        title = document.getElementById('title');
      size = document.getElementById('size');
        mass = document.getElementById("mass");
        impact = document.getElementById("impact");
        moshnost = document.getElementById("moshnost");
        desc = document.getElementById("desc");
        photo = document.getElementById("photo");

        haract_text = card.childNodes[3].textContent;
        dop_text = card.dataset.dop;
        osob_text = card.dataset.osob;
       

        title.textContent = card.childNodes[1].textContent;
       size.textContent = card.dataset.size;
       mass.textContent = card.dataset.mass;
       impact.textContent = card.dataset.impact;
       moshnost.textContent = card.dataset.moshnost;
       desc.textContent = card.childNodes[3].textContent;
photo.style.backgroundImage = card.childNodes[1].style.backgroundImage;

       console.log(card.childNodes[1].style.backgroundImage);
    
    });
  });
}


function setStart(){
    products = document.querySelectorAll(".card");

    title = document.getElementById('title');
    size = document.getElementById('size');
      mass = document.getElementById("mass");
      impact = document.getElementById("impact");
      moshnost = document.getElementById("moshnost");
      desc = document.getElementById("desc");
      photo = document.getElementById("photo");

if (products[0] != null) {
    card = products[0];

 
    haract_text = card.childNodes[3].textContent;
    dop_text = card.dataset.dop;
    osob_text = card.dataset.osob;

      title.textContent = card.childNodes[1].textContent;
     size.textContent = card.dataset.size;
     mass.textContent = card.dataset.mass;
     impact.textContent = card.dataset.impact;
     moshnost.textContent = card.dataset.moshnost;
     desc.textContent = card.childNodes[3].textContent;
photo.style.backgroundImage = card.childNodes[1].style.backgroundImage;
} else{



}
   


   


}



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