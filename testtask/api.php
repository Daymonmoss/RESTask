<?php
require "model.php";

$user_id = $_GET['user_id'];
$api_key = $_GET['api_key'];


if(!isset($api_key)){
    echo json_encode(
        array(
            'code' 	  => 1,
            'message' => 'API key is required.'
        )
    );

    die();
}

if(strlen($api_key) != 10){
    echo json_encode(
        array(
            'code' 	  => 2,
            'message' => 'API key is invalid.'
        )
    );

    die();
}

$q = $apiconn->query("SELECT date_generated FROM api_keys WHERE api_key = '$api_key' AND is_valid = 1");

if($q->num_rows == 0){
    echo json_encode(
        array(
            'code' 	  => 3,
            'message' => 'API key is invalid.'
        )
    );

    die();
}


$d_generated = $q->fetch_assoc()['date_generated'];
$d_expires   = strtotime($d_generated . '+30 days');
$d_today     = strtotime($date);

if($d_today >= $d_expires){


    $apiconn->query("UPDATE api_keys SET is_valid = 0 WHERE api_key = '$api_key'");

    echo json_encode(
        array(
            'code' 	  => 4,
            'message' => 'API key has expired.'
        )
    );

    die();
}


if(!isset($user_id)){
    $q = getUsers();
    } else {
    $q = $apiconn->query("SELECT * FROM users WHERE id='$user_id'")->fetch_assoc();
}



if($q === null){
    echo json_encode(
        array(
            'code' 	  => 6,
            'message' => 'User doesn\'t exist.'
        )
    );

    die();
}

print_r(
    json_encode(
        $q
    )
);

