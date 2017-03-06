<?php

function show_info($content, $type, $toClose){
	
	$infotype = "";
	
	switch($type){
		case 1:
			$infotype = "danger";
			break;
		case 2:
			$infotype = "success";
			break;
		case 3:
			$infotype = "info";
			break;
	}
	
	if($toClose == 0)
		return "<div class=\"alert alert-".$infotype."\" role=\"alert\">".$content."</div>";
	else
		return "<div class=\"alert alert-".$infotype." alert-dismissible\" role=\"alert\">
		<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Zamknij\"><span aria-hidden=\"true\">&times;</span></button>".$content."</div>";
}

function db_conn(){
	$host = 'localhost';
	$user = 'root';
	$pass = 'WoJtEk141169';
	$db = 'skladak';
	
	try {
		$db = new PDO("mysql:host={$host};dbname={$db}", $user, $pass);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch (PDOException $e) {
		echo "Connection Error: " . $e->getMessage();
		die();
	}
	
	return $db;
}

function db_close($db){
	$db = null;
}

function all_mobos(){
	$db = db_conn();
	$mobo = $db->query("SELECT * FROM motherboard");
	
	$mobos = array();
	
	while($m = $mobo->fetch(PDO::FETCH_ASSOC)){
		$mobos[] = $m;
	}
	
	db_close($db);
	return $mobos;
}

function all_cpus(){
	$db = db_conn();
	$cpu = $db->query("SELECT * FROM processor");
	
	$cpus = array();
	
	while($c = $cpu->fetch(PDO::FETCH_ASSOC)){
		$cpus[] = $c;
	}
	
	db_close($db);
	return $cpus;
}

function register($login, $pass, $email, $email2, $gender, $u){
	$db = db_conn();
    $user = $u;
	
	try {
		$check = $db->prepare("SELECT * FROM users WHERE login = :login");
		$check->bindValue(':login', $login, PDO::PARAM_STR);
		$check->execute();
		
		if($check->rowCount() > 0){
			echo '<div class="container col-md-6 col-md-offset-3">'.show_info('<strong>Spróbuj ponownie!</strong> Użytkownik o takim loginie już istnieje!', 1, 0).'</div>';
		}
		
		if($email != $email2){
			echo '<div class="container col-md-6 col-md-offset-3">'.show_info('<strong>Ups...</strong> Podane emaile się nie zgadzają.', 3, 0).'</div>';
		}
		
		else {
			$pass = password_hash($pass, PASSWORD_BCRYPT);
			
			$reg = $db->prepare("INSERT INTO users (login, password, email, gender, created, token, active, flag) VALUES(:login, :pass, :email, :gender, NOW(), :token, :active, :flag)");
			$reg->bindValue(':login', $login, PDO::PARAM_STR);
			$reg->bindValue(':pass', $pass, PDO::PARAM_STR);
			$reg->bindValue(':email', $email, PDO::PARAM_STR);
			$reg->bindValue(':gender', $gender, PDO::PARAM_STR);
			//Automatyczne dane
            $reg->bindValue(':token', token(), PDO::PARAM_STR);
			$reg->bindValue(':active', 0, PDO::PARAM_INT);
			$reg->bindValue(':flag', 0, PDO::PARAM_INT);
			$registered = $reg->execute();
			
			header("Location: /");
		}
	}
	catch (PDOException $e) {
		echo "Register Error: " . $e->getMessage();
		die();
	}
	
	db_close($db);
}

function token(){
	$token = "";
	
	$range = rand(20, 60);
	$characters = array_merge(range('A', 'Z'), range('a', 'z'), range('9', '0'));
	for($i = 0; $i < $range; $i++){
		$rand = rand(0, count($characters) - 1);
		$token .= $characters[$rand];
	}
	
	return $token;
}

function login($login, $pass, $u){
    $db = db_conn();
    $user = $u;
    
    try {
		$auth = $user->auth($login, $pass);
        if ($auth) {
            if($user->isActive($login)){
                $_SESSION['user_id'] = $auth;
                header("Location: /");
            }
        }
	}
	catch (PDOException $e) {
		echo "Login Error: " . $e->getMessage();
		die();
	}
    
    db_close($db);
}

function showUsers(){
    $db = db_conn();
    
    try {
        if(!isset($_GET['usrSearch'])){
            $user = $db->query("SELECT * FROM users");

            $userList = array();

            while($u = $user->fetch(PDO::FETCH_ASSOC)){
                $userList[] = $u;
            }
            
            return $userList;
        }
        else{
            $usrSearch = $_GET['usrSearch'];
            $user = $db->query("SELECT * FROM users WHERE login='$usrSearch'");

            $userList = array();

            while($u = $user->fetch(PDO::FETCH_ASSOC)){
                $userList[] = $u;
            }
            
            if($userList==null){
                return null;
            }
            
            return $userList;
            
            
        }
    }
	catch (PDOException $e) {
		echo "show user Error: " . $e->getMessage();
		die();
	}
        
	db_close($db);
}

function remove_user($login){
    $db = db_conn();
    
    try {
        $rm = $db->query("DELETE FROM users WHERE login='$login'");
    }
	catch (PDOException $e) {
		echo "remove user Error: " . $e->getMessage();
		die();
	}
    
    db_close($db);
    header('Location: '.$_SERVER['REQUEST_URI']);
}

function activate_user($login){
    $db = db_conn();
    
    try {
        $ac = $db->query("UPDATE users SET active=1 WHERE login='$login'");
    }
	catch (PDOException $e) {
		echo "activate user Error: " . $e->getMessage();
		die();
	}
    
    db_close($db);
    header('Location: '.$_SERVER['REQUEST_URI']);
}

?>