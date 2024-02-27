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
    echo 'Телефон норм';
    echo $tel;
  } else {
    echo 'Телефон ошибка';
    echo $tel;
  }

// Валидация e-mail
    if($email == FALSE){
        echo 'Пожалуйста, введите действительный адрес электронной почты.';
    } else {
        // Отправляем электронную почту
    if(mail($to, $tema, $message, $headers)){
        echo '<p class="success">Ваше сообщение было отправлено успешно!</p>';
    } 
    }
// Отправили на почту, приступаем к отправке в Amo


$subdomain     = 'fedorovnapelageya'; // поддомен AmoCRM
$link = 'https://' . $subdomain . '.amocrm.ru/oauth2/access_token'; //Формируем URL для запроса




$data = [
    'client_id' => 'ed5139cb-dbab-46f0-80d1-6ad251f8a6bc',
    'client_secret' => 'LSaCXzEYMG75RqlyJ93oB8eDG9p49Yx9IRgrU6pzaB7wCTdutuN1DLKGUbYRunQl',
    'grant_type' => 'authorization_code',
    'code' => 'def50200d2e3a8e86afb741de7ea086002bb2b3e04e8862429fc076082818c084fee4a6d49d9b59d435de5d20088d97c0e031a8445651a88bd5b4f893acfbd940099f25e4945bb6955f950b97fdfc0b4283e99e10b27191b23893465f039c80dee3d43b9e705f73f21734f20f4a311bf6e5a05b6c72a62a0e07d4cec81dc7786ebf0ab1e298146460d32576eca81c21040741352eea0ae63a334ababe0e6dde6a01ea003af458ed25757f8003a5c4396734f4184fe07e17f19380ea41d8fc77090c21f735e88ca366549a134aca2bf84ce4755a98d22f65e1fc9ec4c8913a973d6d0285200f0d21d1df4e79ef78caac54058b028a58d636939519f6297ae03d095b5ad2694c745b491a610ec8407765c2094eb29f01002d0e71b9650d7b6c29ba289400e6f53276d4569c7d31897872bd88084b6780747b56184e2826f00b5f230ab34099065bab8e2bdd048eb54da756f1d96296c7bcc45393ce8aef634941b8a6311cb6b46267e94ab56af38503962df763791f0c35936863ae3dcd6b1409ca0708b2b2159c1325d103c090b9bb2874d963e5c7813eda6bde88f127bca211b6ef8fe8f95d06b08c02d55d85821db2910300c601731a53150a806e2daa817696f6b3cdc1b4236209d0f914d097715329dca8e138c6dd6cf8933781cde6f90159bbb7898787906d2e899',
    'redirect_uri' => 'https://alexeybannikov.ru',    
];




$curl = curl_init(); //Сохраняем дескриптор сеанса cURL
/** Устанавливаем необходимые опции для сеанса cURL  */
curl_setopt($curl,CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl,CURLOPT_USERAGENT,'amoCRM-oAuth-client/1.0');
curl_setopt($curl,CURLOPT_URL, $link);
curl_setopt($curl,CURLOPT_HTTPHEADER,['Content-Type:application/json']);
curl_setopt($curl,CURLOPT_HEADER, false);
curl_setopt($curl,CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($curl,CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($curl,CURLOPT_COOKIEFILE,dirname(__FILE__).'/cookie.txt'); 
curl_setopt($curl,CURLOPT_COOKIEJAR,dirname(__FILE__).'/cookie.txt');
curl_setopt($curl,CURLOPT_SSL_VERIFYPEER, 1);
curl_setopt($curl,CURLOPT_SSL_VERIFYHOST, 2);
$out = curl_exec($curl); //Инициируем запрос к API и сохраняем ответ в переменную
$code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
curl_close($curl);
/** Теперь мы можем обработать ответ, полученный от сервера. Это пример. Вы можете обработать данные своим способом. */
$code = (int)$code;
$errors = [
    400 => 'Bad request',
    401 => 'Unauthorized',
    403 => 'Forbidden',
    404 => 'Not found',
    500 => 'Internal server error',
    502 => 'Bad gateway',
    503 => 'Service unavailable',
];



try
{
    /** Если код ответа не успешный - возвращаем сообщение об ошибке  */
    if ($code < 200 || $code > 204) {
        throw new Exception(isset($errors[$code]) ? $errors[$code] : 'Undefined error', $code);
    }
}
catch(\Exception $e)
{
    die('Ошибка: ' . $e->getMessage() . PHP_EOL . 'Код ошибки: ' . $e->getCode());
}

/**
 * Данные получаем в формате JSON, поэтому, для получения читаемых данных,
 * нам придётся перевести ответ в формат, понятный PHP
 */
$response = json_decode($out, true);

$access_token = $response['access_token']; //Access токен
$refresh_token = $response['refresh_token']; //Refresh токен
$token_type = $response['token_type']; //Тип токена
$expires_in = $response['expires_in']; //Через сколько действие токена истекает

///////////////////////////////////////////////////////////////


echo '<b>Авторизация:</b>'; echo '<pre>'; print_r($response); echo '</pre>';

//ПОЛУЧАЕМ ДАННЫЕ АККАУНТА
$link='https://'.$subdomain.'.amocrm.ru/private/api/v2/json/accounts/current'; #$subdomain уже объявляли выше
$curl=curl_init(); #Сохраняем дескриптор сеанса cURL
#Устанавливаем необходимые опции для сеанса cURL
curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
curl_setopt($curl,CURLOPT_USERAGENT,'amoCRM-oAuth-client/1.0');
curl_setopt($curl,CURLOPT_USERAGENT,'amoCRM-API-client/1.0');
curl_setopt($curl,CURLOPT_URL,$link);
curl_setopt($curl,CURLOPT_HEADER,false);
curl_setopt($curl,CURLOPT_COOKIEFILE,dirname(__FILE__).'/cookie.txt'); #PHP>5.3.6 dirname(__FILE__) -> __DIR__
curl_setopt($curl,CURLOPT_COOKIEJAR,dirname(__FILE__).'/cookie.txt'); #PHP>5.3.6 dirname(__FILE__) -> __DIR__
curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,0);
curl_setopt($curl,CURLOPT_SSL_VERIFYHOST,0);
$out=curl_exec($curl); #Инициируем запрос к API и сохраняем ответ в переменную
$code=curl_getinfo($curl,CURLINFO_HTTP_CODE);
curl_close($curl);
$Response=json_decode($out,true);
$account=$Response['response']['account'];
echo '<b>Данные аккаунта:</b>'; echo '<pre>'; print_r($Response); echo '</pre>';


?>