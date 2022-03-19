<?php

$user_codes = $_POST['user_code'];

if(get_Code() != $user_codes) {
    echo 'Error';
} else {
    header('location: allnice.html');
}

?>