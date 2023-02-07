<?php


$dbHost = 'localhost';
$dbUsername = 'user';
$dbPassword = 'password';
$dbName = 'HRD';

//Подключение к бд
$db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

//Проверка подключения
if($db->connect_error){
    die("Connection failed: " . $db->connect_error);
}

$dateTime = date("Y-m-d H:i:s");
?>