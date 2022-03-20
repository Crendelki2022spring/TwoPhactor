<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru">

<head>

	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
	<link href="style.css" rel="stylesheet" />
	<title>Аутентификация через GitHub</title>

</head>

<body>
	<header>
		<img src="files/LetterA.png" class="A_picture" width="50" height="50">
	</header>
	<?php

	$params = array(
		'client_id'     => 'e8ebae2565eb786ceb93',
		'redirect_uri'  => 'http://hellohahat.beget.tech/odnok.php
	',
		'scope'         => 'user',
		'response_type' => 'code',
		'state'         => ''
	);

	$url = 'https://github.com/login/oauth/authorize?' . urldecode(http_build_query($params));
	echo '<legend> Подтвердите свою личность </legend> 
	<p class="GreyText">Войдите в вашу учетную запись на GitHub</p>
	<div class="image">    
	<img src="files/Git.jpg" width="100" height="100"> </div> </br>
	<p class="space">
		<a href="' . $url . '">Аутентификация через GitHub</a>
	</p>';


	if (!empty($_GET['code'])) {
		$params = array(
			'client_id'     => 'e8ebae2565eb786ceb93',
			'client_secret' => 'Client_secrets',
			'redirect_uri'  => 'http://hellohahat.beget.tech/odnok.php',
			'code'          => $_GET['code']
		);

		$ch = curl_init('https://github.com/login/oauth/access_token');
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, urldecode(http_build_query($params)));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_HEADER, false);
		$data = curl_exec($ch);
		curl_close($ch);
		parse_str($data, $data);

		if (!empty($data['access_token'])) {
			$ch = curl_init('https://api.github.com/user');
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: token ' . $data['access_token']));
			curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88');
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			$info = curl_exec($ch);
			curl_close($ch);
			$info = json_decode($info, true);

			if (!empty($info['id'])) {
				print_r($info);
			}
		}
	}

	?>

</body>

</html>