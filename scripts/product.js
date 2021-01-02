window.onload = function () {
  photo = document.getElementById("photo");
  haract = document.getElementById("haract");
  dop = document.getElementById("dop");
  osob = document.getElementById("osob");
  haract.style.backgroundColor = "#d12d2d";
  haract.style.backgroundImage = "url(/assets/ico/tech2.png)";
  dop.style.backgroundImage = "url(/assets/ico/tech1.png)";
  osob.style.backgroundImage = "url(/assets/ico/tech3.png)";

  haract.textContent = "";
  dop.textContent = "";
  osob.textContent = "";

  photo.style.backgroundImage = "url()";

  anims();
  animate();
  redirect();
  //sendForm();
  setStart();
  info_btns();
  sendForm_test();
  change_cont();
};

var haract_text;
var dop_text;
var osob_text;

function info_btns() {
  desc = document.getElementById("desc");

  haract.addEventListener("click", function (event) {
    console.log(haract_text);
    desc.textContent = haract_text;

    haract.style.backgroundColor = "#d12d2d";
    dop.style.backgroundColor = "#df5d5d";
    osob.style.backgroundColor = "#df5d5d";
  });

  dop.addEventListener("click", function (event) {
    console.log(dop_text);
    desc.textContent = dop_text;

    haract.style.backgroundColor = "#df5d5d";
    dop.style.backgroundColor = "#d12d2d";
    osob.style.backgroundColor = "#df5d5d";
  });

  osob.addEventListener("click", function (event) {
    console.log(osob_text);
    desc.textContent = osob_text;

    haract.style.backgroundColor = "#df5d5d";
    dop.style.backgroundColor = "#df5d5d";
    osob.style.backgroundColor = "#d12d2d";
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
      title = document.getElementById("title");
      size = document.getElementById("size");
      mass = document.getElementById("mass");
      impact = document.getElementById("impact");
      moshnost = document.getElementById("moshnost");
      desc = document.getElementById("desc");
      photo = document.getElementById("photo");

      text_anim();

      haract_text = card.childNodes[3].textContent;
      dop_text = card.dataset.dop;
      osob_text = card.dataset.osob;

      setTimeout(function () {
        title.textContent = card.childNodes[1].textContent;
        size.textContent = card.dataset.size;
        mass.textContent = card.dataset.mass;
        impact.textContent = card.dataset.impact;
        moshnost.textContent = card.dataset.moshnost;
        desc.textContent = card.childNodes[3].textContent;
        photo.style.backgroundImage = card.childNodes[1].style.backgroundImage;
      }, 400);

      console.log(card.childNodes[1].style.backgroundImage);
    });
  });
}

function text_anim() {
  title = document.getElementById("title");
  size = document.getElementById("size");
  mass = document.getElementById("mass");
  impact = document.getElementById("impact");
  moshnost = document.getElementById("moshnost");
  desc = document.getElementById("desc");
  photo = document.getElementById("photo");

  title.style.opacity = "0";
  size.style.opacity = "0";
  mass.style.opacity = "0";
  impact.style.opacity = "0";
  moshnost.style.opacity = "0";
  desc.style.opacity = "0";
  photo.style.opacity = "0";

  haract = document.getElementById("haract");
  dop = document.getElementById("dop");
  osob = document.getElementById("osob");

  haract.style.backgroundColor = "#df5d5d";
  dop.style.backgroundColor = "#df5d5d";
  osob.style.backgroundColor = "#df5d5d";

  haract.style.backgroundColor = "#d12d2d";

  setTimeout(function () {
    title.style.opacity = "1";
    size.style.opacity = "1";
    mass.style.opacity = "1";
    impact.style.opacity = "1";
    moshnost.style.opacity = "1";
    desc.style.opacity = "1";
    photo.style.opacity = "1";
  }, 500);
}

function setStart() {
  products = document.querySelectorAll(".card");

  title = document.getElementById("title");
  size = document.getElementById("size");
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
  } else {
  }
}

// function sendForm() {
// // img = document.getElementById("photo");

//   document.querySelector('#form').addEventListener('submit', async function(event) {

// category = document.querySelectorAll('.title')[2].textContent;
// title = document.getElementById('title').textContent;

//   event.preventDefault();

//   const formData = Object.fromEntries(new FormData(event.target).entries());

//   const {message, mail, phone, name} = formData;
//   const {category}
//   const body = `name=${name}&mail=${mail}&phone=${phone}&message=${message}`;

//   url = '/php/mail.php';
//   options = {
//       method : 'POST',
//       body,
//       headers: {
//           "Content-type": "application/x-www-form-urlencoded; charset=UTF-8"
//       }
//   };

//   const response = await fetch(url, options);
//   const status = await response.text();

//   if (+status === 1) {
//       alert('Заявка успешно отправлена!');
//       document.querySelectorAll('.input').forEach(input => input.value = '');
//       document.querySelector('textarea').value = '';
//   }
//   else alert('Произошла ошибка, пожалуйста попробуйте позже');

//   });

// };

function change_cont(){

  phone = document.querySelectorAll(".desc")[1];
phone.textContent = "8 913 007 61 93"
 // console.log(phone);
}

function sendForm_test() {
  // img = document.getElementById("photo");
type = "2";
  document
    .querySelector("#form")
    .addEventListener("submit", async function (event) {
      category = document.querySelectorAll(".title")[2].textContent;
      title = document.getElementById("title").textContent;


console.log(document.getElementById("photo").style.backgroundImage.replace(/(url\(|\)|")/g, ''));
//alert(document.querySelectorAll('.input')[0]);
      event.preventDefault();
     
     //site = "http://newmayak" + document.getElementById("photo").style.backgroundImage.replace(/(url\(|\)|")/g, '') ;
      site = " http://mayak-avangard.ru" + document.getElementById("photo").style.backgroundImage.replace(/(url\(|\)|")/g, '') ;
      const formData = new FormData();
      formData.append('type', type.toString());
formData.append('category', category.toString());
formData.append('title', title.toString());
formData.append('message', document.getElementById("comment").value );
formData.append('mail', document.querySelectorAll('.input')[2].value);
formData.append('phone', document.querySelectorAll('.input')[1].value);
formData.append('name', document.querySelectorAll('.input')[0].value );
formData.append('img', site );
//formData.append('img',  "http://newmayak/assets/img/Siropovar_3.png");
      
      url = "/php/mail.php";
      options = {
        method: 'POST',
        body: formData,  
      };

      const response = await fetch(url, options);
      const status = await response.text();

      if (+status === 1) {
        alert("Заявка успешно отправлена!");
        document
         // .querySelectorAll(".input")
        //  .forEach((input) => (input.value = ""));
       // document.querySelector("textarea").value = "";
      } else alert("Произошла ошибка, пожалуйста попробуйте позже");
    });
}
