<?php

redirect();

function redirect()
{

  $reg = $_POST['reg'];
  $sign = $_POST['sign'];


  if ($reg) {
    registration();
    //  echo "registr";
  } else {
    signIn();
    // echo "sign";
  }
}


function registration()
{


  $login = $_POST['login'];
  $pass = $_POST['pass'];
  $mail = $_POST['mail'];
  $reg = $_POST['reg'];
  $sign = $_POST['sign'];


  $url = "./comments.php?login=$login";


  $con =  mysqli_connect("localhost", "a316809_1", "mayakavangard", "a316809_1");

  $result =  mysqli_query($con, "insert into userss(name,mail,number) values ('$login','$pass','$mail')");


  header("Location: $url");
};

function signIn()
{
  registration();


  //   header( "Location: $url" );
};
