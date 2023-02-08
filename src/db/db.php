<?php


$dbHost = 'HRD_db';
$dbUsername = 'user';
$dbPassword = 'password';
$dbName = 'HRD';
$dbPort = '3306:3306';

//Подключение к бд
$db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName, $dbPort);

//Проверка подключения
if($db->connect_error){
    die("Connection failed: " . $db->connect_error);
}

$dateTime = date("Y-m-d H:i:s");
?>