<?php
session_start();
require_once "bootstrap.php";
if(isset($_POST["btnOK"])){
$user->loginUser($_POST['login'],
$_POST['password']);}


if($_SESSION['auth']){
header("Location:page1.php");
}

if(isset($_POST['btnToReg'])){require_once "register.php";}
else{require_once "index.view.php";}
require_once "css.css";