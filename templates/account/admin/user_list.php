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
                  <a class="nav-link" href="/account/admin">Główna</a>
                  <a class="nav-link" href="#" data-toggle="collapse" data-target="#togglePAUsers">Użytkownicy<i class="fa fa-chevron-down float-right" aria-hidden="true"></i></a>
                    <div class="collapse show" id="togglePAUsers">
                        <a class="nav-link active second" href="?option=ul"><i class="fa fa-caret-right" aria-hidden="true"></i> Lista</a>
                        <a class="nav-link second" href="?option=ue"><i class="fa fa-caret-right" aria-hidden="true"></i> Edytuj</a>
                  </div>
                  <a class="nav-link" href="#">Zestawy</a>
                  <a class="nav-link" href="#">Podzespoły</a>
                </nav>
            </div>
            <div class="col">
                <?php if(!isset($_GET['usrSearch'])){ ?>
                <div class="mt-3 mb-3 d-flex justify-content-center">
                    <form class="form-inline" method="GET" action="">
                        <input type="hidden" name="option" value="ul">
                        <input class="form-control rounded-0" type="text" name="usrSearch" placeholder="Nazwa użytkownika...">
                        <button class="btn btn-outline-primary rounded-0" type="submit">Szukaj</button>
                    </form>
                </div>
                <?php }else{ ?>
                <div class="mt-3 mb-3 d-flex justify-content-center">
                    <a href="?option=ul" class="btn btn-outline-primary rounded-0" role="button">Pokaż wszystkich</a>
                </div>
                <?php } ?>
                <table class="table table-sm table-hover">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Login</th>
                      <th>E-mail</th>
                      <th>Płeć</th>
                      <th>Data rejestracji</th>
                      <th>Status</th>
                      <th>Przywileje</th>
                      <th>Akcja</th>
                    </tr>
                  </thead>
                  <tbody>
                      <?php if($userList!=null){
                        foreach($userList as $usr){
                        echo '<tr>
                          <th scope="row">'.$usr['id'].'</th>
                          <td>'.$usr['login'].'</td>
                          <td>'.$usr['email'].'</td>
                          <td>'.$usr['gender'].'</td>
                          <td>'.$usr['created'].'</td>
                          <td>';
                            if($usr['active'] == 1){
                                echo '<span class="badge badge-success">Aktywny</span></td>';
                            }
                            else
                                echo '<span class="badge badge-warning">Oczekuje</span></td>';
                          echo '<td>';
                            if($usr['flag'] == 0){
                                echo '<span class="badge badge-default">Użytkownik</span></td>';
                            }
                            else
                                echo '<span class="badge badge-danger">Administracja</span></td>';
                          echo '<td>';
                            if($usr['flag'] == 1){
                                echo '<a href="" role="button" class="btn btn-sm btn-secondary disabled"><i class="fa fa-pencil" aria-hidden="true"></i></a>';
                            }
                            else {
                                echo '<a href="?option=ue&usr='.$usr['login'].'" role="button" class="btn btn-sm btn-secondary"><i class="fa fa-pencil" aria-hidden="true"></i></a>';
                            }
                            if($usr['flag'] == 1){
                                echo '<a href="" data-toggle="modal" data-target="#confirmModal" role="button" class="btn btn-sm btn-secondary disabled"><i class="fa fa-trash" aria-hidden="true"></i></a>';
                            }
                            else {
                                echo '<a href="" id="remove-user-'.$usr['id'].'" onclick="remove_user(this)" data-toggle="modal" data-target="#confirmModal" value="'.$usr['login'].'" role="button" class="btn btn-sm btn-secondary"><i class="fa fa-trash" aria-hidden="true"></i></a>';
                            }
                            if($usr['active'] == 1){
                                echo '<a href="" role="button" class="btn btn-sm btn-secondary disabled" tabindex="-1"><i class="fa fa-check-circle" aria-hidden="true"></i></a>';
                            }
                            else
                                echo '<a href="" id="activate-user-'.$usr['id'].'" onclick="activate_user(this)" data-toggle="modal" data-target="#confirmModal" value="'.$usr['login'].'" role="button" class="btn btn-sm btn-secondary"><i class="fa fa-check-circle" aria-hidden="true"></i></a>';
                        echo'</td>
                        </tr>';
                        }}else{echo '<tr class="text-center">'.show_info('<i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Użytkownik <strong>'.$_GET['usrSearch'].'</strong> nie istnieje!', 1, 0).'</tr>';} ?>
                  </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="confirmModalLabel">Czy na pewno?</h5>
        </button>
      </div>
      <div id="confirmModalBody" class="modal-body">
          
      </div>
      <div class="modal-footer">
        <form id="confirmModalForm" method="POST" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
        </form>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Anuluj</button>
      </div>
    </div>
  </div>
</div>
<?php
	$content = ob_get_clean();
	include './templates/layout.php';
?>