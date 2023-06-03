<?php
error_reporting(0);

$bin = $_GET['lista'];

print_r(_ccs($bin));

#FUNCIONES REQUERIDAS

function _ccs($bin) {
	if (!is_numeric(substr($bin, 0, 6))) {
		return "*invalid format!*\n*Example:* `/gen 552289` or\n`!gen 552289xxxxxxxxxx`";
	} else {
		for ($i = 1; $i <= 10; $i++) {
			$cc[$i] = _cc();
		}
		return "<code>".$cc[1]."</code>-<code>".$cc[2]."</code>-<code>".$cc[3]."</code>-<code>".$cc[4]."</code>-<code>".$cc[5]."</code>-<code>".$cc[6]."</code>-<code>".$cc[7]."</code>-<code>".$cc[8]."</code>-<code>".$cc[9]."</code>-<code>".$cc[10]."</code>";
	}
}

function _cc() {
	_ccgen();
	return $GLOBALS["ccnum"] . "|" . $GLOBALS["month"] . "|" . $GLOBALS["year"] . "|" . $GLOBALS["cvv"];
}

function _ccgen() {
	_gencc();
	_gencvv();
	_genmes();
	_genano();
}

function _gencc() {
	if (substr_compare($GLOBALS["bin"], 37, 0, 2)) {
		$ccbin = preg_replace("/[^0-9x]/", "", substr($GLOBALS["bin"], 0, 15));
		for ($i = 0; $i < strlen($ccbin); $i++) {
			if ($ccbin[$i] == "x") {
				$ccbin[$i] = mt_rand(0, 9);
			}
		}
		$GLOBALS["ccnum"] = _ccgenNumber($ccbin, 16);
	} else {
		$ccbin = preg_replace("/[^0-9x]/", "", substr($GLOBALS["bin"], 0, 14));
		for ($i = 0; $i < strlen($ccbin); $i++) {
			if ($ccbin[$i] == "x") {
				$ccbin[$i] = mt_rand(0, 9);
			}
		}
		$GLOBALS["ccnum"] = _ccgenNumber($ccbin, 15);
	}
}

function _gencvv() {
	if (substr_compare($GLOBALS["bin"], 37, 0, 2)) {
		$GLOBALS["cvv"] = mt_rand(112, 998);
	} else {
		$GLOBALS["cvv"] = mt_rand(1102, 9998);
	}
}

function _genmes() {
	$moth = mt_rand(1, 12);
	$GLOBALS["month"] = (($moth < 10) ? '0' . $moth : $moth);
}

function _genano() {
	$GLOBALS["year"] = mt_rand(2022, 2025);
}

function _ccgenNumber($prefix, $length) {
	$ccnumber = $prefix;
	while (strlen($ccnumber) < ($length - 1)) {
		$ccnumber .= mt_rand(0, 9);
	}
	$sum = 0;
	$pos = 0;
	$reversedCCnumber = strrev($ccnumber);
	while ($pos < $length - 1) {
		$odd = $reversedCCnumber[$pos] * 2;
		if ($odd > 9) {
			$odd -= 9;
		}
		$sum += $odd;
		if ($pos != ($length - 2)) {
			$sum += $reversedCCnumber[$pos + 1];
		}
		$pos += 2;
	}
	$checkdigit = ((floor($sum / 10) + 1) * 10 - $sum) % 10;
	$ccnumber .= $checkdigit;
	return $ccnumber;
}