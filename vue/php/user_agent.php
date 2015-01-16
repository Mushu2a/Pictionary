<?php

$user_agent = $_SERVER['HTTP_USER_AGENT'];

/*
* Fonction permetant de récupérer l'OS client
*/
function getOS() {

	global $user_agent;
	$os_platform = "OS inconnu";

	$os_array = array(
		'/windows nt 6.3/i'		=>	'Windows',
		'/windows nt 6.2/i'		=>	'Windows',
		'/windows nt 6.1/i'		=>	'Windows',
		'/windows nt 6.0/i'		=>	'Windows',
		'/windows nt 5.2/i'		=>	'Windows',
		'/windows nt 5.1/i'		=>	'Windows',
		'/windows xp/i'			=>	'Windows',
		'/macintosh|mac os x/i'	=>	'MacOS',
		'/mac_powerpc/i'		=>	'MacOS',
		'/linux/i'				=>	'Linux',

		/* version mobile pas utilisé ici
		'/iphone/i'				=>	'iPhone',
		'/ipod/i'				=>	'iPod',
		'/ipad/i'				=>	'iPad',
		'/android/i'			=>	'Android',
		'/blackberry/i'			=>	'BlackBerry',
		'/webos/i'				=>	'Mobile'*/
	);

	foreach ($os_array as $regex => $value) { 

		if (preg_match($regex, $user_agent)) {
			$os_platform = $value;
		}

	}

	return $os_platform;

}

/*
* Fonction permetant de récupérer le navigateur utiliser
*/
function getBrowser() {

	global $user_agent;
	$browser = "Navigateur inconnu";

	$browser_array = array(
		'/msie/i'		=>	'IE',
		'/firefox/i'	=>	'Firefox',
		'/safari/i'		=>	'Safari',
		'/chrome/i'		=>	'Chrome',
		'/opera/i'		=>	'Opera'
	);

	foreach ($browser_array as $regex => $value) { 

		if (preg_match($regex, $user_agent)) {
		$browser = $value;
		}

	}

	return $browser;

}

?>