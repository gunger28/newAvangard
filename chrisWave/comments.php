<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="./style.css">
</head>

<body class="main">
   
<header>
<img class="logo" src="https://images.ru.prom.st/1713956_w640_h640_marmelad.jpg">


<div class="info">
    <p class="text">
        Корпоративный портал по обсуждению поставок и информированию персонала.
    </p>

</div>

<div class="text">  Приветствем вас, менеджер по закупкам  </div>
<!-- <div class="onliner"> </div> -->
   


<?php
    $login = $_GET['login'];
    $send = $_POST['send'];

    if ($send) {
                addPost();
               // echo "sended";
            } else {
               // echo "No send";
            };

    echo "
    
    <div class=\"nick\">  $login  </div>

    <form class=\"comments_block\" method=\"POST\" action=\"./comments.php?login=$login\"> 
    <textarea class=\"commentArea\" name=\"comment\"> </textarea>
    <input class=\"sendComment\" name=\"send\" type=\"submit\">
    </form>
 
    </header>
    <div class=\"getter_comm\">
    ";

    setPosts();

    echo "
   </div>
</body>
</html>";


    function addPost()
    {
       
        $send = $_POST['send'];
      
        $comment = $_POST['comment'];
     
        $login = $_GET['login'];
       
        $con =  mysqli_connect("localhost", "a316809_1", "mayakavangard", "a316809_1");
      
        $result =  mysqli_query($con, "insert into comments(comment,user_c) values ('$comment','$login')");
       
    }

   
    function setPosts()
    {

        
$query_prod = 'SELECT              
comment,
user_c
FROM 
comments';


        $con =  mysqli_connect("localhost", "a316809_1", "mayakavangard", "a316809_1");
       
        $result =  mysqli_query($con, $query_prod);
       
        $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

     
        foreach ($rows as $row) { 
            echo
            "
    <div class=\"commentSetter\" >
    <div class=\"name\">
<p class=\"nameP\">

                ".  $row['user_c'] . " </p></div> <div class=\"commentText\">" . $row['comment'] .
                " </div></div>";
        }
    }

    ?>






 <?php
//     $login = $_GET['login'];
//     $send = $_POST['send'];

//     if ($send) {
//         addPost();
//         echo "sended";
//     } else {
//         echo "No send";
//     };

  
//     echo "
//     <div class=\"nick\">  $login  </div>
//     <div class=\"comments_block\">  
//     <div class=\"c_nick\">  
//     </div>
//     <div class=\"comment\">  
//     <form method=\"POST\" action=\"./comments.php?login=$login\"> 
//     <textarea name=\"comment\"> </textarea>
//     <input name=\"send\" type=\"submit\">
//     </form>
//     </div>
//     </div>
//     <div class=\"getter_comm\">
//     ";

//     setPosts();

//     echo "
//    </div>
// </body>
// </html>";


//     function addPost()
//     {
       
//         $send = $_POST['send'];
      
//         $comment = $_POST['comment'];
     
//         $login = $_GET['login'];
       
//         $con =  mysqli_connect("localhost", "a316809_1", "mayakavangard", "a316809_1");
      
//         $result =  mysqli_query($con, "insert into comments(comment,user_c) values ('$comment','$login')");
//         echo "Запись сделана";
//     }

   
//     function setPosts()
//     {

        
//         $query_prod = 'SELECT              
//     comment,
//     user_c
//   FROM 
//     comments';


//         $con =  mysqli_connect("localhost", "a316809_1", "mayakavangard", "a316809_1");
       
//         $result =  mysqli_query($con, $query_prod);
       
//         $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

     
//         foreach ($rows as $row) {
//             echo
//             "
//     <div style=\"display: flex; width: 100%; height: 40px; color:black; margin:7px; background-color:white;\" >"
//                 . $row['comment'] . "------" . $row['user_c'] .
//                 " </div>--";
//         }
//     }

    ?>  