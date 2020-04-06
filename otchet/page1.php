<?php
require_once "bootstrap.php";
if(isset($_POST["btnOUT"])){
	$user->logOut();
	$_SESSION['auth']=false;
	header("Location:index.php");
}
if(isset($_POST["btnSIMG"])){
	$user->uploadFile();
}
$user->loadFiles();
require_once "css.css";
?>
<form method="post" enctype="multipart/form-data">
<p><label for="avatar">
</label></p>
<p><input type="file" id="avatar" name="avatar"></p>
<p><input type="submit" name='btnSIMG'></p>
<p><input type="submit" name="btnOUT" value="ВЫЙТИ"></p>
</form>