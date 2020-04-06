<?php
require_once "bootstrap.php";
$user->usersInfo();
$user->findUser(admin,admin);
var_dump($_SESSION["login"]);
echo $_SESSION["login"]." ".$_SESSION["password"]." ".$_SESSION["id"].$_SESSION["nickname"];	