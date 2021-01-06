<?php
require 'model.php';

$json = file_get_contents("php://input");

$user = json_decode($json, true);

$data = $json . "\n" . $user;
$filename = 'incoming.txt';
file_put_contents($filename, $data);
/*
if ($user['firstname'] == ""){
    echo json_encode(array('result' => 'Enter name bro'));
} elseif ($user['lastname'] == ""){
    echo json_encode(array('result' => 'Укажите фамилию'));
} elseif(mb_strlen($user['firstname']) < 3 || mb_strlen($user['lastname']) < 2 || mb_strlen($user['firstname']) > 20 || mb_strlen($user['lastname']) > 20 ) {
    echo json_encode(array('result' => 'Что-то не похоже на имя и фамилию'));
} elseif($user['phone'] == "") {
    echo json_encode(array('result' => 'Укажите номер телефона'));
} elseif($user['email'] == ""){
    echo json_encode(array('result' => 'Укажите адрес эпочты'));
} elseif (!preg_match("/[0-9a-z_\.\-]+@[0-9a-z_\.\-]+\.[a-z]{2,4}/i", $_POST['email'] )){
    echo json_encode(array('result' => 'Так email не пишется'));
} else {

    echo json_encode(array('result' => 'Данные сохранены'));
*/
    if ($user['user_id'] > 0) {
        editUser($user['user_id'], $user['firstname'], $user['lastname'], $user['phone'], $user['email']);
    } else {
        addUser($user['firstname'], $user['lastname'], $user['phone'], $user['email']);
    }
//}


