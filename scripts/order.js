let item_name;

function chooseOption() {
  let item = document.querySelectorAll(".option");

  item.forEach((element) => {
    console.log(element);
    element.style.backgroundColor = "rgb(185, 53, 53)";
    element.addEventListener("click", function (event) {
      off_color_option();
      element.style.backgroundColor = "#a0a0a0";
      item_name = element.id;
      console.log(item_name);
      put_options(item_name);
    });

   
  });
}


function off_color_option() {
  let item = document.querySelectorAll(".option");

  item.forEach((element) => {
    element.style.backgroundColor = "rgb(185, 53, 53)";
 
  });
}

function put_options(option) {

    let form = document.getElementById('form');
    console.log(form);
  switch (option) {
    case "vibro":
        form.innerHTML=`
        <input required type="text"  value="Вибросито" name = "type" style="visibility: hidden; height: 0; width: 0; position: absolute;">
        <select name="category" style="visibility: hidden; height: 0; width: 0; position: absolute;">
        <option value="Горизонтальная емкость">Горизонтальная емкость</option>
        <option value="Вертикальная емкость">Вертикальная емкость</option>
    </select>
    <select name="form" style="visibility: hidden; height: 0; width: 0; position: absolute;">
    <option value="Цилиндрическая">Цилиндрическая</option>
    <option value="Прямоугольная">Прямоугольная</option>
</select>

    <input required type="text" class = "content__input" placeholder = "Объем" name = "obem">
    <input required type="text" class = "content__input" placeholder = "Количество дек" name = "dek">
    <input required type="text" class = "content__input" placeholder = "Размер фракции" name = "fraction">

    <input required type="text" class = "content__input" placeholder = "Предназначение" name = "goal">
    <input required type="text" class = "content__input" placeholder = "Ваш Email" name = "email">
    <input required type="text" class = "content__input" placeholder = "Ваш телефон" name = "phone">
    <input required type="text" class = "content__input" placeholder = "Дополнительные элементы" name = "dops">
    <input type="submit" value="Отправить" id="sendForm">`;
      break;
    case "emkost":
        form.innerHTML=`
        <input required type="text"  value="Ёмкость" name = "type" style="visibility: hidden; height: 0; width: 0; position: absolute;">
        <select name="category">
        <option value="Горизонтальная емкость">Горизонтальная емкость</option>
        <option value="Вертикальная емкость">Вертикальная емкость</option>
    </select>
    <select name="form">
    <option value="Цилиндрическая">Цилиндрическая</option>
    <option value="Прямоугольная">Прямоугольная</option>
</select>

    <input required type="text" class = "content__input" placeholder = "Объем емкости" name = "obem">
    <input required type="text" class = "content__input" placeholder = "Из какого металла" name = "metal">
    <input required type="text" class = "content__input" placeholder = "Днище" name = "dnishe">
    <input required type="text" class = "content__input" placeholder = "Предназначение" name = "goal">
    <input required type="text" class = "content__input" placeholder = "Ваш Email" name = "email">
    <input required type="text" class = "content__input" placeholder = "Ваш телефон" name = "phone">
    <input required type="text" class = "content__input" placeholder = "Дополнительные элементы" name = "dops">
    <input type="submit" value="Отправить" id="sendForm">`;
      break;
    case "dozat":

      break;
    case "konvey":

      break;
    case "diss_reakt":

      break;
    default:
      break;
  }
}

function addSendFormListener() {
  document.querySelector("#form").addEventListener("submit", sendForm);
}

async function sendForm(event) {
  event.preventDefault();

  const formData = Object.fromEntries(new FormData(event.target).entries());

  const url = "/php/sendOrder.php";
  const options = {
    method: "POST",
    body: new FormData(event.target),
  };

  const response = await fetch(url, options);
  const data = await response.text();

  if (+data === 1) {
    alert("Заявка успешно отправлена!");
    window.location.reload();
  } else {
    alert("Произошла ошибка!" + " " + data);
  }
}

window.onload = () => {
  addSendFormListener();
  chooseOption();
};
