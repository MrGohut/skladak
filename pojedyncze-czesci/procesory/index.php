<?php
session_start();
ob_start();
// Display errors
ini_set('display_errors', 1);
error_reporting(E_ALL);
// Include page
//require ('templates/pages/index.php');
include_once $_SERVER["DOCUMENT_ROOT"].'/includes/connect.php';
include_once $_SERVER["DOCUMENT_ROOT"].'/includes/password.php';
include_once $_SERVER["DOCUMENT_ROOT"].'/class/User.php';

$user = new User($db);
if($user->check()) {
	$userData = $user->data();
}

function IsChecked($chkname,$value)
{
	if(!empty($_POST[$chkname]))
	{
		foreach($_POST[$chkname] as $chkval)
		{
			if($chkval == $value)
			{
				return true;
			}
		}
	}
	return false;
}

include_once $_SERVER["DOCUMENT_ROOT"].'/templates/global/head-parts.php';
?>
<body>
<?php include_once $_SERVER["DOCUMENT_ROOT"].'/templates/global/header.php'; ?>
<!----------------------------TUTAJ GŁÓWNY KOD STRONY------------------------------->
<?php
if($user->check()) {
	echo '<form action="../../functions/pricesUpdate.php" method="POST">
	<input type="submit" value="Aktualizacja cen" />
</form>';
}
?>
<main>
	<div id="parts-types-container">
		<div id="parts-types-title-column">
			<p>Podzespoły</p>
			<p>Peryferia</p>
		</div>
		<div id="parts-types-choose-column">
			<div class="parts-choose-row">
				<a href="../procesory">Chłodzenie</a>
				<a href="../procesory">Chłodzenie CPU</a>
				<a href="../procesory">Chłodzenie wodne</a>
				<a href="../procesory">Dyski 2,5" i mniejsze</a>
				<a href="../procesory">Dyski SSD</a>
				<a href="../procesory">Dyski HDD 3,5"</a>
				<a href="../procesory">Dyski zewnętrzne</a>
				<a href="../procesory">Karty dźwiękowe</a>
				<a href="../procesory">Karty graficzne</a>
				<a href="../procesory">Karty sieciowe</a>
				<a href="../procesory">Napędy optyczne</a>
				<a href="../procesory">Obudowy</a>
				<a href="../procesory">Pamięci RAM</a>
				<a href="../procesory" id="selected">Procesory</a>
				<a href="../procesory">Płyty główne</a>
				<a href="../procesory">Zasilacze</a>
			</div>
			<div class="parts-choose-row">
				<a href="../procesory">Chłodzenie</a>
				<a href="../procesory">Chłodzenie CPU</a>
				<a href="../procesory">Chłodzenie wodne</a>
				<a href="../procesory">Dyski 2,5" i mniejsze</a>
				<a href="../procesory">Dyski SSD</a>
				<a href="../procesory">Dyski HDD 3,5"</a>
				<a href="../procesory">Dyski zewnętrzne</a>
				<a href="../procesory">Karty dźwiękowe</a>
				<a href="../procesory">Karty graficzne</a>
				<a href="../procesory">Karty sieciowe</a>
				<a href="../procesory">Napędy optyczne</a>
				<a href="../procesory">Obudowy</a>
				<a href="../procesory">Pamięci RAM</a>
				<a href="../procesory">Procesory</a>
				<a href="../procesory">Płyty główne</a>
				<a href="../procesory">Zasilacze</a>
			</div>
		</div>
	</div>
	<div id="parts-container">
		<div id="filters">
			<div class="parts-column-container">
				<h2 class="parts-column-title">Filtry</h2>
				<div id="cpu-filter">
					<form action="" method="POST">
						<div class="filters-section-title">
							Producenci
						</div>
						<div class="filter-section-container">
							<div class="checkbox-block-filter">
								<input id="cpu-intel" type="checkbox" value="Intel" name="cpu-manu[]" <?php if(IsChecked('cpu-manu','Intel')){echo 'checked';} ?> />
								<label for="cpu-intel">Intel</label>
							</div>
							<div class="checkbox-block-filter">
								<input id="cpu-amd" type="checkbox" value="AMD" name="cpu-manu[]" <?php if(IsChecked('cpu-manu','AMD')){echo 'checked';} ?> />
								<label for="cpu-amd">AMD</label>
							</div>
						</div>
						<input class="submit-filters" type="submit" name="submit" value="Filtruj" />
						<div class="filters-section-title">
							Rodzaj
						</div>
						<div class="filter-section-container">
							<div class="checkbox-block-filter">
								<input id="cpu-core-i7" type="checkbox" value="i7" name="cpu-type[]" <?php if(IsChecked('cpu-type','i7')){echo 'checked';} ?> />
								<label for="cpu-core-i7">Core i7</label>
							</div>
							<div class="checkbox-block-filter">
								<input id="cpu-core-i5" type="checkbox" value="i5" name="cpu-type[]" <?php if(IsChecked('cpu-type','i5')){echo 'checked';} ?> />
								<label for="cpu-core-i5">Core i5</label>
							</div>
							<div class="checkbox-block-filter">
								<input id="cpu-core-i3" type="checkbox" value="i3" name="cpu-type[]" <?php if(IsChecked('cpu-type','i3')){echo 'checked';} ?> />
								<label for="cpu-core-i3">Core i3</label>
							</div>
						</div>
						<input class="submit-filters" type="submit" name="submit" value="Filtruj" />
						<div class="filters-section-title">
							Typ gniazda
						</div>
						<div class="filter-section-container">
							<div class="checkbox-block-filter">
								<input id="cpu-intel-1150" type="checkbox" value="1150" name="cpu-socket[]" <?php if(IsChecked('cpu-socket','1150')){echo 'checked';} ?> />
								<label for="cpu-intel-1150">Socket 1150</label>
							</div>
							<div class="checkbox-block-filter">
								<input id="cpu-intel-1155" type="checkbox" value="1155" name="cpu-socket[]" <?php if(IsChecked('cpu-socket','1155')){echo 'checked';} ?> />
								<label for="cpu-intel-1155">Socket 1155</label>
							</div>
							<div class="checkbox-block-filter">
								<input id="cpu-intel-1151" type="checkbox" value="1151" name="cpu-socket[]" <?php if(IsChecked('cpu-socket','1151')){echo 'checked';} ?> />
								<label for="cpu-intel-1151">Socket 1151</label>
							</div>
							<div class="checkbox-block-filter">
								<input id="cpu-intel-2011" type="checkbox" value="2011" name="cpu-socket[]" <?php if(IsChecked('cpu-socket','2011')){echo 'checked';} ?> />
								<label for="cpu-intel-2011">Socket 2011</label>
							</div>
						</div>
						<input class="submit-filters" type="submit" name="submit" value="Filtruj" />
						<div class="filters-section-title">
							Ilość rdzeni
						</div>
						<div class="filter-section-container">
							<div class="checkbox-block-filter">
								<input id="cpu-cores-4" type="checkbox" value="4" name="cpu-cores[]" <?php if(IsChecked('cpu-cores','4')){echo 'checked';} ?> />
								<label for="cpu-cores-4">4</label>
							</div>
							<div class="checkbox-block-filter">
								<input id="cpu-cores-2" type="checkbox" value="2" name="cpu-cores[]" <?php if(IsChecked('cpu-cores','2')){echo 'checked';} ?> />
								<label for="cpu-cores-2">2</label>
							</div>
							<div class="checkbox-block-filter">
								<input id="cpu-cores-6" type="checkbox" value="6" name="cpu-cores[]" <?php if(IsChecked('cpu-cores','6')){echo 'checked';} ?> />
								<label for="cpu-cores-6">6</label>
							</div>
							<div class="checkbox-block-filter">
								<input id="cpu-cores-8" type="checkbox" value="8" name="cpu-cores[]" <?php if(IsChecked('cpu-cores','8')){echo 'checked';} ?> />
								<label for="cpu-cores-8">8</label>
							</div>
						</div>
						<input class="submit-filters" type="submit" name="submit" value="Filtruj" />
					</form>
				</div>
			</div>
		</div>
		<div id="pick-parts">
			<div class="parts-column-container">
				<h2 class="parts-column-title">Spis części</h2>
				<div id="parts" class="CPU">
					<div id="parts-title-row">
						<p class="cpu-add">Zestaw</p>
						<p class="cpu-name">CPU</p>
						<p class="cpu-speed">Prędkość (GHz)</p>
						<p class="cpu-cores">Rdzenie</p>
						<p class="cpu-tdp">TDP</p>
						<p class="cpu-price">Cena</p>
						<p class="cpu-show">Więcej</p>
					</div>
					<?php 
						include_once $_SERVER["DOCUMENT_ROOT"].'/functions/showCPU.php';
					?>
				</div>
			</div>
		</div>
	</div>
</main>
<!----------------------------KONIEC------------------------------->
<?php include_once $_SERVER["DOCUMENT_ROOT"].'/templates/global/footer.php'; ?>
</body>
</html>
<?php ob_end_flush(); ?>