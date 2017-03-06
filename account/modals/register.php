<!-- Register Form Modal -->
<div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="registerModalLabel" aria-hidden="true">
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
	<div class="form-group form-inline">
		<label class="col-sm-2 col-form-label" for="login">Login:</label>
		<div class="col-sm-10">
		<input type="text" name="login" id="login" placeholder="Login" class="form-control" required autofocus>
		</div>
	</div>
	<div id="passControl" class="form-group form-inline">
		<label class="col-sm-2 col-form-label" for="password">Hasło:</label>
		<div class="col-sm-10">
		<input type="password" name="password" id="password" onChange="checkPass()" placeholder="Hasło" class="form-control" aria-describedby="passwordHelpInline" required>
		<small id="passwordHelpInline" class="form-text text-muted">
		  Musi się składać z 7-20 znaków.
		</small>
		</div>
	</div>
	<div class="form-group form-inline">
		<label class="col-sm-2 col-form-label" for="email">Email:</label>
		<div class="col-sm-10">
		<input type="email" name="email" id="email" placeholder="Email" class="form-control" required>
		</div>
	</div>
	<div id="wrongEmailControl" class="form-group form-inline">
		<label class="col-sm-2 col-form-label" for="email2">Email:</label>
		<div class="col-sm-10">
		<input type="email" name="email2" id="email2" onChange="checkEmail()" placeholder="Email (potwierdź)" class="form-control" aria-describedby="emailHelpInline" required>
        <small id="emailHelpInline" class="form-text text-muted">
            Potwierdź podany email.
		</small>
		</div>
	</div>
	<div class="form-group form-inline">
		<label class="col-sm-2 col-form-label" for="email2">Płeć:</label>
		<div class="col-sm-10 form-inline">
			<div class="form-check form-check-inline">
			  <label class="form-check-label">
				<input class="form-check-input" type="radio" name="gender" id="kobieta" value="Kobieta" checked> Kobieta
			  </label>
			</div>
			<div class="form-check form-check-inline">
			  <label class="form-check-label">
				<input class="form-check-input" type="radio" name="gender" id="mezczyzna" value="Mezczyzna"> Mężczyzna
			  </label>
			</div>
		</div>
	</div>
	<div class="form-group col">
		<div class="row">
			<div class="col">
				<button id="submit" name="registerForm" type="submit" class="btn btn-primary btn-lg">Zarejestruj</button>
			</div>
			<div class="col">
				<button type="reset" id="clear" class="btn btn-secondary btn-lg">Wyczyść</button>
			</div>
		</div>
		</div>
        </form>
      </div>
    </div>
  </div>
</div>