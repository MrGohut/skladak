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
            <?php include 'admin_panel_nav.php'; ?>
            <div class="col">
                Content
            </div>
        </div>
    </div>
<?php
	$content = ob_get_clean();
	include './templates/layout.php';
?>