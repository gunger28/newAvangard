<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        



        <!-- Roboto -->
        <link rel="preconnect" href="https://fonts.gstatic.com" />
        <link
            href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap"
            rel="stylesheet"
        />

        <style>
.menu{

    width:400px;
    height:60px;
    display: flex;


}

form{

    margin: auto auto;

}

input{

    font-size: 20px;
    background-color: rgb(255, 95, 95);
background-color: rgb(219, 89, 89);
border: none;
cursor: pointer;
width: 100%;
height: 100%;
}

        </style>
    </head>
    <body>
        
<div class="menu">

<form method="POST">
<input type="submit" name="btn" value="Пользователи">
</form>

<form method="POST">
<input type="submit" name="btn" value="Заказы">
</form>

<form method="POST">
<input type="submit" name="btn" value="Статистика">
</form>

</div>




       
<?php

$con =  mysqli_connect("localhost","root","","users");

if($_POST['btn'] == "Заказы"){

    $query_prod = 'SELECT 
              
    name, 
    mail, 
   number,
   product,
   item
  FROM 
    users INNER JOIN orders 
    ON users.id = orders.user 
    ';



$query = 'SELECT 
id,
name, 
mail, 
number
FROM 
users';

$result = mysqli_query($con, $query_prod);
$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
$num = 0;

echo "
<div style=\" display: flex; width: 100%; margin:7px; background-color: rgb(255, 95, 95); position:relative;\" >
--

<p style=\" margin-left: 10px; max-width: 50px;\">
№
</p>

<p style=\" margin-left: 10px; width: 170px;\">
ИМЯ:
</p>

<p style=\" margin-left: 10px; width: 170px;\">
ПОЧТА:
</p>

<p style=\" margin-left: 10px; width: 100px;\">
ТЕЛЕФОН:
</p>

<p style=\" margin-left: 10px; width: 140px;\">
КАТЕГОРИЯ:
</p>

<p style=\" margin-left: 10px; width: 120px;\">
ТОВАР:
</p>

</div>

";

foreach ($rows as $row) {
   $num += 1;
echo 
"
<div style=\"display: flex; width: 100%; margin:7px; background-color: rgb(200, 200, 200);\" >
--

<p style=\" margin-left: 10px; max-width: 50px; background-color: rgb(255, 255, 255);\">"
. $num . "

<p style=\" margin-left: 10px; width: 170px;\">"
. $row['name'] . "

</p>

<p style=\" margin-left: 10px; width: 170px;\">"
. $row['mail'] . "

</p>

<p style=\" margin-left: 10px; width: 100px;\">"
. $row['number'] . "

</p>

<p style=\" margin-left: 10px; width: 140px;\">"
. $row['product'] . "

</p>

<p style=\" margin-left: 10px; width: 120px;\">"
. $row['item'] . "

</p>
</div>
";
}
}
if($_POST['btn'] == "Пользователи"){





$query = 'SELECT 
id,
name, 
mail, 
number
FROM 
users';

$result = mysqli_query($con, $query);
$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);



echo "
<div style=\" display: flex; width: 100%; margin:7px; background-color: rgb(255, 95, 95); \" >
--

<p style=\" margin-left: 10px; width: 170px;\">
ИМЯ:
</p>

<p style=\" margin-left: 10px; width: 170px;\">
ПОЧТА:
</p>

<p style=\" margin-left: 10px; width: 100px;\">
ТЕЛЕФОН:
</p>

</div>

";


foreach ($rows as $row) {
echo 
"
<div style=\"display: flex; width: 100%; margin:7px; background-color: rgb(200, 200, 200);\" >
--

<p style=\" margin-left: 10px; width: 170px;\">"
. $row['name'] . "

</p>

<p style=\" margin-left: 10px; width: 170px;\">"
. $row['mail'] . "

</p>

<p style=\" margin-left: 10px; width: 100px;\">"
. $row['number'] . "

</p>
</div>
";

}


$phone = '89546754890';


$get_id = mysqli_query($con , "select id from users where number = '$phone'");


echo $_POST['btn'];
    echo "result: " ;
    
  

    while ($row = $get_id->fetch_assoc()) {
    
    }


 
}
?>


    </body>

</html>
