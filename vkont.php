<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru">

<head>

    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
    <link href="style.css" rel="stylesheet" />
    <title></title>

</head>

<body>
    <header>
        <img src="files/LetterA.png" class="A_picture" width="50" height="50">
    </header>
    <?php



    $client_id = '8107929'; // ID приложения

    $client_secret = 'GqScU1AznxsIObw2i0D8'; // Защищённый ключ

    $redirect_uri = 'http://hellohahat.beget.tech/git.php'; // Адрес сайта



    $url = 'http://oauth.vk.com/authorize';



    $params = array(

        'client_id'     => $client_id,

        'redirect_uri'  => $redirect_uri,

        'response_type' => 'code'

    );



    echo $link = '<legend> Подтвердите свою личность </legend> 
    <p class="GreyText">Войдите в вашу учетную запись ВКонтакте</p>
    <div class="image">    
    <img src="files/VK.jpg" width="100" height="100"> </div> </br>
    <p class="space">
    <a href="' . $url . '?' . urldecode(http_build_query($params)) . '">Аутентификация через ВКонтакте</a>
    </p>';



    if (isset($_GET['code'])) {

        $result = false;

        $params = array(

            'client_id' => $client_id,

            'client_secret' => $client_secret,

            'code' => $_GET['code'],

            'redirect_uri' => $redirect_uri

        );



        $token = json_decode(file_get_contents('https://oauth.vk.com/access_token' . '?' . urldecode(http_build_query($params))), true);



        if (isset($token['access_token'])) {

            $params = array(

                'uids'         => $token['user_id'],

                'fields'       => 'uid,first_name,last_name,screen_name,sex,bdate,photo_big',

                'access_token' => $token['access_token']

            );



            $userInfo = json_decode(file_get_contents('https://api.vk.com/method/users.get' . '?' . urldecode(http_build_query($params))), true);

            if (isset($userInfo['response'][0]['uid'])) {

                $userInfo = $userInfo['response'][0];

                $result = true;
            }
        }
    }



    ?>
</body>

</html>