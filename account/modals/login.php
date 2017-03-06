<!-- Login Form Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" align="center">
          <div class="modal-custom-container">
        <img src="/images/logo.png" alt="Składak.pl" height="40px">
        </div>
          <button type="button" class="close" data-dismiss="modal" aria-label="Zamknij">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="modal-custom-container" method="POST" action="<?php echo $_SERVER['REQUEST_URI']; ?>">  
            <div class="form-group">
                <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
            <input type="text" class="form-control" name="login" id="login" placeholder="Login" required>
                </div>
                </div>
            <div class="form-group">
                <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-lock fa" aria-hidden="true"></i></span>
            <input type="password" class="form-control" name="password" id="password" placeholder="Hasło" required>
          </div>
            </div>
          <button type="submit" name="loginForm" class="btn btn-primary">Zaloguj</button>
        </form>
      </div>
    </div>
  </div>
</div>