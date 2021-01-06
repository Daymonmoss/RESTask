<?php
require 'model.php';

$array = file_get_contents("php://input");

$usersIds = json_decode($array, true);

$data = $array . "\n" . $usersIds;
$filename = 'incomingdelete.txt';
file_put_contents($filename, $data);

if (!is_array($usersIds))
{
    deleteUser($usersIds);
} else
{
    deleteUsers($usersIds);
}
