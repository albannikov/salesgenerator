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
// $client_secret = 'LSaCXzEYMG75RqlyJ93oB8eDG9p49Yx9IRgrU6pzaB7wCTdutuN1DLKGUbYRunQl'; // Секретный ключ
// $client_id     = 'ed5139cb-dbab-46f0-80d1-6ad251f8a6bc'; // ID интеграции
// $code          = 'def502008e6b9b94eaf61457193fb6d73cfebf37e8d09b143993770acc5d30916ad201ab0659cf0edfa602e774407c9764071dfbce9663a7be07342be4956b7553ad2db3f65ae45f4ab39b469b86a8ea723d6dbf1a9af3330f85e69b3cb83d34401c46b3b93f679066864adb5db4c9b4ff86c80332257aca58ccf0eff296b83c43e399d6258c99d3da9e18782d467c26602be829a10da533424b99d2a912b330a0c4e0a33c56fd2d5d0d64a759d4f0962fc41f8f45ec738f8f4a031b0e35185be6716785ff80d0324ba1b746f69942a1bfb7ec0dd7fd078e4e4439a1717974242faaba0b457e2000ff796a262f3730fb73fe6ae6a051f8d7aee1b489c1fe9ef93878936324500e8763ffe7361d96071c98ac483c6e758f5e02930ccb55bf2726ed2051c3a3935450375b52fc02265cd04af2d4ad802cd703a05bdc3a9c724221bcd8738a50940893c0adb89d717a55080c5e7a773a61cf89fb275f0ee45efd8c5001bd92ab36cd911c3bac7ca58d1d626e8ca2d49397823a6ea7ca38b55066561221c7f7cb46c5f9db7d9deb62b860d8b71df768d48e608cfd8b5534a177042bbe4bc39ea9313b25845873a4781cd15d3e7aa80b861684bc3c83c72f55d402f919ca01a67149512ee5f77d42d9a118c08398c7c74379e4f4a09ee9adab148f5512f427dc67bdeed9426f'; // Код авторизации
// $token_file    = 'tokens.txt';
// $redirect_uri  = 'https://alexeybannikov.ru/salesgenerator/mail.php';



$link = 'https://' . $subdomain . '.amocrm.ru/oauth2/access_token'; //Формируем URL для запроса

$data = [
    'client_id' => 'ed5139cb-dbab-46f0-80d1-6ad251f8a6bc',
    'client_secret' => 'LSaCXzEYMG75RqlyJ93oB8eDG9p49Yx9IRgrU6pzaB7wCTdutuN1DLKGUbYRunQl',
    'grant_type' => 'authorization_code',
    'code' => 'def502003c9312f5406f570fa4462fca9a2410abfcd8b8212193143f6ab53a65d399a4220c258c7b8e3459375c6a1d0b211e8a488848ed8009646d32cdbc9f413c74f89f5d9dbc616b67a4a5204d96c0cebaaffc1610fb52d19646403bea8d36d1b4b8b203044b6e58b1091003c48271e2c7c9168bf57f2c619c28eb80161928969226ab5490f051561e2e387259224e7c0687a8929be04cea45f8c9200cd07de8404edcd16b11efbf70a49f13524451e7f25976a45a253dc4c7f3e86c556fd0880eb00ac31c2e9b0cc24db3dde76e4c97e442b714b8ca95bfe906679a1ea3fc973c613ade8771598c6c70cce78675f32e844d0f4b55b7df5fcda251fd5cf564320d8f779576f73df68a723c5af509664941144ed478fb016b50f8a768f89e5cc0874ce7fbac3e6a38ac1d57cb0af3c52bb0b8da2313270bbdc652986d9290b203fbdcfb7206b4af170f26e05bb79675e49bcd0e26eb4b1111b2b00629237b1ef06c5d714e120721d30c36de8dcb403a556bd0cd218f627131998cf9bf9714aa23a611db4abfbd227671bc3e73263c433796945545220c73b5e2cf3153d72a7ebbd28bc15ffa69f769c4230996abc0d2fbeea6e906efc21399e17859f85a61de7f86a93a5cbc6f0e71d196a168b5f37d4674ce79fe5028243415268958dec909d0f3669262be5b45674e',
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

echo $out;

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


?>