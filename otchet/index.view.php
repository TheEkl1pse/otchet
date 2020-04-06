<form method="post">
    <p class='reggood'color='red'><?= $_SESSION["noerror"] ?></p>
	<p><h3>Login:</h3></p>
	<p><input type="text" name="login"></p>
	<p><h3>Password:</h3></p>
	<p><input type="password" name="password"></p>
	<p><input type="submit" name="btnOK"><input type="button" onClick="window.location='register.php'" value="Регистрация"></p>
</form>