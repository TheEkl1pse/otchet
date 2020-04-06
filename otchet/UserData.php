<?php
session_start();
class UserData{	
	public $pdo;
	public function __construct(PDO $pdo){
		$this->pdo = $pdo;
	}	
	public function findUser($login,$password){		
		$q = "SELECT * FROM users WHERE login=:login and password=:password";
		$stmt=$this->pdo->prepare($q);
		$stmt->execute(["login"=>$login,"password"=>$password]);		
		return $stmt->fetch();
		$res = $stmt->fetch();		
	}
	
	public function usersInfo(){
		$q = "SELECT * FROM users WHERE login=:login and password=:password and nickname=:nickname and id_users=:id_users";
		$stmt=$this->pdo->prepare($q);
		$stmt->execute(["login"=>$login,"password"=>$password,"nickname"=>$nickname,"id_users"=>$id_users]);
		$_SESSION["login"] = $login;
		$_SESSION["password"] = $password;
		$_SESSION["nickname"] = $nickname;	
		$_SESSION["id"] = $id_users;		
		return $stmt->fetchAll();
		$res = $stmt->fetchAll();	
		

	}

	public function loginUser($login,$password){
		$res = $this->findUser($login,$password);
		if($res){
			$_SESSION['auth']=true;
			$_SESSION['id'] = $res->id_users;
		}
			else{$_SESSION['auth']=false;}
		}

	public function regUser($login,$password,$nickname){
		$res = $this->findUser($login,$password);
		if($res){
			$_SESSION['error'] = "Ошибка";
		}
		else{				
			$z = "INSERT INTO users(nickname,login,password) VALUES(:nickname,:login,:password)";
			$q = $this->pdo -> prepare($z);
			$q -> execute(["nickname"=>$nickname,"login"=>$login,"password"=>$password]); 
			$error = "Аккаунт был успешно создан";
		}
	}
	
	public function loadFiles(){		
		$q = "SELECT name_img FROM images WHERE id_users=?";
				$stmt=$this->pdo->prepare($q);
		$stmt->execute([$_SESSION["id"]]);
		$res = $stmt->fetchAll();			
		$_SESSION["img"] = $res;
		foreach($res as $item){
		?>	<img src="upload/<?= $item -> name_img ?>"><?	
		}
		
	
	}

	public function uploadFile(){
		function loadInJson($pos){
			$datajs = [
							"name"=>$_FILES['avatar']['name'],
							"tmp_name"=>$_FILES['avatar']['tmp_name'],                    
							
			];
			$tj = json_encode($datajs, JSON_UNESCAPED_UNICODE);
			$fo = fopen('file.json', "r+");
			if($fo){
				fseek($fo,0,SEEK_END);
				if(ftell($fo)>0){
					fseek($fo,-1,SEEK_END);
					$s=",".$tj."]\n";
				}
				else{
					$s="[".$tj."]\n";
				}
				fwrite($fo,$s);
			};
			fclose($fo);
		};
		$id_users = $_SESSION["id"];
		$errors = [];
		if(isset($_POST['btnSIMG'])){
			if(isset($_FILES['avatar'])){
				$fname = $_FILES['avatar']['name'];
				$tmpname = $_FILES['avatar']['tmp_name'];
		
				$array = explode('.',$fname);
				$ext = strtolower(end($array));
				$name = $array[0];
				$name.= rand(1,1000000);
				$extensions = ['jpg','jpeg','png','gif'];
				if(in_array($ext,$extensions)){
					if($fsize<=5000000){
						if($ferror==0){
							$newname = $name.".".$ext;
							if(move_uploaded_file($tmpname,"upload/$newname")){								
								$z = "INSERT INTO images(name_img,id_users) VALUES(:name_img,:id_users)";
								$q = $this->pdo -> prepare($z);								
								$q -> execute(["name_img"=>$newname,"id_users"=>$id_users]); 								
								loadInJson("file.json");
							} 
						}else{$errors[]='Ошибка загрузки файла';}
					}else{$errors[]="Недопустимый размер файла";}
				}else{$errors[]="Недопустимый тип файла";}
		
				header("Location:page1.php");
			}
		}
	}
	
	
	
	public function logOut(){
		unset($_SESSION['auth']);
		session_destroy();
	}	
}