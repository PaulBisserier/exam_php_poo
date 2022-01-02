<?php ob_start() ?>
<?php
require_once "Service/Utils.php"; 
$utils = new Utils;
echo "<pre>";
//($lastLogements);
echo "</pre>";
?>
<p>Accueil - Hello World</p>

<div class="row">
    <div class="col-12 d-flex justify-content-between">
        <?php foreach ($lastLogements as $logement) : ?>
            <div class="card mb-3">
                <h3 class="card-header"><?=$logement->titre ?></h3>
                <div class="card-body">
                    <h5 class="card-title">Seulement :<?= $logement->prix?> €</h5>
                    <h6 class="card-subtitle text-muted">surface : <?= $logement->surface?>m²</h6>
                </div>
               <img src="../Images/<?=$logement->photo?>" alt="<?=$logement->titre?>" srcset="">
                <div class="card-body">
                    <p class="card-text"><?= substr_replace($logement->description, "...", 150, 0) ?></p>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><?=$logement->adresse?></li>
                    <li class="list-group-item"><?= $logement->cp . " ". $logement->ville ?></li>
                    <li class="list-group-item"><?= $logement->type ?></li>
                </ul>
                <div class="card-body">
                    <a href="#" class="card-link">Card link</a>
                </div>
                <div class="card-footer text-muted">
                    2 days ago
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php
$content =  ob_get_clean();
$title = "Logement !";
require_once "base.html.php";
?>