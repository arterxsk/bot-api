<?php

error_reporting(0);
date_default_timezone_set('America/Lima');

require_once('Functions.php');

$_artId = '5126174674'; #YOUR ID GOES HERE, A NECESSARY VARIABLE TO ADD NEW USERS OR GROUPS.
$botToken = '6290784235:AAGNeaawgHPjO8JOjmlPmdyaWpLyo8Baa4k'; #

#START CAPTURE OF VARIABLES SENT FROM THE CHAT

$update = file_get_contents('php://input');
$update = json_decode($update, true);
$e = print_r($update);

#DEFINING MENSA VARIABLES

$chatId = $update["message"]["chat"]["id"];
$userId = $update["message"]["from"]["id"];
$firstname = $update["message"]["from"]["first_name"];
$lastname = $update["message"]["from"]["last_name"];
$username = $update["message"]["from"]["username"];
$message = $update["message"]["text"];
$message_id = $update["message"]["message_id"];
$info = json_encode($update, JSON_PRETTY_PRINT);

#ADMIN PRIVILEGE CHECK

if ($userId != $_artId) {
	verAdmin($userId);
}

#ADMIN COMMANDS

#COMMAND TO ADD CHATS AND THEY CAN USE YOUR BOT, EXAMPLE /add 1466851830

if (strpos($message, "!add") === 0 || strpos($message, "/add") === 0) {
	if ($userId != $_artId && $Admin != true) {
		$message = "You are not authorized to add new users and/or groups.\nContact @arterxsk.";
		sendMes($chatId, $message, $message_id);
		exit();
	} elseif ($userId == $_artId || $Admin == true) {
		$addx = substr($message, 5);
		AñadirChatID($addx);
		$message_admin = "✅ The user was successfully added.";
		$message_user = "✅ Permissions granted to use @arterxskbot.";
		sendMes($chatId, $message_admin, $message_id);
		sendMes($addx, $message_user, "");
		exit();
	}
}

#COMMAND TO UPGRADE FROM RANGE IN YOUR BOT, EXAMPLE /premium 1466851830

if (strpos($message, "!premium") === 0 || strpos($message, "/premium") === 0) {
	if ($userId != $_artId && $Admin != true) {
		$message = "You are not authorized to rank up users and/or groups.\nContact	@arterxsk.";
		sendMes($chatId, $message, $message_id);
		exit();
	} elseif ($userId == $_artId || $Admin == true) {
		$addx = substr($message, 9);
		PremiumChatID($addx);
		$message_admin = "✅ Account upgraded to PREMIUM successfully.";
		$message_user = "✅ Your account was upgraded to PREMIUM, enjoy your	membership with @arterxskbot.";
		sendMes($chatId, $message_admin, $message_id);
		sendMes($addx, $message_user, "");
		exit();
	}
}

#COMMAND TO ADD ADMIN

if (strpos($message, "!setadmin") === 0 || strpos($message, "/setadmin") === 0) {
	if ($userId != $_artId) {
		$message = "You are not authorized to use this command\n Contact @arterxsk.";
		sendMes($chatId, $message, $message_id);
		exit();
	} elseif ($userId == $_artId) {
		$addx = substr($message, 10);
		SetAdmin($addx);
		$message_admin = "✅ Updated account to ADMINISTRATOR successfully.";
		$message_user = "✅ Your account was updated to ADMINISTRATOR, enjoy your	membership with @arterxskbot.";
		sendMes($chatId, $message_admin, $message_id);
		sendMes($addx, $message_user, "");
		exit();
	}
}

# COMMAND TO BAN USERS

if (strpos($message, "!ban") === 0 || strpos($message, "/ban") === 0) {
	if ($userId != $_artId && $Admin != true) {
		$message = "You are not authorized to suspend user accounts.\nContact @arterxsk.";
		sendMes($chatId, $message, $message_id);
		exit();
	} elseif ($userId == $_artId || $Admin == true) {
		$addx = substr($message, 5);
		Ban($addx);
		$message_admin = "✅ Account suspended successfully.";
		$message_user = "✅ Your account was temporarily suspended, if you think this	is a mistake contact @arterxsk.";
		sendMes($chatId, $message_admin, $message_id);
		sendMes($addx, $message_user, "");
		exit();
	}
}

#COMMAND TO UNBAN USERS

if (strpos($message, "!unban") === 0 || strpos($message, "/unban") === 0) {
	if ($userId != $_artId && $Admin != true) {
		$message = "You are not authorized to unban user accounts.\nContact @arterxsk.";
		sendMes($chatId, $message, $message_id);
		exit();
	} elseif ($userId == $_artId || $Admin == true) {
		$addx = substr($message, 7);
		Unban($addx);
		$message_admin = "✅ The account was reactivated successfully.";
		$message_user = "✅ Your account was activated again, enjoy @arterxskbot.";
		sendMes($chatId, $message_admin, $message_id);
		sendMes($addx, $message_user, "");
		exit();
	}
}

# COMMAND TO ERASE USER

if (strpos($message, "!delete") === 0 || strpos($message, "/delete") === 0) {
	if ($userId != $_artId && $Admin != true) {
		$message = "You are not authorized to delete users and/or groups.\nContact	@arterxsk.";
		sendMes($chatId, $message, $message_id);
		exit();
	} elseif ($userId == $_artId || $Admin == true) {
		$addx = substr($message, 8);
		Delete($addx);
		$message_admin = "✅ Se elimino el usuario/grupo correctamente.";
		$message_user = "✅ You were removed from our Database\nContact @arterxsk to	request access again.";
		sendMes($chatId, $message_admin, $message_id);
		sendMes($addx, $message_user, "");
		exit();
	}
}

# USER COMMANDS

#START COMMAND

if (strpos($message, "!start") === 0 || strpos($message, "/start") === 0) {
	$message = "Hello, a little reminder that I’m still in the development process.
	Some of my commands might work or not and premium access.\n\n[✦] 𝘂𝘀𝗲𝗿
	𝗰𝗼𝗺𝗺𝗮𝗻𝗱𝘀\n\n— 𝗚𝗔𝗧𝗘𝗪𝗔𝗬\n⌗ 𝘀𝘁𝗿𝗶𝗽𝗲 𝗮𝘂𝘁𝗵 - /chk\n\n—
	𝗧𝗢𝗢𝗟𝗦\n⌗ 𝗰𝗵𝗲𝗰𝗸 𝗶𝗻𝗳𝗼 - /info\n⌗ 𝗰𝗵𝗲𝗰𝗸 𝗴𝗿𝗼𝘂𝗽 -
	/mygroup\n⌗ 𝗰𝗵𝗲𝗰𝗸 𝗮𝗰𝗰𝗼𝘂𝗻𝘁 - /myacc\n⌗ 𝗯𝗶𝗻 𝗹𝗼𝗼𝗸𝘂𝗽 - /bin\n⌗ 𝗯𝗶𝗻 𝗴𝗲𝗻 - /gen";
	sendMes($chatId, $message, $message_id);
	exit();
}

#COMANDO DE INFO

if (strpos($message, "!info") === 0 || strpos($message, "/info") === 0) {
	$message = "[✦] 𝗶𝗻𝗳𝗼\n\n⌗ 𝘂𝘀𝗲𝗿𝗻𝗮𝗺𝗲: - @$username\n⌗ 𝘂𝘀𝗲𝗿𝗜𝗗: -	$userId\n⌗ 𝗴𝗿𝗼𝘂𝗽𝗜𝗗:	$chatId\n\n𝗯𝗼𝘁 𝗯𝘆: @arterxsk";
	sendMes($chatId, $message, $message_id);
	exit();
}

#COMANDO PARA SABER EL TIEMPO RESTANTE DEL GRUPO
if (strpos($message, "!mygroup") === 0 || strpos($message, "/mygroup") === 0) {
	VerificarChatID($chatId); #THIS FUNCTION CHECKS IF THE USER OR GROUP IS ADDED	TO USE THE BOT.
	MyGroup($chatId);
	exit();
}

#COMANDO PARA SABER EL TIEMPO RESTANTE DEL USER

if (strpos($message, "!myacc") === 0 || strpos($message, "/myacc") === 0) {
	VerificarChatID($chatId); #THIS FUNCTION CHECKS IF THE USER OR GROUP IS ADDED	TO USE THE BOT.
	MyAccount($userId);
	exit();
}

#COMANDO DE BINLOOKUP /bin o !bin

if (strpos($message, "!bin") === 0 || strpos($message, "/bin") === 0) {
	$Gateway = 'BIN Lookup'; #YOU MUST CHANGE THIS IF YOU USE ANOTHER COMMAND,	LEAVE IT LIKE THIS FOR THE BIN ONE.
	$Archivo = 'BinLookup.php'; #YOU MUST CHANGE THIS TO THE NAME OF YOUR NEW FILE	IF YOU USE ANOTHER COMMAND.
	VerificarChatID($chatId); #THIS FUNCTION CHECKS IF THE USER OR GROUP IS ADDED	TO USE THE BOT.
	$Card = GetCard($message); #THIS FUNCTION IS USED TO TAKE THE CARD OUT OF THE	COMMAND.
	ConsultaAPI($Archivo, $Card); #THIS FUNCTION CONSULTS THE API DEPENDING ON THE	NAME OF THE FILE, IN THIS CASE "BinLookup.php".
	Respuesta($Gateway, $Resultado, $Rank); #THIS FUNCTION IS USED TO VERIFY THE	TYPE OF RESPONSE TO SEND TO THE USER.
	exit();
}

#CC CHECK COMMAND /chk or !chk

if (strpos($message, "!chk") === 0 || strpos($message, "/chk") === 0) {
	$Gateway = 'Stripe Auth';
	$Archivo = 'StripeAuth.php';
	VerificarChatID($chatId);
	Premium();
	$Card = GetCard($message);
	ConsultaAPI($Archivo, $Card);
	Respuesta($Gateway, $Resultado, $Rank);
	exit();
}

#COMMAND TO GENERATE CCs /gen or !gen

if (strpos($message, "!gen") === 0 || strpos($message, "/gen") === 0) {
	$Gateway = 'Stripe Auth';
	$Archivo = 'StripeAuth.php';
	VerificarChatID($chatId);
	$Card = GetCard($message);
	ConsultaAPI($Archivo, $Card);
	Respuesta($Gateway, $Resultado, $Rank);
	exit();
}