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
include_once $_SERVER["DOCUMENT_ROOT"].'/templates/global/head.php';
?>
<body>
<?php include_once $_SERVER["DOCUMENT_ROOT"].'/templates/global/header.php'; ?>
<!-- ####################  TUTAJ GŁÓWNY KOD STRONY  ######################### -->
<main>
	<div id="parts-choose">
		<p class="section-title">Wybierz część</p>
		<p class="column-title">Podzespoły</p>
		<p class="column-title">Peryferia</p>
		<div class="choose-parts-column" id="first-border">
			<a href="procesory">&rArr; Chłodzenie</a>
			<a href="procesory">&rArr; Chłodzenie CPU</a>
			<a href="procesory">&rArr; Chłodzenie wodne</a>
			<a href="procesory">&rArr; Dyski 2,5" i mniejsze</a>
			<a href="procesory">&rArr; Dyski SSD</a>
			<a href="procesory">&rArr; Dyski HDD 3,5"</a>
			<a href="procesory">&rArr; Dyski zewnętrzne</a>
			<a href="procesory">&rArr; Karty dźwiękowe</a>
			<a href="procesory">&rArr; Karty graficzne</a>
			<a href="procesory">&rArr; Karty sieciowe</a>
			<a href="procesory">&rArr; Napędy optyczne</a>
			<a href="procesory">&rArr; Obudowy</a>
			<a href="procesory">&rArr; Pamięci RAM</a>
			<a href="procesory">&rArr; Procesory</a>
			<a href="procesory">&rArr; Płyty główne</a>
			<a href="procesory">&rArr; Zasilacze</a>
		</div>
		<div class="choose-parts-column">
			<a href="procesory">&rArr; Procesory</a>
			<a href="procesory">&rArr; Płyty główne</a>
			<a href="procesory">&rArr; Pamięci RAM</a>
			<a href="procesory">&rArr; Karty graficzne</a>
			<a href="procesory">&rArr; Dyski twarde 3,5"</a>
			<a href="procesory">&rArr; Dyski SSD</a>
			<a href="procesory">&rArr; Karty dźwiękowe</a>
			<a href="procesory">&rArr; Zasilacze</a>
			<a href="procesory">&rArr; Karty sieciowe</a>
			<a href="procesory">&rArr; Obudowy</a>
		</div>
	</div>
</main>
<!-- ####################  KONIEC  ######################### -->
<?php include_once $_SERVER["DOCUMENT_ROOT"].'/templates/global/footer.php'; ?>
</body>
</html>
<?php ob_end_flush(); ?>