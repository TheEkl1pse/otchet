<?php
require_once "bootstrap.php";
    if($login!=null && $password!=null && $nickname!=null){
        $user->regUser($_POST['login'], $_POST['password'],$_POST['nickname']);         
        $_SESSION["noerror"] = "Вы успещно зарегистрированы";
        header("Location: index.php");        
        }
    
    else{
        if(isset($_POST["btnREG"])){
            $error = "Поля не заполнены";
        }
    }
require_once "css.css";

?>
<form method="post">
<h2>RegistratioN</h2>
<p class='regerr'color='red'><?= $error ?></p>
<h3>LOGIN:</h3>
<p><input type='text'name="login"></p>
<h3>PASSWORD:</h3>
<p><input type="password" name="password"></p>
<h3>NICKNAME:</h3>
<p><input type='text'name="nickname"></p>
<input  type="submit" href="login.php" name="btnREG">
<p>
<input type="button" value="Вход" onClick="window.location='index.php'">
</p>
</form>