<?php
    

    $img = $_POST['img'];
    $category = $_POST['category'];
    $title = $_POST['title'];
    $name = $_POST['name'];
    $mail = $_POST['mail'];
    $phone = $_POST['phone'];
    $user_message = $_POST['message'];

    // message settings
    $to = 'evnikagk@yandex.ru';
    $subject = 'Mayak-Avangard (Заявка с главной страницы)';

    if($category == ""){

        $message = "Заявка с главной страницы!\r\n"
        ."<br>"."Имя: "."<strong>"."$name"."</strong>"."\r\n\n"."<br>"
            ."Email: "."<strong>"."$mail"."</strong>"."\r\n\n"."<br>"
            ."Телефон: "."<strong>"."$phone"."</strong>"."\r\n\n"."<br>"
            ."Сообщение: "."<strong>"."$user_message"."</strong>"."\r\n\n"."<br>";

    }else{

        $message = "Заявка!\r\n"
        ."Категория: "."<strong>"."$category"."</strong>"."\r\n\n"."<br>"
        ."Продукт: "."<strong>"."$title"."</strong>"."\r\n\n"."<br>"
        ."<img style = \"height: 300px; width: 200px\" src = \""."$img"."\">"."<br>"
        ."<br>"."Имя: "."<strong>"."$name"."</strong>"."\r\n\n"."<br>"
            ."Email: "."<strong>"."$mail"."</strong>"."\r\n\n"."<br>"
            ."Телефон: "."<strong>"."$phone"."</strong>"."\r\n\n"."<br>"
            ."Сообщение: "."<strong>"."$user_message"."</strong>"."\r\n\n"."<br>";

    };

    // message text
    
    if(isset($phone) && $phone !== ''){

        $from = "MayakAvangard";
        $headers  = "From: $from\r\nContent-type: text/html; charset=utf-8\r\n";
        
        if (mail($to, $subject, $message, $headers)) {
            
$region = getUser_location();
            $con =  mysqli_connect("localhost","a316809_1","mayakavangard","a316809_1");
            $result =  mysqli_query($con ,"insert into users(name,mail,number,region) values ('$name','$mail','$phone','$region')");
            $get_id = mysqli_query($con , "select id from users where number = '$phone'");
          
            while ($row = $get_id->fetch_assoc()) {
                $id = $row['id'];
                $today = date("y-m-j"); 
                $result =  mysqli_query($con ,"insert into orders(product,item,user_id,message,date) values ('$category','$title','$id','$user_message','$today')");
           }
    
            echo 1;
    
            
        } else {
            echo 0;
        };


    }else{

        echo 'Form Err';

    }


    function getUser_location()
{
    $ip = getUser_ip();
    $geo = unserialize(file_get_contents("http://www.geoplugin.net/php.gp?ip=$ip"));
    //  $country = $geo["geoplugin_countryName"];
    // $city = $geo["geoplugin_city"];
    $region = $geo["geoplugin_region"];
    if ($region == "") {
        $region = "Unknown";
    };

    return $region;
}

function getUser_ip()
{
    $user_ip = getenv('REMOTE_ADDR');
    return $user_ip;
}
?>