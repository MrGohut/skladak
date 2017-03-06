<!DOCTYPE html>
<html lang="pl" dir="ltr">
	<head>
		<meta charset="UTF-8">
		<meta name="description" content="">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title><?php echo $title ?></title>
		<link rel="stylesheet" href="/css/bootstrap.min.css">
		<link rel="Stylesheet" href="/css/sticky-footer.css">
        <link rel="stylesheet" href="/css/font-awesome.min.css">
		<link rel="Stylesheet" href="/css/style.css">
		<?php if(isset($additional))
				echo $additional
		?>
	</head>
	<body>
        <header class="navbar navbar-inverse bg-inverse navbar-toggleable-md">
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Włącz/wyłącz menu">
                    <span class="navbar-toggler-icon"></span>
                </button>
            <nav class="container">
                <a class="navbar-brand" href="http://10.9.146.4"><img src="/images/logo.png" alt="Składak.pl"></a>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="#">Części PC</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Gotowe zestawy</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Złóż swój zestaw</a>
                        </li>
                    </ul>
                    <form class="form-inline user-panel-nav">
                        <?php
                            if(!$user->check()){
                        ?>
                        <form class="form-inline">
                        <div class="btn-group nav-item pull-xs-right" role="group" aria-label="Zarządzanie profilem użytkownika">
                            <button type="button" class="btn btn-sm btn-outline-success" data-toggle="modal" data-target="#loginModal">Logowanie</button>
                            <button type="button" class="btn btn-sm btn-outline-danger" data-toggle="modal" data-target="#registerModal">Rejestracja</a>
                        </div>
                        </form>
                        <?php
                        } else { ?>
                        <div class="btn-group btn-group-sm" role="group">
                        <a href="/account/profile?p=<?php echo $userData['login']; ?>" role="button" class="btn btn-info"><?php echo $userData['login']; ?></a>
                        <?php if($user->flagCheck($userData['login'])){ ?>
                        <a href="/account/admin" role="button" class="btn btn-primary">Panel Administracyjny</a>
                        <?php } ?>
                        <a href="/account/logout" role="button" class="btn btn-outline-danger">Wyloguj</a>
                        </div>
                        <?php } ?>
                    </form>
                </div>
            </nav>
        </header>
		<?php
            echo $content;
        ?>
        <footer class="footer">
            <div class="container">
                <span class="text-muted">2017 &copy; Składak.pl -- All rights reserved.</span>
            </div>
        </footer>
        <script src="/js/jquery-3.1.1.min.js"></script>
        <script src="/js/tether.min.js"></script>
        <script src="/js/bootstrap.min.js"></script>
        <script src="/js/custom.js"></script>
        <?php 
            require './account/modals/register.php';
            require './account/modals/login.php';
        ?>
	</body>
 </html>