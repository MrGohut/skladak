<?php
session_start();
// Display errors
ini_set('display_errors', 1);
error_reporting(E_ALL);
// Include page
include 'functions/model.php';
include 'controllers/controllers.php';
include 'includes/password.php';
include 'class/User.php';

$userData = null;
$user = new User(db_conn());
if($user->check()) {
	$userData = $user->data();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(isset($_POST['loginForm']))
        login($_POST['login'], $_POST['password'], $user);
    if(isset($_POST['registerForm']))
        register($_POST['login'], $_POST['password'], $_POST['email'], $_POST['email2'], $_POST['gender'], $user);
    if(isset($_POST['removeUser']))
        remove_user($_POST['userToRemove']);
    if(isset($_POST['activateUser']))
        activate_user($_POST['userToActivate']);
}

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

switch($uri){
	case '/':
		home_page($user, $userData);
		break;
    case '/account/profile':
		profile_page($user, $userData);
		break;
    case '/account/admin':
        if($user->check() && $user->flagCheck($userData['login'])){
            if($_SERVER['REQUEST_METHOD'] == 'GET'){
                if(isset($_GET['option']))
                {
                    if($_GET['option'] == 'ul'){
                        admin_panel_ulist($user, $userData);
                    }
                    else if($_GET['option'] == 'ue'){
                        admin_panel_uedit($user, $userData);
                    }
                    else{
                        admin_panel($user, $userData);
                    }
                }
                else{
                    admin_panel($user, $userData);
                }
            }
            else{
                admin_panel($user, $userData);
            }
        }
        else
            header("Location: /");
        break;
	default:
		header('Status: 404 Not Found');
		echo '<html><body><h1>Page Not Found</h1></body></html>';
}

?>