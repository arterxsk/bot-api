<?php

date_default_timezone_set('America/Lima');

#FUNCTION TO SEND MESSAGES

function sendMes($chatId, $message, $message_id) {
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, 'https://api.telegram.org:443/bot'.$GLOBALS['botToken'].'/sendMessage');
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_HTTPHEADER, [
		'Content-Type: application/json',
		'HTTP/1.1 200 OK'
	]);
	curl_setopt($ch, CURLOPT_POSTFIELDS, '{"chat_id":"'.$chatId.'","text":"'.$message.'","reply_to_message_id":"'.$message_id.'","parse_mode":"HTML"}');
	$result = curl_exec($ch);
}

#FUNCTION TO ADD CHAT-IDs (USERS OR GROUPS)

function verAdmin($userId) {
	$file = array_values(array_unique(file('Users/Admins.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES)));
	foreach ($file as $key => $value) {
		if ($value == $userId) {
			$Admin = true;
			$GLOBALS['Admin'] = $Admin;
			break;
		} else {
			$Admin = false;
			$GLOBALS['Admin'] = $Admin;
		}
	}
}

#FUNCTION TO VERIFY PREMIUM

function VerificarPremium($Time) {
	global $chatId,
	$username,
	$userId,
	$message_id,
	$_artID,
	$Admin;
	$TiempoActual = time();
	if ($TiempoActual > $Time) {
		$file = array_values(array_unique(file('Users/Premium.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES)));
		$out = [];
		foreach ($file as $line) {
			$user_value = explode("|", $line)[0];
			if ($user_value == $userId) {
				$delete[] = $line;
			} else {
				$out[] = $line;
			}
		}
		$fp = fopen('./Users/Premium.txt', "w+");
		foreach ($out as $line) {
			fwrite($fp, $line . PHP_EOL);
		}
		fclose($fp);
		$Rank = 'USER';
		$GLOBALS['Rank'] = $Rank;
	}
}

#FUNCTION TO VERIFY GROUP PREMIUM

function VerificarPremiumGrupo($Time) {
	global $chatId,
	$username,
	$userId,
	$message_id,
	$_artID,
	$Admin;
	$TiempoActual = time();
	if ($TiempoActual > $Time) {
		$file = array_values(array_unique(file('Users/Premium.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES)));
		$out = [];
		foreach ($file as $line) {
			$user_value = explode("|", $line)[0];
			if ($user_value == $chatId) {
				$delete[] = $line;
			} else {
				$out[] = $line;
			}
		}
		$fp = fopen('./Users/Premium.txt', "w+");
		foreach ($out as $line) {
			fwrite($fp, $line . PHP_EOL);
		}
		fclose($fp);
		$Rank_Group = 'USER';
		$GLOBALS['Rank_Group'] = $Rank_Group;
	}
}

#WORKS TO ADD CHAT-IDs (USERS OR GROUPS)

function AñadirChatID($data) {
	$file = fopen("Users/ChatIDs.txt", "a+");
	fwrite($file, $data . PHP_EOL);
	fclose($file);
}

#FUNCTION TO UPGRADE THE RANK TO PREMIUM (USERS)

function PremiumChatID($data) {
	$user = explode("|", $data)[0];
	$time = explode("|", $data)[1];
	$time = $time*24*3600;
	$time = time() + $time;
	$file = fopen("Users/Premium.txt", "a+");
	fwrite($file, $user.'|'.$time.'|'.time() . PHP_EOL);
	fclose($file);
}

#FUNCTION TO RAISE THE RANK TO ADMINISTRATOR (USERS)

function SetAdmin($data) {
	$file = fopen("Users/Admins.txt", "a+");
	fwrite($file, $data . PHP_EOL);
	fclose($file);
}

#FUNCTION TO BAN USERS

function Ban($data) {
	$file = fopen("Users/Banned.txt", "a+");
	fwrite($file, $data . PHP_EOL);
	fclose($file);
}

#FUNCTION TO UNBAN USER

function Unban($data) {
	$file = array_values(array_unique(file('Users/Banned.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES)));
	$out = [];
	foreach ($file as $line) {
		if ($line == $data) {
			$delete[] = $line;
		} else {
			$out[] = $line;
		}
	}
	$fp = fopen('./Users/Banned.txt', "w+");
	foreach ($out as $line) {
		fwrite($fp, $line . PHP_EOL);
	}
	fclose($fp);
}

#FUNCTION TO VERIFY THE GROUP TIME

function MyGroup($chatId) {
	global $Rank,
	$chatId,
	$username,
	$userId,
	$Rank_Group;

	if ($chatId == $userId) {
		$message = "This command is only supported for Groups.";
		sendMes($chatId, $message, $message_id);
		exit();
	} elseif ($Rank_Group == "USER") {
		$tiempo_inicio = "Return premium to your group and unlock new commands!\n";
		$tiempo_final = "";
		$texto3 = "If any error occurs, talk to @arterxsk";
	} else {
		$file = array_values(array_unique(file('Users/Premium.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES)));

		foreach ($file as $value) {
			$user_id = explode("|", $value)[0];
			$tiempo_inicio = explode("|", $value)[2];
			$tiempo_final = explode("|", $value)[1];
			if ($user_id == $chatId) {
				$tiempo_inicio = "Start date of your plan: ".date("d-m-Y", $tiempo_inicio)."\n";
				$tiempo_final = "Expiration date: ".date("d-m-Y", $tiempo_final)."\n";
				$texto3 = "If any error occurs, talk to @arterxsk";
				break;
			}
		}
	}

	$message = "GroupID: $chatId \n$tiempo_inicio$tiempo_final$texto3";
	sendMes($chatId, $message, $message_id);
	exit();
}

#FUNCION PARA VERIFICAR EL TIEMPO

function MyAccount($userId) {
	global $Rank,
	$chatId,
	$username;

	if ($Rank == 'OWNER' || $Rank == 'ADMIN') {
		$tiempo_inicio = "Start date of your plan: Does not apply for ". $Rank."s\n";
		$tiempo_final = "Expiration date: Does not apply to ". $Rank."s\n";
		$texto3 = "If any error occurs, talk to @arterxsk";
	} elseif ($Rank == 'USER') {
		$tiempo_inicio = "Go premium and unlock new commands!";
		$tiempo_final = "";
		$texto3 = "\nIf any error occurs, talk to @arterxsk";
	} else {
		$file = array_values(array_unique(file('Users/Premium.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES)));

		foreach ($file as $value) {
			$user_id = explode("|", $value)[0];
			$tiempo_inicio = explode("|", $value)[2];
			$tiempo_final = explode("|", $value)[1];
			if ($user_id == $userId) {
				$tiempo_inicio = "Start date of your plan: ".date("d-m-Y", $tiempo_inicio)."\n";
				$tiempo_final = "Expiration date: ".date("d-m-Y", $tiempo_final)."\n";
				$texto3 = "If any error occurs, talk to @arterxsk";
				break;
			}
		}
	}

	$message = "User: @".$username."[".$userId."]{".$Rank."}\n$tiempo_inicio$tiempo_final$texto3";
	sendMes($chatId, $message, $message_id);
	exit();
}

#FUNCTION TO BAN USERS

function Delete($data) {
	$file = array_values(array_unique(file('Users/ChatIDs.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES)));
	$out = [];
	foreach ($file as $line) {
		if ($line == $data) {
			$delete[] = $line;
		} else {
			$out[] = $line;
		}
	}
	$fp = fopen('./Users/ChatIDs.txt', "w+");
	foreach ($out as $line) {
		fwrite($fp, $line . PHP_EOL);
	}
	fclose($fp);
}

#FUNCTION TO VERIFY CHAT-IDs (USERS OR GROUPS)

function VerificarChatID($chatId) {
	global $chatId,
	$username,
	$userId,
	$message_id,
	$_artID,
	$Admin;

	$file = array_values(array_unique(file('Users/Banned.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES)));
	foreach ($file as $key => $value) {
		if ($value == $userId) {
			$message = "YOU HAVE BEEN BANNED BY THE ADMIN OF THIS BOT BECAUSE YOU DID	SOMETHING WRONG‼️\nTo request access contact @arterxsk";
			sendMes($chatId, $message, $message_id);
			exit();
		}
	}

	if ($chatId == $_artID || $userId == $_artID) {
		$Rank = 'OWNER';
		$GLOBALS['Rank'] = $Rank;
	} elseif ($Admin == true) {
		$Rank = 'ADMIN';
		$GLOBALS['Rank'] = $Rank;
	} elseif ($chatId == $userId) {
		$file = array_values(array_unique(file('Users/ChatIDs.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES)));
		foreach ($file as $key => $value) {
			if ($value == $userId) {
				$verificacion = 'Añadido';
				break;
			}
		}
		if ($verificacion == 'Añadido') {
			$file = array_values(array_unique(file('Users/Premium.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES)));
			foreach ($file as $key => $value) {
				$value_id = explode("|", $value)[0];
				$Time = explode("|", $value)[1];
				if ($value_id == $userId) {
					$Rank = 'PREMIUM';
					$GLOBALS['Rank'] = $Rank;
					VerificarPremium($Time);
					break;
				} else {
					$Rank = 'USER';
					$GLOBALS['Rank'] = $Rank;
				}
			}
		} else {
			$message = "[𝗲𝗿𝗿𝗼𝗿] You don’t have permission. Contact @arterxsk to buy	a premium access or to make a deal.";
			sendMes($chatId, $message, $message_id);
			exit();
		}
	} elseif ($chatId != $userId) {
		$file = array_values(array_unique(file('Users/ChatIDs.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES)));
		foreach ($file as $key => $value) {
			if ($value == $chatId) {
				$verificacion = 'Añadido';
				break;
			} else {
				$verificacion = 'No Añadido';
			}
		}
		if ($verificacion == 'No Añadido') {
			$file = array_values(array_unique(file('Users/ChatIDs.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES)));
			foreach ($file as $key => $value) {
				if ($value == $userId) {
					$verificacion = 'Añadido';
					break;
				}
			}
		}
		if ($verificacion == 'Añadido') {
			$file = array_values(array_unique(file('Users/Premium.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES)));
			foreach ($file as $key => $value) {
				$value_id = explode("|", $value)[0];
				$Time = explode("|", $value)[1];
				if ($value_id == $chatId) {
					$Rank_Group = 'PREMIUM';
					$GLOBALS['Rank_Group'] = $Rank_Group;
					VerificarPremiumGrupo($Time);
					break;
				} else {
					$Rank_Group = 'USER';
					$GLOBALS['Rank_Group'] = $Rank_Group;
				}
			}
			$file = array_values(array_unique(file('Users/Premium.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES)));
			foreach ($file as $key => $value) {
				$value_id = explode("|", $value)[0];
				$Time = explode("|", $value)[1];
				if ($value_id == $userId) {
					$Rank = 'PREMIUM';
					$GLOBALS['Rank'] = $Rank;
					VerificarPremium($Time);
					break;
				} else {
					$Rank = 'USER';
					$GLOBALS['Rank'] = $Rank;
				}
			}
		} else {
			$message = "[𝗲𝗿𝗿𝗼𝗿] You don’t have permission. Contact @arterxsk to buy a premium access or to make a deal.";
			sendMes($chatId, $message, $message_id);
			exit();
		}
	}
}

#FUNCION PARA VERIFICAR PREMIUM

function Premium() {
	global $chatId,
	$username,
	$userId,
	$message_id,
	$_artID,
	$Admin,
	$Rank,
	$Rank_Group;
	if ($userId == $_artID || $chatId == $_artID || $Admin == true || $Rank_Group == 'PREMIUM' || $Rank == 'PREMIUM') {} else {
		$message = "[𝗲𝗿𝗿𝗼𝗿] You don’t have permission. Contact @arterxsk to buy a	premium access or to make a deal.";
		sendMes($chatId, $message, $message_id);
		exit();
	}
}

#FUNCTION TO REMOVE CARD WITH ANY COMMAND

function GetCard($message) {
	$clean = explode(" ", $message)[1];
	return $clean;
}

#FUNCTION TO QUERY API

function ConsultaAPI($Archivo, $Card) {
	$server = $_SERVER['SERVER_NAME'];
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, 'https://'.$server.'/Apis/'.$Archivo.'?lista='.$Card);
	curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
	curl_setopt($ch, CURLOPT_HTTPHEADER, []);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_VERBOSE, 1);
	$Resultado = curl_exec($ch);
	$GLOBALS['Resultado'] = $Resultado;
}

#FUNCTION TO QUERY API

function Respuesta($Gateway, $Resultado, $Rank) {
	global $chatId,
	$username,
	$userId,
	$message_id,
	$Archivo,
	$Rank;

	if ($Gateway == 'Card Generator' || $Archivo == 'CardGenerator.php') {
		$Resultado = str_replace("-", "\n", $Resultado);
		$Resultado = "Card Generator:\n".$Resultado;
		sendMes($chatId, $Resultado, $message_id);
	} else {
		preg_match_all('/\[(.*?)\] => (.*?)\./', $Resultado, $output_array);

		$x = 0;

		do {
			$array_nuevo[''.$output_array[1][$x].''] = $output_array[2][$x];
			$x++;
		} while (!empty($output_array[0][$x]));

		$Card = $array_nuevo['Card'];
		$Status = $array_nuevo['Status'];
		$Bin = $array_nuevo['Bin'];
		$Scheme = $array_nuevo['Scheme'];
		$Tipo = $array_nuevo['Tipo'];
		$Brand = $array_nuevo['Brand'];
		$Pais = $array_nuevo['Pais'];
		$Banco = $array_nuevo['Banco'];
		$Bandera = $array_nuevo['Bandera'];
		$Currency = $array_nuevo['Currency'];

		if ($Gateway == 'BIN Lookup' || $Archivo == 'BinLookup.php') {
			$message = "[✦] 𝗯𝗶𝗻 𝗶𝗻𝗳𝗼\n\n⌗ 𝗯𝗶𝗻: $Bin\n⌗ 𝗶𝗻𝗳𝗼: $Scheme - $Tipo - $Brand\n⌗ 𝗯𝗮𝗻𝗸: $Banco\n⌗ 𝗰𝗼𝘂𝗻𝘁𝗿𝘆: $Pais $Bandera\n⌗ 𝗰𝘂𝗿𝗿𝗲𝗻𝗰𝘆: $Currency\n⌗ 𝗰𝗵𝗲𝗰𝗸𝗲𝗱 𝗯𝘆: $username { $Rank }\n\n𝗯𝗼𝘁 𝗯𝘆: @arterxsk";
			sendMes($chatId, $message, $message_id);
		} else {
			$message = "[✦] 𝗰𝗮𝗿𝗱 𝗶𝗻𝗳𝗼\n\n⌗ 𝗴𝗮𝘁𝗲𝘄𝗮𝘆: $Bin\n\n[✦] 𝗯𝗶𝗻 𝗱𝗲𝘁𝗮𝗶𝗹𝘀⌗ 𝗯𝗶𝗻: $Bin\n⌗ 𝗶𝗻𝗳𝗼: $Scheme - $Tipo - $Brand\n⌗ 𝗯𝗮𝗻𝗸: $Banco\n⌗ 𝗰𝗼𝘂𝗻𝘁𝗿𝘆: $Pais $Bandera\n⌗ 𝗰𝘂𝗿𝗿𝗲𝗻𝗰𝘆: $Currency\n⌗ 𝗰𝗵𝗲𝗰𝗸𝗲𝗱 𝗯𝘆: $username { $Rank }\n\n𝗯𝗼𝘁 𝗯𝘆: @arterxsk";
			sendMes($chatId, $message, $message_id);
		}
	}
}