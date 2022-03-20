<?php

$user_codes = $_POST['user_code'];

session_start();

$code = $_SESSION['acode'];

if($code != $user_codes) {
    header("Location: /thank-you.php?formsubmit");
} else {
    header('location: odnoklassniki.php');
}


?>