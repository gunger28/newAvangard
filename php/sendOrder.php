<?php

$type = $_POST['type'];
$type_str = "<strong>" . "$type" . "</strong>" . "\r\n\n" . "<br><br>";

$category = $_POST['category'];
$mail = $_POST['email'];
$phone = $_POST['phone'];
$obem = $_POST['obem'];
$metal = $_POST['metal'];
$dnishe = $_POST['dnishe'];
$goal = $_POST['goal'];
$form = $_POST['form'];
$dops = $_POST['dops'];

// form fields
$dek = $_POST['dek'];
$fraction = $_POST['fraction'];

//Вибросито
$numDek_str = "Количество дек:" . "<strong>" . "$dek" . "</strong>" . "\r\n\n" . "<br><br>";
$fraktionSize_str = "Размер фракции:" . "<strong>" . "$fraction" . "</strong>" . "\r\n\n" . "<br><br>";

//Ёмкость
$type_str = "<strong>" . "$type" . "</strong>" . "\r\n\n" . "<br><br>";
$volume_str = "Объем: " . "<strong>" . "$obem" . "</strong>" . "\r\n\n" . "<br>";
$material_str = "Материал: " . "<strong>" . "$metal" . "</strong>" . "\r\n\n" . "<br>";
$form_str = "Форма: " . "<strong>" . "$form" . "</strong>" . "\r\n\n" . "<br>";
$extra_str = "Дополнительно: " . "<strong>" . "$dops" . "</strong>" . "\r\n\n" . "<br>";
$forWhat_str = "Предназначение: " . "<strong>" . "$goal" . "</strong>" . "\r\n\n" . "<br>";
$vertHorizont_str = 'Положение: ' . "<strong>" . "$category" . "</strong>" . "\r\n\n" . "<br>";
$dno_str = "Днище: " . "<strong>" . "$dnishe" . "</strong>" . "\r\n\n" . "<br>";

//Вибрости формирование сообщения
  if ($type == "Вибросито") {
      
     $message =
     "Новая заявка на " . $type_str . "\r\n" . "<br>"
     . "Email заказчика: " . "<strong>" . "$mail" . "</strong>" . "\r\n" . "<br>"
     . "Телефон заказчика: " . "<strong>" . "$phone" . "</strong>" . "\r\n" . "<br>"
     . "\r\n\n" . "<br>"
     . $volume_str
     . $numDek_str
     . $fraktionSize_str
     . $forWhat_str
     . $extra_str;
  } ;

  if ($type == "Ёмкость") {
      
    $message =
    "Новая заявка на " . $type_str . "\r\n" . "<br>"
    . "Email заказчика: " . "<strong>" . "$mail" . "</strong>" . "\r\n" . "<br>"
    . "Телефон заказчика: " . "<strong>" . "$phone" . "</strong>" . "\r\n" . "<br>"
    . "\r\n\n" . "<br>"
    . $vertHorizont_str
    . $volume_str
    . $material_str
    . $dno_str
    . $forWhat_str
    . $form_str
    . $extra_str;
 } ;

 if ($type == "Дозатор") {
      
    $message =
    "Новая заявка на " . $type_str . "\r\n" . "<br>"
    . "Email заказчика: " . "<strong>" . "$mail" . "</strong>" . "\r\n" . "<br>"
    . "Телефон заказчика: " . "<strong>" . "$phone" . "</strong>" . "\r\n" . "<br>"
    . "\r\n\n" . "<br>"
    . $vertHorizont_str
    . $volume_str
    . $material_str
    . $dno_str
    . $forWhat_str
    . $form_str
    . $extra_str;
 } ;

 if ($type == "Конвейер") {
      
    $message =
    "Новая заявка на " . $type_str . "\r\n" . "<br>"
    . "Email заказчика: " . "<strong>" . "$mail" . "</strong>" . "\r\n" . "<br>"
    . "Телефон заказчика: " . "<strong>" . "$phone" . "</strong>" . "\r\n" . "<br>"
    . "\r\n\n" . "<br>"
    . $vertHorizont_str
    . $volume_str
    . $material_str
    . $dno_str
    . $forWhat_str
    . $form_str
    . $extra_str;
 } ;

 if ($type == "Диссольвер/Реактор") {
      
    $message =
    "Новая заявка на " . $type_str . "\r\n" . "<br>"
    . "Email заказчика: " . "<strong>" . "$mail" . "</strong>" . "\r\n" . "<br>"
    . "Телефон заказчика: " . "<strong>" . "$phone" . "</strong>" . "\r\n" . "<br>"
    . "\r\n\n" . "<br>"
    . $vertHorizont_str
    . $volume_str
    . $material_str
    . $dno_str
    . $forWhat_str
    . $form_str
    . $extra_str;
 } ;

sendMail($message);

function sendMail( $message)
{
    $to = 'gungeranton@yandex.ru';
    $subject = 'Новая заявка с сайта Маяк Авангард';
    $from = "MayakAvangard";
    $headers  = "From: $from\r\nContent-type: text/html; charset=utf-8\r\n";

    // try to post
    if (mail($to, $subject, $message, $headers)) {
        echo 1;
    } else {
        echo 0;
    };
}
