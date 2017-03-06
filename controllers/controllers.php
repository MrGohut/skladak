<?php
function home_page($u, $d){
    $user = $u;
    $userData = $d;
    $mobos = all_mobos();
    $cpus = all_cpus();
    include './templates/home.php';
}

function profile_page($u, $d){
    $user = $u;
    $userData = $d;
    $profile = htmlspecialchars($_GET['p']);
    if($user->confirm($profile)){
        include './templates/account/profile.php';
    }
    else
        header("Location: /");
}

function admin_panel($u, $d){
    $user = $u;
    $userData = $d;
    include './templates/account/admin/admin_panel.php';
}

function admin_panel_ulist($u, $d){
    $user = $u;
    $userData = $d;
    $userList = showUsers();
    
    include './templates/account/admin/user_list.php';
}

function admin_panel_uedit($u, $d){
    $user = $u;
    $userData = $d;
    
    include './templates/account/admin/user_edit.php';
}
?>