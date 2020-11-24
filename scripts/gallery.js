window.onload = function (){

picker();




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