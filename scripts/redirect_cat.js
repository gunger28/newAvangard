

function redirect(){
    products = document.querySelectorAll(".card");

    products.forEach(card => {
        
     card.addEventListener('click', function(event) {

var name = card.childNodes[3].textContent ;
console.log(name);


send(name);

        });
    });
}

function send(name_page) {
    
    //    const formData = Object.fromEntries(new FormData(event.target).entries());
        const {name} = name_page;
        const body = `name=${name}`;

        url = '/pages/category.php';
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
        }
        else alert('Произошла ошибка, пожалуйста попробуйте позже');
  
        window.open('/pages/category.php','_self',false);
};