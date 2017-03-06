<?php
	$title="Składak.pl";
	ob_start();
?>
    <div class="container-fluid">
        <div class="row">
            <div class="col bg-danger text-white">
                <h2 class="h2-header text-center text-uppercase">Panel administracyjny</h2>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div id="pa-menu" class="col-lg-2 col-md-auto">
                <nav class="nav flex-column nav-pills nav-fill">
                  <a class="nav-link active" href="/account/admin">Główna</a>
                  <a class="nav-link" href="#" data-toggle="collapse" data-target="#togglePAUsers">Użytkownicy<i class="fa fa-chevron-down float-right" aria-hidden="true"></i></a>
                    <div class="collapse" id="togglePAUsers">
                        <a class="nav-link second" href="?option=ul"><i class="fa fa-caret-right" aria-hidden="true"></i> Lista</a>
                        <a class="nav-link second" href="?option=ue"><i class="fa fa-caret-right" aria-hidden="true"></i> Edytuj</a>
                  </div>
                  <a class="nav-link" href="#">Zestawy</a>
                  <a class="nav-link" href="#">Podzespoły</a>
                </nav>
            </div>
            <div class="col">
                Content
            </div>
        </div>
    </div>
<?php
	$content = ob_get_clean();
	include './templates/layout.php';
?>