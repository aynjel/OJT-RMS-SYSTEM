<?php

require_once('classes/API_AutoLoader.php');

$change_password = new OTPVerify();

$user_id = $_GET['user_id'];
$password = $_GET['password'];

$result = $change_password->changePassword($user_id, $password);

if($result == 'Please fill in all fields'){
    echo $result;
}elseif($result == 'Password changed'){
    echo $result;
}else{
    echo $result;
}