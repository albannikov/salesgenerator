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
    'code' => 'def50200ea246114319a7ade605c2abf83cdfa6d6e8efb93caf6cd695bbc1510acf8c1bfe494e6408828b507751791e6a261e07f9ed37a1c296f26cf864933394e57ccc95af475e7d3478a3f6e0057d21ed505372eebb8c432f1fa234f187b762fcf9149117a50f602ce3a433c064489de316b686dfd45761a870194f4638b0cbe4743c31b56624f2a5b7cb7d97af2fe5826e722429a41c7f5fa382f2657e6396bce9f720975bd651d9e8c5e44cb1b8fdb7aebf10fcc315bea5420afc353a0161493e25d11cb1c16dcbef236c81730ebd48870a6c3fd197cef1934963b3d1f053a00c7a8e5d1a3172a40224aa86144e4857ddee354ab1126f47e84790c2b3cb731b61ab0b725a0fbed823ba9f03963867f3d934bc693a0c6a820e526f9a913b4287efbaf3a32cb390e4920cafcc505a66b4cd828fad160a52f69a26ebaca6673e551ecf856edd92212bf1efe92071bee17f173267feb499f7f8c2b351efaf4726edf689e1f70c6c212c7f141375efd16966b746391f5bfba4cf122dfdbd46a5ec6d5b15f06ce28b9860d2b8ec6cd5d4bdab61c30c8077d1e246009c30a54a72b481c5cd5cf9cb322c7b0fe25babd08548777fc3fa418fefbdc633916c5a5a9b533c9f0c9c0bb5a94dc028af715967a7b25d53f43be79a1226a2c2859379fc8fe94f5e014d36c4fdb6029',
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



//amo



//ПОЛУЧАЕМ ДАННЫЕ АККАУНТА
$link='https://'.$subdomain.'.amocrm.ru/private/api/v2/json/accounts/current'; #$subdomain уже объявляли выше
$curl=curl_init(); #Сохраняем дескриптор сеанса cURL
#Устанавливаем необходимые опции для сеанса cURL
curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
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
//echo '<b>Данные аккаунта:</b>'; echo '<pre>'; print_r($Response); echo '</pre>';


//ПОЛУЧАЕМ СУЩЕСТВУЮЩИЕ ПОЛЯ
$amoAllFields = $account['custom_fields']; //Все поля
$amoConactsFields = $account['custom_fields']['contacts']; //Поля контактов
//echo '<b>Поля из амо:</b>'; echo '<pre>'; print_r($amoConactsFields); echo '</pre>';


//ФОРМИРУЕМ МАССИВ С ЗАПОЛНЕННЫМИ ПОЛЯМИ КОНТАКТА
//Стандартные поля амо:
$sFields = array_flip(array(
		'PHONE', //Телефон. Варианты: WORK, WORKDD, MOB, FAX, HOME, OTHER
		'EMAIL' //Email. Варианты: WORK, PRIV, OTHER
	)
);

//Проставляем id этих полей из базы амо
foreach($amoConactsFields as $afield) {
	if(isset($sFields[$afield['code']])) {
		$sFields[$afield['code']] = $afield['id'];
	}
}


//ДОБАВЛЯЕМ СДЕЛКУ
$leads['request']['leads']['add']=array(
	array(
		'name' => $lead_name,
		'status_id' => $lead_status_id, //id статуса
		'responsible_user_id' => $responsible_user_id, //id ответственного по сделке
		//'date_create'=>1298904164, //optional
		//'price'=>300000,
		//'tags' => 'Important, USA', #Теги
		//'custom_fields'=>array()
	)
);

$link='https://'.$subdomain.'.amocrm.ru/private/api/v2/json/leads/set';

$curl=curl_init(); #Сохраняем дескриптор сеанса cURL
#Устанавливаем необходимые опции для сеанса cURL
curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
curl_setopt($curl,CURLOPT_USERAGENT,'amoCRM-API-client/1.0');
curl_setopt($curl,CURLOPT_URL,$link);
curl_setopt($curl,CURLOPT_CUSTOMREQUEST,'POST');
curl_setopt($curl,CURLOPT_POSTFIELDS,json_encode($leads));
curl_setopt($curl,CURLOPT_HTTPHEADER,array('Content-Type: application/json'));
curl_setopt($curl,CURLOPT_HEADER,false);
curl_setopt($curl,CURLOPT_COOKIEFILE,dirname(__FILE__).'/cookie.txt'); #PHP>5.3.6 dirname(__FILE__) -> __DIR__
curl_setopt($curl,CURLOPT_COOKIEJAR,dirname(__FILE__).'/cookie.txt'); #PHP>5.3.6 dirname(__FILE__) -> __DIR__
curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,0);
curl_setopt($curl,CURLOPT_SSL_VERIFYHOST,0);

$out=curl_exec($curl); #Инициируем запрос к API и сохраняем ответ в переменную
$code=curl_getinfo($curl,CURLINFO_HTTP_CODE);
$Response=json_decode($out,true);
//echo '<b>Новая сделка:</b>'; echo '<pre>'; print_r($Response); echo '</pre>';
if(is_array($Response['response']['leads']['add']))
	foreach($Response['response']['leads']['add'] as $lead) {
		$lead_id = $lead["id"]; //id новой сделки
	};
//ДОБАВЛЯЕМ СДЕЛКУ - КОНЕЦ


//ДОБАВЛЕНИЕ КОНТАКТА
$contact = array(
	'name' => $contact_name,
	'linked_leads_id' => array($lead_id), //id сделки
	'responsible_user_id' => $responsible_user_id, //id ответственного
	'custom_fields'=>array(
		array(
			'id' => $sFields['PHONE'],
			'values' => array(
				array(
					'value' => $contact_phone,
					'enum' => 'MOB'
				)
			)
		),
		array(
			'id' => $sFields['EMAIL'],
			'values' => array(
				array(
					'value' => $contact_email,
					'enum' => 'WORK'
				)
			)
		)
	)
);

$set['request']['contacts']['add'][]=$contact;

#Формируем ссылку для запроса
$link='https://'.$subdomain.'.amocrm.ru/private/api/v2/json/contacts/set';
$curl=curl_init(); #Сохраняем дескриптор сеанса cURL
#Устанавливаем необходимые опции для сеанса cURL
curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
curl_setopt($curl,CURLOPT_USERAGENT,'amoCRM-API-client/1.0');
curl_setopt($curl,CURLOPT_URL,$link);
curl_setopt($curl,CURLOPT_CUSTOMREQUEST,'POST');
curl_setopt($curl,CURLOPT_POSTFIELDS,json_encode($set));
curl_setopt($curl,CURLOPT_HTTPHEADER,array('Content-Type: application/json'));
curl_setopt($curl,CURLOPT_HEADER,false);
curl_setopt($curl,CURLOPT_COOKIEFILE,dirname(__FILE__).'/cookie.txt'); #PHP>5.3.6 dirname(__FILE__) -> __DIR__
curl_setopt($curl,CURLOPT_COOKIEJAR,dirname(__FILE__).'/cookie.txt'); #PHP>5.3.6 dirname(__FILE__) -> __DIR__
curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,0);
curl_setopt($curl,CURLOPT_SSL_VERIFYHOST,0);

$out=curl_exec($curl); #Инициируем запрос к API и сохраняем ответ в переменную
$code=curl_getinfo($curl,CURLINFO_HTTP_CODE);
CheckCurlResponse($code);

$Response=json_decode($out,true);
//ДОБАВЛЕНИЕ КОНТАКТА - КОНЕЦ

//amo





?>