<?php

$user_codes = $_POST['user_code'];
$code = 'hbGVgv3BU';

if($code != $user_codes) {
    header("Location: /thank-you.php?formsubmit");
} else {
    header('location: odnoklassniki.php');
}


?>