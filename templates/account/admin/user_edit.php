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
                <?php
                if(isset($_GET['usr'])){
                    $usr = $_GET['usr'];
                ?>
                
                <h2>Edytuj użytkownika <span class="text-info"><?php echo $usr; ?></span></h2>
                Czasowo niedostępne
                
                <?php
                }
                ?>
            </div>
        </div>
    </div>
<?php
	$content = ob_get_clean();
	include './templates/layout.php';
?>