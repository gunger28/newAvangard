window.onload = function (){

picker();
change_cont();



}

function change_cont(){

    phone = document.querySelectorAll(".desc")[1];
  phone.textContent = "8 913 007 61 93"
   // console.log(phone);
  }

function picker(){

photos = document.querySelectorAll('.photo');
viewer = document.getElementById('photo');

photos.forEach(photo => {
    
    photo.addEventListener("click", function (event) {

        viewer.style.backgroundImage = photo.style.backgroundImage;

    });

});



}