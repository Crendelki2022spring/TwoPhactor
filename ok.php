<?php

$user_codes = $_POST['user_code'];
$code = 'hbGVgv3BU';

if($code != $user_codes) {
    echo 'Error';
} else {
    header('location: odnoklassniki.php');
}

?>