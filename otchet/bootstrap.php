<?php
//Объединение подключения конфига,подключения и функций в один файл
$config = require_once "config.php";

$login = $_POST["login"]??"";
$nickname = $_POST["nickname"]??"";
$password = $_POST["password"]??"";

require_once "connection.php";
require_once "UserData.php";


$user = new UserData(Connection::make($config));