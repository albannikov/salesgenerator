<?php
$to = "albannikov@yandex.ru"; 
$tema = "Заявка Банников А.А."; 

$message .= "E-mail: ".$_POST['email']."<br>"; 
$message .= "Номер телефона: ".$_POST['phone']."<br>"; 

$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n"; 


function filterEmail($field){
    // Санитизация e-mail
    $field = filter_var(trim($field), FILTER_SANITIZE_EMAIL);    
    // Валидация e-mail
    if(filter_var($field, FILTER_VALIDATE_EMAIL)){
        return $field;
    } else{
        return FALSE;
    }
}
$email = filterEmail($_POST["email"]);
$tel = $_POST['phone'];

if(preg_match("/(8|7|\+7){0,1}[- \\\\(]{0,}([9][0-9]{2})[- \\\\)]{0,}(([0-9]{2}[- ]{0,}'.
'[0-9]{2}[- ]{0,}[0-9]{3})|([0-9]{3}[- ]{0,}[0-9]{2}[- ]{0,}[0-9]{2})|([0-9]{3}[- ]{0,}'
'[0-9]{1}[- ]{0,}[0-9]{3})|([0-9]{2}[- ]{0,}[0-9]{3}[- ]{0,}[0-9]{2}))/", $tel)) {
    if($email == FALSE){
        echo 'Пожалуйста, введите действительный адрес электронной почты.';
    } else {
        // Отправляем электронную почту
    if(mail($to, $tema, $message, $headers)){
        echo '<p class="success">Ваше сообщение было отправлено успешно!</p>';
    } 
    }
  } else {
    echo 'Введите корректные данные!';
  }

// Валидация e-mail


?>