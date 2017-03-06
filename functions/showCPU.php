<?php
try {
	if(!empty($_POST)){
		$query = "";
		$select = "SELECT * FROM procesory";
		$order = "ORDER BY id";
		$and = " AND";
		if(isset($_POST['cpu-cores'])){
			$cpuCores = implode(',',($_POST['cpu-cores']));
			$query.= "$select WHERE pCores IN ($cpuCores) ";
		}
		
		if(isset($_POST['cpu-socket'])){
			$cpuSocket = implode(',',($_POST['cpu-socket']));
			if(!empty($query)){
				$query.= "$and pSocket IN ($cpuSocket) ";
			}
			else{
				$query.= "$select WHERE pSocket IN ($cpuSocket) ";
			}
		}
		
		if(isset($_POST['cpu-type'])){
			$cpuType = "'".implode("','",($_POST['cpu-type']))."'";
			if(!empty($query)){
				$query.= "$and pType IN ($cpuType) ";
			}
			else{
				$query.= "$select WHERE pType IN ($cpuType) ";
			}
		}
		
		if(isset($_POST['cpu-manu'])){
			$cpuManu = "'".implode("','",($_POST['cpu-manu']))."'";
			if(!empty($query)){
				$query.= "$and pManu IN ($cpuManu) ";
			}
			else{
				$query.= "$select WHERE pManu IN ($cpuManu) ";
			}
		}
		
		if(empty($query)){
			$filter = $db->query("SELECT * FROM procesory ORDER BY id");
			$check = $filter->rowCount();
			//var_dump($query);
		}
		else {
			$query.= $order;
			$filter = $db->query($query);
			$check = $filter->rowCount();
			//var_dump($query);
		}
	}
	else
	{
		$filter = $db->query("SELECT * FROM procesory ORDER BY id");
		$check = $filter->rowCount();
		//var_dump($filter);
	}
	
	if($check > 0) {
		while($or = $filter->fetch()) {
			if($or['pShow'] != 0){
				echo '<div class="parts-container-row">
				<p class="cpu-add"><button>Dodaj</button></p>
				<p class="cpu-name">'.$or['pName'].'</p>';
				if($or['pSpeedTurbo']!=null){
				echo '<p class="cpu-speed">'.$or['pSpeed'].' &rarr; '.$or['pSpeedTurbo'].'</p>';
				} else {
					echo '<p class="cpu-speed">'.$or['pSpeed'].'</p>';
				}
				echo '<p class="cpu-cores">'.$or['pCores'].'</p>
				<p class="cpu-tdp">'.$or['pTDP'].' W</p>
				<p class="cpu-price"><a href="'.$or['pPriceLink'].'">'.$or['pPrice'].' zł</a></p>
				<p class="cpu-show"><a href="#" onclick="show('.$or['ID'].');return false;">&crarr;</a></p>
				</div>
				<div id="cpu-more-'.$or['ID'].'" class="cpu-more">
				<div class="cpu-more-image">
					<img src="/images/processors/'.$or['pModel'].'.jpg" alt="'.$or['pName'].'" />
				</div>
				<div class="cpu-more-shops">
					<p>Morele.net </p>
					<p>ESC.pl </p>
				</div>
				<div class="cpu-more-shops-prices">';
					if($or['pURLMorele'] != null)
						echo '<p><a href="'.$or['pURLMorele'].'">'.$or['pPriceMorele'].' zł</a></p>';
					else
						echo '<p><a href="#">Brak</a></p>';
					if($or['pURLESC'] != null)
						echo '<p><a href="'.$or['pURLESC'].'">'.$or['pPriceESC'].' zł</a></p>';
					else
						echo '<p><a href="#">Brak</a></p>';
				echo '</div>
				<div class="cpu-more-info">
					<div class="info-block-container1">
						<div class="info-block">
							<p class="more-info-title">
								Rdzenie / Wątki
							</p>
							<p class="more-info-content">
								'.$or['pCores'].' / '.$or['pThreads'].'
							</p>
						</div>
						<div class="info-block">
							<p class="more-info-title">
								Socket
							</p>
							<p class="more-info-content">
								'.$or['pSocket'].'
							</p>
						</div>
						<div class="info-block">
							<p class="more-info-title">
								Grafika
							</p>
							<p class="more-info-content">
								'.$or['pGraphics'].'
							</p>
						</div>
					</div>
					<div class="info-block-container1">
						<div class="info-block">
							<p class="more-info-title">
								Możliwość OC
							</p>
							<p class="more-info-content">';
								if($or['pOC'] == 1){
									echo 'Tak';
								}
								else{
									echo 'Nie';
								}
							echo '</p>
						</div>
						<div class="info-block">
							<p class="more-info-title">
								Architektura
							</p>
							<p class="more-info-content">
								'.$or['pArch'].'-bit
							</p>
						</div>
						<div class="info-block">
							<p class="more-info-title">
								Proces technologiczny
							</p>
							<p class="more-info-content">
								'.$or['pNano'].' nm
							</p>
						</div>
					</div>
					<div class="info-block-container1">
						<div class="info-block">
							<p class="more-info-title">
								Pamięć L1
							</p>
							<p class="more-info-content">
								<p class="p2">'.$or['pL1x'].' x '.$or['pL1kb'].' KB (Dane)</p>
								<p class="p2">'.$or['pL1x'].' x '.$or['pL1kb'].' KB (Instrukcje)</p>
							</p>
						</div>
						<div class="info-block">
							<p class="more-info-title">
								Pamięć L2
							</p>
							<p class="more-info-content">
								'.$or['pL2x'].' x '.$or['pL2kb'].' KB
							</p>
						</div>
						<div class="info-block">
							<p class="more-info-title">
								Pamięć L3
							</p>
							<p class="more-info-content">
								'.$or['pL3mb'].' MB
							</p>
						</div>
					</div>
				</div>
				</div>';
			}
		}
	}
	else {
		echo '<p class="p-error">Brak procesorów o takich parametrach.</p>';
	}
}
catch (PDOException $e) {
	echo 'Something went wrong!<br>'.$e->getMessage();
	die();
}
?>