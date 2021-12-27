<?php ob_start() ?>

<p>Accueil - Hello World</p>


<?php
$content =  ob_get_clean();
$title = "Logement !";
require_once "base.html.php";
?>