<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
include_once $_SERVER["DOCUMENT_ROOT"].'/includes/connect.php';
try {
	$filter = $db->query("SELECT pPriceLink, pURLMorele, pPriceMorele, pURLESC, pPriceESC, ID FROM procesory");
	$update = $db->prepare("UPDATE procesory SET pPriceMorele=:price WHERE ID=:id");
	$update2 = $db->prepare("UPDATE procesory SET pPriceESC=:price WHERE ID=:id");
	$update3 = $db->prepare("UPDATE procesory SET pPrice=:price WHERE ID=:id");
	$update4 = $db->prepare("UPDATE procesory SET pPriceLink=:link WHERE ID=:id");
	//$update5 = $db->prepare("UPDATE procesory SET pPriceLink=:link WHERE ID=:id");
	$check = $filter->rowCount();
	echo $check.'<br />';
	while($c = $filter->fetch()){
		$prices = [];
		$id = $c['ID'];
		if($c['pURLMorele'] != null){
			$source = file_get_contents($c['pURLMorele']);
			$doc = new DomDocument();
			$file = @$doc->loadHTML($source);
			$rows = $doc->getElementsByTagName('span');
			
			foreach ($rows as $row) {
				if($row->getAttribute('class') == 'price') {
					echo $c['ID'].' - ';
					echo (int)$row->nodeValue.' -- OK!<br />';
					$price = (int)$row->nodeValue;
					
					array_push($prices, $price);
					
					$update->bindValue(':price', $price);
					$update->bindValue(':id', $id);
					$update->execute();
				}
			}
		}
		if($c['pURLESC'] != null){
			$source = file_get_contents($c['pURLESC']);
			$doc = new DomDocument();
			$file = @$doc->loadHTML($source);
			$tables = $doc->getElementsByTagName('table');
			foreach ($tables as $table)
			{
				if($table->getAttribute('class') == 'naglowek'){
					$rows = $table->getElementsByTagName('tr');
					foreach($rows as $row){
						$cells = $row->getElementsByTagName('td');
						foreach($cells as $cell){
							if($cell->getAttribute('align') == 'right'){
								echo (int)$cell->nodeValue.' -- ESC<br />';
								$price = (int)$cell->nodeValue;
								
								array_push($prices, $price);
								
								$update2->bindValue(':price', $price);
								$update2->bindValue(':id', $id);
								$update2->execute();
							}
						}
					}
				}
			}
		}
		if(!empty($prices)){
			//Zaktualizuj do najniższej ceny ze sklepów
			echo min($prices);
			$update3->bindValue(':price', min($prices));
			$update3->bindValue(':id', $id);
			$update3->execute();
			
			/*Zaktualizuj link do tego sklepu
			0 - Morele.net
			1 - ESC.pl
			*/
			$min_key = array_keys($prices, min($prices));
			//echo $min_key[0];
			switch($min_key[0]){
				case 0:
					echo '<br/>Morele.net';
					$update4->bindValue(':link', $c['pURLMorele']);
					$update4->bindValue(':id', $id);
					$update4->execute();
					break;
				case 1:
					echo '<br/>ESC.pl';
					$update4->bindValue(':link', $c['pURLESC']);
					$update4->bindValue(':id', $id);
					$update4->execute();
					break;
			}
		}
		echo '<br />-------------------------------------<br />';
	}
	echo '<br /><br /><strong>Aktualizacja zakończona!</strong>';
}
catch (PDOException $e) {
	echo 'Something went wrong!<br>'.$e->getMessage();
	die();
}
?>