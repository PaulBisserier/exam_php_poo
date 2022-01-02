<?php ob_start() ?>
<?php
require_once "Service/Utils.php"; 
$utils = new Utils;
echo "<pre>";
//($lastLogements);
echo "</pre>";
?>

<div class="row">
    <h2 class="text-center">BIENVENUE DANS MON AGENCE IMMOBILIERE</h2>
</div>

<?php
$content =  ob_get_clean();
$title = "Logement !";
require_once "base.html.php";
?>