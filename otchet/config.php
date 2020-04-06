<?php
//Данные для подключения к БД
return [
	"host" => "localhost",
	"db" => "log_in",
	"login" => "root",
	"password" => "",
	"opt" => [
		PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
			]
		];