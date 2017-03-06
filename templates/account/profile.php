<?php
	$title="Składak.pl";
	ob_start();
?>
    <div class="container">
        
    </div>
<?php
	$content = ob_get_clean();
	include './templates/layout.php';
?>