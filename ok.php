<?php


$user_code = $_POST['user_code'];
$code ='123123';
if($code != $user_code) {
    echo 'Error';
} else {
    header('location: allnice.html');
}

?>