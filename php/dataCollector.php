<?php
header("Content-Type: text/html; charset=UTF-8");
setUser_data();
//echo "1";

function getUser_location()
{
  //  $ip = "77.222.106.52";
   $ip = getUser_ip();
    $geo = unserialize(file_get_contents('http://ip-api.com/php/'.$ip.'?lang=ru'));
    //$country = $geo['country'];
    $city = $geo['city'];
    $region = $geo['regionName'];
    $string = "$city $region";
    if ($string == "") {
        $string = "Unknown";
    };

    return $string;
}

function getUser_ip()
{
    $user_ip = getenv('REMOTE_ADDR');
  //  $user_ip = "77.222.106.52";
    return $user_ip;
}

function getUser_system()
{

    $sys = $_SERVER['HTTP_USER_AGENT'];
    $cutSys1 = explode('(', $sys);
    $cutSys1 = explode(' ', $cutSys1[1]);
    $system = $cutSys1[0];
echo $sys;
    return $system;
}

function getUser_browser()
{
    $sys = $_SERVER['HTTP_USER_AGENT'];

   $browser = "empty";

    if (strpos($sys, 'OPR') == true) {
        $browser = "Opera";
    };
    if (strpos($sys, 'Firefox') == true) {
        $browser = "Firefox";
    };
    if (strpos($sys, 'YaBrowser') == true) {
        $browser = "Yandex";
    };
    if (strpos($sys, 'Edg') == true) {
        $browser = "Edge";
    };

    if (strpos($sys, 'Safari') == true && $browser == "empty") {
        $browser = "Safari";
    };

    if (strpos($sys, 'Chrome') == true && $browser == "Safari") {
        $browser = "Chrome";
    };


//echo $sys;
    return $browser;
}


function setUser_data()
{
    //  $sys = $_SERVER['HTTP_USER_AGENT'];
    $browser = getUser_browser();
    $loc = getUser_location();
    $system = getUser_system();
    $date = date("y-m-j");
    $ip = getUser_ip();
    $con =  mysqli_connect("localhost", "a316809_1", "mayakavangard", "a316809_1");
    
$amount = 1;
$name = generateName();
    echo $browser;
    if (checkIp() == "new") {
        $result =  mysqli_query($con, "insert into visiters(name,location,ip,browser,system,date,amount) values ('$name','$loc','$ip','$browser','$system','$date','$amount')");
    }else{
        $newAmount = mysqli_query($con, "select amount from visiters where ip = '$ip'");
        $newAmount = $newAmount->fetch_array();
        $newAmount = $newAmount[0] + 1;
        echo $newAmount ;
        $result =  mysqli_query($con, "update visiters set amount = '$newAmount' where ip = '$ip'");
    };
};


function generateName(){

    $names_pull =array(
"guse","doge","fox","elephant","snake","mustang","porshe",
"kia","toyota","mazda","dodge","lamborgini","honda","hyper",
"intel","aoc","acer","palit","asus","mouse","jiraf","rock"
    );

    $sernames_pull = array(
        "potato","carrot","cucumber","folk","beans","garlic","tomato",
        "pepper","onion","pumpkin","dodge","apple","samsung","huawei",
        "xiaomi","zte","nokia","lg","htc","zopo","oppo","philips"
    );

    $choser_name = rand(0, count($names_pull)-1);
    $choser_sername = rand(0, count($sernames_pull)-1);
    $number = rand(0, 100);

    $name =  "$names_pull[$choser_name]_$sernames_pull[$choser_sername]_$number";
    return $name;
}

function checkIp()
{

    $ip = getUser_ip();

    $con =  mysqli_connect("localhost", "a316809_1", "mayakavangard", "a316809_1");
    $result =  mysqli_query($con, "select count(*) as counter from visiters where ip = '$ip'");
    $row = $result->fetch_assoc();
    $response = "?";
    $res = $row['counter'];
    $res = "$res";

    if ($res == '0') {
        $response = "new";
    } else {
        $response = "plusCount";
    }

    echo $res;
    return $response;
}


// Вынести на фронт админ панели потом

// function Lat2ru($string)
// {
//     $cyr = array(
//         "Щ", "Ш", "Ч", "Ц", "Ю", "Я", "Ж", "А", "Б", "В",
//         "Г", "Д", "Е", "Ё", "З", "И", "Й", "К", "Л", "М", "Н",
//         "О", "П", "Р", "С", "Т", "У", "Ф", "Х", "Ь", "Ы", "Ъ",
//         "Э", "Є", "Ї", "І",
//         "щ", "ш", "ч", "ц", "ю", "я", "ж", "а", "б", "в",
//         "г", "д", "е", "ё", "з", "и", "й", "к", "л", "м", "н",
//         "о", "п", "р", "с", "т", "у", "ф", "х", "ь", "ы", "ъ",
//         "э", "є", "ї", "і"
//     );
//     $lat = array(
//         "Shch", "Sh", "Ch", "C", "Yu", "Ya", "J", "A", "B", "V",
//         "G", "D", "E", "E", "Z", "I", "y", "K", "L", "M", "N",
//         "O", "P", "R", "S", "T", "U", "F", "H", "",
//         "Y", "", "E", "E", "Yi", "I",
//         "shch", "sh", "ch", "c", "Yu", "Ya", "j", "a", "b", "v",
//         "g", "d", "e", "e", "z", "i", "y", "k", "l", "m", "n",
//         "o", "p", "r", "s", "t", "u", "f", "h",
//         "", "y", "", "e", "e", "yi", "i"
//     );
//     $string = str_replace($lat, $cyr, $string);
//     $string = str_replace("_", " ", $string);
//     return ($string);
// }
